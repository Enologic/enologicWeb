@extends('layouts.template')

@section('general')
    {{-- HEADER --}}
    <nav>
    </nav>
    @php
    $totalQuantity = 0;
    foreach ($products as $product) {
     $totalQuantity += $product->pivot->quantity;
    }
    @endphp

    <div class="container">
        <div class="row g-5 mt-1">
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Your cart</span>
                    <span class="badge bg-primary rounded-pill">{{ $totalQuantity }}</span>
                </h4>
                <ul class="list-group mb-3">
                    <!-- Iterar sobre los productos del carrito -->
                    @foreach($products as $product)
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">{{ $product->product_name }}</h6>
                                <!-- Quité la descripción -->
                            </div>
                            <span class="text-muted">{{ $product->price }}€</span>
                            <span class="text-muted">x{{$product->pivot->quantity}}</span>
                        </li>
                    @endforeach
                </ul>

                <form class="card p-2">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Promo code">
                        <button type="submit" class="btn btn-secondary">Redeem</button>
                    </div>
                </form>

                <!-- Botón para vaciar el carrito -->
                <button class="btn btn-danger mt-3" onclick="clearCart()">Clear cart</button>
            </div>
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Billing address</h4>
                <form class="needs-validation" method="POST" action="{{ route('confirmar.pedido') }}">
                    @csrf
                    <div class="row g-3">

                      <div class="col-12">
                        <label for="address" class="form-label">Street</label>
                        <input type="text" class="form-control" id="street" name="street" placeholder="1234 Main St" required="">
                        <div class="invalid-feedback">
                          Please enter your shipping street.
                        </div>
                      </div>



                      <div class="col-md-6">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" class="form-control" id="country" name="country"placeholder="Spain" required="">
                        <div class="invalid-feedback">
                          Please select a valid country.
                        </div>
                      </div>

                      <div class="col-md-6">
                        <label for="city" class="form-label">City</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="Sevilla" required="">
                        <div class="invalid-feedback">
                          Please provide a valid state.
                        </div>
                      </div>

                      <div class="col-md-6">
                        <label for="state" class="form-label">State</label>
                        <input type="text" class="form-control" id="state" name="state" placeholder="Burguillos" required="">
                        <div class="invalid-feedback">
                          Please provide a valid state.
                        </div>
                      </div>

                      <div class="col-md-6">
                        <label for="zipcode" class="form-label">Zipcode</label>
                        <input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="41019" required="">
                        <div class="invalid-feedback">
                          Zip code required.
                        </div>
                      </div>
                    </div>

                    <hr class="my-4">

                    <div class="form-check">
                      <input type="checkbox" class="form-check-input" id="same-address">
                      <label class="form-check-label" for="same-address">Shipping address is the same as my billing address</label>
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

                    <button class="w-100 btn btn-primary btn-lg mb-5" type="submit">Continue to checkout</button>
                </form>
            </div>
        </div>
    </div>
    <footer>
    </footer>
@endsection