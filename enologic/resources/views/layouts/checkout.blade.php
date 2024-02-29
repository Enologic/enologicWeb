@extends('layouts.general')

@section('checkout')

@php
$totalQuantity = 0;
foreach ($products as $product) {
$totalQuantity += $product->pivot->quantity;
}
@endphp

<div class="container d-flex my-5 mb-0">

    <h1 class="col-9">Confirm Checkout</h1>

    <div class="col-3 text-end">
        {{-- Boton para volver a DASHBOARD --}}
        <a class="btn btn-dark mb-3" href="{{ url('/cart') }}">
            <i class="fa-solid fa-rotate-left"></i>
        </a>

    </div>

</div>

<div class="container">
    <div class="row g-5 mt-1">
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
                    <span class="text-muted">{{ $product->price }}€</span>
                    <span class="text-muted">x{{ $product->pivot->quantity }}</span>
                </li>
                @endforeach
            </ul>

            <!-- Mostrar el precio total -->
            <div class="d-flex justify-content-between">
                <strong> Total {{ number_format($totalPrice, 2) }}€</strong>
            </div>


            <form class="card p-2">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Promo code">
                    <button type="submit" class="btn btn-secondary">Redeem</button>
                </div>
                <div class="text-center">
                    <!-- Botón para vaciar el carrito -->
                    <button class="col-3 col-md-5 col-lg-4 btn btn-danger mt-3" onclick="clearCart()">Remove</button>
                </div>
            </form>

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
</form>

<script>
    $(document).ready(function() {
        $('#selectDireccion').change(function() {
            let selectedAddressId = $(this).val();
            let selectedAddress = {!! json_encode($addresses) !!}.find(address => address.id == selectedAddressId);
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

                <hr class="my-4">

                <h4 class="mb-3">Payment</h4>

                <div class="my-3">
                    <div class="form-check">
                        <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked="" required="">
                        <label class="form-check-label" for="credit">Credit card</label>
                    </div>
                    <div class="form-check">
                        <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required="">
                        <label class="form-check-label" for="debit">Debit card</label>
                    </div>
                    <div class="form-check">
                        <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required="">
                        <label class="form-check-label" for="paypal">PayPal</label>
                    </div>
                </div>

                <div class="row gy-3">
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

                <div class="container d-flex justify-content-center col-6 mb-5">
                    @if ($products->sum('pivot.quantity') > 0)
                    <button class="w-50 btn btn-dark btn-lg mb-5" type="submit">Confirm order</button>
                    @else
                    <button class="w-50 btn btn-dark btn-lg mb-5" type="submit" disabled>No products</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

@endsection