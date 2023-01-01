@extends('layouts.app')
@section('content')
        <div class="main-content" style="margin-top: 131px;">
            <section class="checkout-sec default-sec">
                <div class="container">
                    <div class="accordion custom-accordion custom-accordion-2 mb-3 d-lg-none"
                        id="orderSummaryTopAccordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#orderSummaryTopAccordion" aria-expanded="true"
                                    aria-controls="orderSummaryTopAccordion">
                                    <div class="d-flex w-100 justify-content-between align-items-center">
                                        <span class="show-btn">Show order summary</span>
                                        <span class="fs-6">$70</span>
                                    </div>
                                </button>
                            </h2>
                            <div id="orderSummaryTopAccordion" class="accordion-collapse collapse"
                                data-bs-parent="#orderSummaryTopAccordionExample">
                                <div class="accordion-body">
                                    <ul class="order-summary-list mb-3 d-lg-none checkout-items1">
                                       
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            @if (session()->has('success_message'))
                                <div class="spacer"></div>
                                <div class="alert alert-success">
                                    {{ session()->get('success_message') }}
                                </div>
                                @endif

                                @if(count($errors) > 0)
                                <div class="spacer"></div>
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{!! $error !!}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            <form action="{{ route('checkout.store') }} " method="POST" id="payment-form">
                                @csrf
                                <div class="custom-card">
                                    <h3 class="title">Contact</h3>
                                    <div class="input-wrapper">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email">
                                    </div>
                                    <div class="form-check input-wrapper mb-4">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked name="sameShippingAddress">
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Email me with news and offers
                                        </label>
                                    </div>
                                </div>
                                <div class="custom-card">
                                    <h3 class="title">Delivery</h3>
                                    <div class="input-wrapper">
                                        <select class="form-select" name="country">
                                            <option value="1">United Kingdom</option>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-wrapper">
                                                <label for="fName" class="form-label">First name</label>
                                                <input type="text" class="form-control" id="fName" name="first_name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-wrapper">
                                                <label for="lName" class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="lName" name="last_name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-wrapper">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control " id="address" name="address">
                                    </div>
                                    <div class="input-wrapper">
                                        <a href="javascript:void(0);" id="optionalAddressToggle" class="text-decoration-none">+ Add apartment, suite, etc.</a>
                                    </div>
                                    <div id="optionalAddressBox" style="display: none;">
                                        <div class="input-wrapper">
                                            <label for="optionalAddress" class="form-label">Apartment, suite, etc. (optional)</label>
                                            <input type="text" class="form-control" id="optionalAddress" name="optionalBillingAddress">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-wrapper">
                                                <label for="city" class="form-label">City</label>
                                                <input type="text" class="form-control" id="city" name="city">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-wrapper">
                                                <label for="postcode" class="form-label">Postcode</label>
                                                <input type="text" class="form-control" id="postcode" name="postalcode">
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="subtitle">Shipping method</h4>
                                    <div class="card bg-light mb-4">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="card-text mb-0">Insured Shipping</p>
                                                <p class="card-text mb-0"><b>Free</b></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="custom-card">
                                    <h3 class="title">Payment</h3>
                                    <p class="text-muted">All transactions are secure and encrypted.</p>
                                    <div class="accordion mb-4" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    <div class="d-flex justify-content-between w-100">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <input class="form-check-input" type="radio"
                                                                name="flexRadioDefault" id="creditCardAccordion"
                                                                checked>
                                                                Credit card
                                                            
                                                        </div>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <img src="./assets/img/webp/visa.webp" alt="">
                                                            <img src="./assets/img/webp/master.webp" alt="">
                                                            <img src="./assets/img/webp/amex.webp" alt="">
                                                            <img src="./assets/img/webp/discover.webp" alt="">
                                                        </div>
                                                    </div>
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body bg-light">
                                                    @if($buy_now)
                                                    <input type="hidden" name ="product_id" value="{{$item_id}}">
                                                    <input type="hidden" name ="quantity" value="{{$item_qty}}">
                                                        <input type="hidden" class="form-control" id="bamount" name="amount"
                                                            value="{{ $item_qty*$item_price}}">
                                                        @else
                                                        <input type="hidden" name="cart" id="cart-input">
                                                        <input type="hidden" class="form-control" id="amount" name="amount" value="">
                                                        @endif
                                                    <div class="input-wrapper">
                                                        <label for="ccnum" class="form-label">Card Number</label>
                                                        <input type="tel" size="19" name="card_no" value=""
                                                            id="ccnum" class="form-control " >
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="input-wrapper">
                                                                <label for="expDate" class="form-label">Expiration date
                                                                    (MM / YY)</label>
                                                                <input type="text" class="form-control " name="ccExpiryMonth" value="" id="expiry">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="input-wrapper">
                                                                <label for="securityCode" class="form-label">Security
                                                                    code</label>
                                                                <input type="text" class="form-control "
                                                                name="cvvNumber" value="" id="cvc">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="input-wrapper">
                                                        <label for="cardName" class="form-label" id="cardHolderName"  value="">Name on card</label>
                                                        <input type="text" class="form-control " name="cardHolderName" id="cardName">
                                                    </div>
                                                    <div class="form-check input-wrapper mb-4">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            id="sameShippingAddress">
                                                        <label class="form-check-label" for="sameShippingAddress">
                                                            Use shipping address as billing address
                                                        </label>
                                                    </div>
                                                    <div id="sameShippingAddressBox" class="d-block"
                                                        style="display: none;">
                                                        <h3 class="subtitle">Billing Address</h3>
                                                        <div class="input-wrapper">
                                                            <select class="form-select">
                                                                <option value="1">United Kingdom</option>
                                                            </select>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="input-wrapper">
                                                                    <label for="billingfName" class="form-label">First
                                                                        name</label>
                                                                    <input type="text" class="form-control"
                                                                    name="billing_fname"
                                                                        id="billingfName">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-wrapper">
                                                                    <label for="billinglName" class="form-label">Last
                                                                        Name</label>
                                                                    <input type="text" class="form-control"
                                                                    name="billing_name" id="billinglName">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="input-wrapper">
                                                            <label for="billingAddress"
                                                                class="form-label">Address</label>
                                                            <input type="text" class="form-control "
                                                            name="billingAddress"
                                                                id="billingAddress">
                                                        </div>
                                                        <div class="input-wrapper">
                                                            <a href="javascript:void(0);"
                                                                id="optionalBillingAddressToggle"
                                                                class="text-decoration-none">+ Add apartment, suite,
                                                                etc.</a>
                                                        </div>
                                                        <div id="optionalBillingAddressBox" style="display: none;">
                                                            <div class="input-wrapper">
                                                                <label for="optionalBillingAddress"
                                                                    class="form-label">Apartment, suite, etc.
                                                                    (optional)</label>
                                                                <input type="text" class="form-control"
                                                                    id="optionalBillingAddress">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="input-wrapper">
                                                                    <label for="billingCity"
                                                                        class="form-label">City</label>
                                                                    <input type="text" class="form-control"
                                                                        id="billingCity">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="input-wrapper">
                                                                    <label for="billingPostcode"
                                                                        class="form-label">Postcode</label>
                                                                    <input type="text" class="form-control"
                                                                        id="billingPostcode">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                    aria-expanded="false" aria-controls="collapseTwo">
                                                    <div class="d-flex justify-content-between w-100">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <input class="form-check-input" type="radio"
                                                                name="flexRadioDefault" id="googlePayBtn">
                                                            Google Pay
                                                        </div>
                                                        <img src="./assets/img/webp/gpay.webp" alt=""
                                                            style="max-width: 40px; height: 16px;">
                                                    </div>
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body bg-light">
                                                    <p class="text-center mb-0" style="font-size: 12px;">After clicking
                                                        "Pay with Google Pay", you will be redirected to google pay to
                                                        complete your purchase securely.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                    aria-expanded="false" aria-controls="collapseThree">
                                                    <div class="d-flex justify-content-between w-100">
                                                        <div class="d-flex align-items-center gap-2">
                                                            <input class="form-check-input" type="radio"
                                                                name="flexRadioDefault" id="paypalBtn">
                                                            Paypal
                                                        </div>
                                                        <img src="./assets/img/webp/paypal.webp" alt=""
                                                            style="max-width: 60px; height: 16px;">
                                                    </div>
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body bg-light">
                                                    <p class="text-center mb-0" style="font-size: 12px;">After clicking
                                                        "Pay with PayPal", you will be redirected to PayPal to complete
                                                        your purchase securely.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary py-3 w-100" id="checkoutSubmitBtn" type="submit">Pay Now</button>
                                </div>
                            </form>
                        </div>
                        <div class="offset-lg-1 col-lg-5">
                            <div class="custom-card">
                                <div class="accordion custom-accordion mb-3 d-lg-none"
                                    id="orderSummaryBottomAccordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#orderSummaryBottomAccordion"
                                                aria-expanded="true" aria-controls="orderSummaryBottomAccordion">
                                                <div class="d-flex w-100 justify-content-between align-items-center">
                                                    <h3 class="title mb-0">Order summary (2)</h3>
                                                    <span class="show-btn">show</span>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="orderSummaryBottomAccordion" class="accordion-collapse collapse"
                                            data-bs-parent="#orderSummaryBottomAccordionExample">
                                            <div class="accordion-body">
                                                <ul class="order-summary-list mb-3 d-lg-none checkout-items2">
                                                    <li class="list-item">
                                                        <div class="d-flex justify-content-between gap-2">
                                                            <div class="d-flex gap-3">
                                                                <img src="https://trendyweek.site/img/products/1701162935_Hf976bcbee3c44999b47b64a52506cfcdT.webp"
                                                                    alt="">
                                                                <h3 class="title">
                                                                    Rail Car Puzzel Toys Gifts Toy DIY Assemble Jigsaw
                                                                    Flexible Railway Track Parent-child Interaction Toy
                                                                    Electric Track
                                                                </h3>
                                                            </div>
                                                            <h3 class="price">20$</h3>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if(!$buy_now)
                                <ul class="order-summary-list mb-3 d-none d-lg-block checkout-items3">
                                    
                                </ul>
                                @else
                                <ul class="order-summary-list mb-3 d-none d-lg-block">
                                    <li class="list-item">
                                        <div class="d-flex justify-content-between gap-2">
                                            <div class="d-flex gap-3">
                                                <img src="{{asset('img/products/'.$item_image)}}"
                                                    alt="">
                                                <h3 class="title">
                                                    {{ $item_name }}
                                                </h3>
                                            </div>
                                            <h3 class="price">£{{ $item_price}}</h3>
                                        </div>
                                    </li>  
                                </ul>
                                @endif
                                <div class="input-wrapper input-group">
                                    <input type="text" class="form-control" placeholder="Coupon code">
                                    <a href="#" class="btn btn-primary d-flex align-items-center">Apply</a>
                                </div>
                                @if($buy_now)
                                <div class="d-flex justify-content-between">
                                    <p class="total-title mb-2">Subtotal</p>
                                    <p class="total-title mb-2">£{{ $item_qty*$item_price }}</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="total-title mb-2">Shipping</p>
                                    <p class="total-title mb-2">Free</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="total-title text-dark mb-2">Total</h6>
 
                                    <h6 class="total-title text-dark mb-2 " >£{{ $item_qty*$item_price }}</h6>
                                </div>
                                @else
                                <div class="d-flex justify-content-between">
                                    <p class="total-title mb-2">Subtotal</p>
                                    <p class="total-title mb-2" id="checkout-subtotal">£70.00</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="total-title mb-2">Shipping</p>
                                    <p class="total-title mb-2">Free</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h6 class="total-title text-dark mb-2">Total</h6>
 
                                    <h6 class="total-title text-dark mb-2 " id="checkout-total"></h6>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
@endsection
@section('extra-js')
<script src="{{asset('js/checkout.js')}}"></script>
@endsection