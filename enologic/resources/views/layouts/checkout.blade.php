@extends('layouts.general')

@section('checkout')
    @php
        $totalQuantity = 0;
        foreach ($products as $product) {
            $totalQuantity += $product->pivot->quantity;
        }
    @endphp

    <div class="container mt-3">

        <h1 class="text-center pb-1"><span class="rounded-pill title-custom px-3">Checkout</span></h1>
        <div class="container d-flex align-items-center justify-content-between">

            <div class="col-12 text-end pe-4 mb-3">
                {{-- Boton para volver a DASHBOARD --}}
                <a class="btn btn-dark" href="{{ 'cart' }}">
                    <i class="fa-solid fa-rotate-left"></i>
                </a>
            </div>
        </div>

    </div>

    <div class="container checkout-custom mb-5">
        <div class="row g-3 mt-1">

            {{-- YOUR CART --}}
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-dark">Your cart</span>
                    <span class="badge bg-warning text-dark rounded-pill">{{ $totalQuantity }}</span>
                </h4>
                <ul class="list-group mb-3">
                    <!-- Iterar sobre los productos del carrito -->
                    @php
                        $totalPrice = 0;
                    @endphp
                    @foreach ($products as $product)
                        @php
                            // Calcular el precio total por producto (precio x cantidad)
                            $productTotalPrice = $product->price * $product->pivot->quantity;
                            // Sumar al precio total
                            $totalPrice += $productTotalPrice;
                        @endphp
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">{{ $product->product_name }}</h6>
                                <!-- Quité la descripción -->
                            </div>
                            <div class="col-4 d-flex justify-content-evenly">
                                <span class="text-muted">{{ $product->price }}€</span>
                                <span class="text-muted">x{{ $product->pivot->quantity }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <!-- Mostrar el precio total -->
                <div id="totalContainer" class="d-flex justify-content-between">
                    <strong>
                        <p id="total">Total: <span id="totalAmount">{{ number_format($totalPrice, 2) }}</span> €</p>
                    </strong>
                </div>
                <div id="discountApplied" style="display: none;">
                    <p>Descuento aplicado</p>
                </div>
                <div id="invalidCoupon" style="display: none;">
                    <p style="color: red;">El cupón no existe</p>
                </div>


                <form class="card p-2" id="couponForm">
                    <div id="redeemButton" class="input-group">
                        <input type="text" class="form-control" id="couponCode" placeholder="Promo code" required>
                        <button type="submit" class="btn btn-dark">Redeem</button>
                    </div>
                    <div class="text-center">
                        <button style="display: none;" id="removeButton" type="button"
                            class="col-3 col-md-5 col-lg-4 btn btn-danger">Remove</button>
                    </div>
                </form>

            <script>
                $(document).ready(function() {
                    // Manejar clics en el botón "Remove"
                    $('#removeButton').click(function() {
                        
                        // Ocultar el mensaje de descuento aplicado
                        $('#discountApplied').hide();
                        // Mostrar el botón "Redeem" y ocultar el botón "Remove"
                        $('#redeemButton').show();
                        $('#removeButton').hide();
                        // Restaurar el total original
                        let originalTotal = parseFloat('{{ $totalPrice }}');
                        $('#totalAmount').text(originalTotal.toFixed(2));
                        
                        $('#discountInput').val('false');
                        $('#totalDiscountedInput').val(originalTotal);
                       
                    });

                    // Manejar el envío del formulario
                    $('#couponForm').submit(function(event) {
                        event.preventDefault();
                        let couponCode = $('#couponCode').val();

                        // Realizar la solicitud AJAX para aplicar el cupón
                        $.ajax({
                            type: 'POST',
                            url: '{{ route("apply.coupon") }}',
                            data: {
                                _token: '{{ csrf_token() }}',
                                coupon_code: couponCode
                            },
                            success: function(response) {
                                // Manejar la respuesta del servidor
                                if (response.discount_percentage) {
                                    // Mostrar el mensaje de descuento aplicado
                                    $('#discountApplied').show();
                                    $('#removeButton').show();
                                    $('#redeemButton').hide();
                                    $('#invalidCoupon').hide();
                                   
                                  
                                    // Obtener el total actual y el nuevo total con descuento aplicado
                                    let currentTotal = parseFloat($('#totalAmount').text());
                                    let discount = currentTotal * (response.discount_percentage / 100);
                                    let newTotal = currentTotal - discount;

                                    $('#discountInput').val('true');
                                    $('#totalDiscountedInput').val(newTotal);

                                    // Actualizar el HTML para mostrar el nuevo total con descuento aplicado
                                    $('#totalAmount').html('<del style="color: black;">' + currentTotal.toFixed(2) + '</del> <span style="color: red;">' + newTotal.toFixed(2) + '</span>');

                                } else {
                                    $('#invalidCoupon').show();
                                }
                            },
                            error: function(xhr, status, error) {
                                alert('Se produjo un error al aplicar el cupón. Por favor, inténtalo de nuevo.');
                            }
                        });
                    });
                });
            </script>

        </div>
        <div class="col-md-7 col-lg-8">
            <h4 class="mb-3">Billing address</h4>

            <select id="selectDireccion">
                @foreach($addresses as $address)
                <option value="{{ $address->id }}">{{ $address->street }}</option>
                @endforeach
            </select>

            <form class="needs-validation" method="POST" action="{{ route('confirmar.pedido') }}">
                @csrf
                <div class="row g-3">
                    <div class="col-12">

                        <input type="hidden" id="totalInput" name="total" value="{{ $totalPrice }}">
                        <input type="hidden" id="discountInput" name="discount" value="false">
                        <input type="hidden" id="totalDiscountedInput" name="totalDiscounted" value="{{ $totalPrice }}">

                        <label for="street" class="form-label">Street</label>
                        <input type="text" class="form-control direccion" id="street" name="street" value="{{ $addresses->isNotEmpty() ? $addresses->first()->street : '' }}" required="">
                        <div class="invalid-feedback">
                            Please enter your shipping street.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" class="form-control direccion" id="country" name="country" value="{{ $addresses->isNotEmpty() ? $addresses->first()->country : '' }}" required="">
                        <div class="invalid-feedback">
                            Please select a valid country.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control direccion" id="city" name="city" value="{{ $addresses->isNotEmpty() ? $addresses->first()->city : '' }}" required="">
                        <div class="invalid-feedback">
                            Please provide a valid city.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="zipcode" class="form-label">Zipcode</label>
                        <input type="text" class="form-control direccion" id="zipcode" name="zipcode" value="{{ $addresses->isNotEmpty() ? $addresses->first()->zipcode : '' }}" required="">
                        <div class="invalid-feedback">
                            Zip code required.
                        </div>
                    </div>
                </div>


                <script>
                    $(document).ready(function() {
                        $('#selectDireccion').change(function() {
                            let selectedAddressId = $(this).val();
                            let selectedAddress = {!!json_encode($addresses) !!}.find(address => address.id == selectedAddressId);
                            if (selectedAddress) {
                                $('#street').val(selectedAddress.street);
                                $('#country').val(selectedAddress.country);
                                $('#city').val(selectedAddress.city);
                                $('#zipcode').val(selectedAddress.zipcode);
                            }
                        });
                    });
                </script>

                <hr class="my-4">

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="same-address">
                    <label class="form-check-label" for="same-address">Shipping address is the same as my billing
                        address</label>
                </div>

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="save-info">
                    <label class="form-check-label" for="save-info">Save this information for next time</label>
                </div>

                <hr class="my-2">

                {{-- PAYMENT --}}
                <h4 class="mb-3">Payment</h4>

                <div class="my-3">
                    <div class="form-check">
                        <input id="credit" name="paymentMethod" type="radio" class="form-check-input"
                            checked="" required="">
                        <label class="form-check-label" for="credit">Credit card</label>
                    </div>
                    <div class="form-check">
                        <input id="debit" name="paymentMethod" type="radio" class="form-check-input"
                            required="">
                        <label class="form-check-label" for="debit">Debit card</label>
                    </div>
                    <div class="form-check">
                        <input id="paypal" name="paymentMethod" type="radio" class="form-check-input"
                            required="">
                        <label class="form-check-label" for="paypal">PayPal</label>
                    </div>
                </div>

                <div class="row gy-1">
                    <div class="col-md-6">
                        <label for="cc-name" class="form-label">Name on card</label>
                        <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                        <small class="text-muted">Full name as displayed on card</small>
                        <div class="invalid-feedback">
                            Name on card is required
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="cc-number" class="form-label">Credit card number</label>
                        <input type="text" class="form-control" id="cc-number" placeholder="" required="">
                        <div class="invalid-feedback">
                            Credit card number is required
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="cc-expiration" class="form-label">Expiration</label>
                        <input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
                        <div class="invalid-feedback">
                            Expiration date required
                        </div>
                    </div>

                    <div class="col-md-3">
                        <label for="cc-cvv" class="form-label">CVV</label>
                        <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                        <div class="invalid-feedback">
                            Security code required
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="container d-flex justify-content-center col-6 mb-4">
                    @if ($products->sum('pivot.quantity') > 0)
                        <button class="w-50 btn btn-dark col-6" type="submit">Confirm order</button>
                    @else
                        <button class="w-50 btn btn-dark btn-lg" type="submit" disabled>No products</button>
                    @endif
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
