@extends('layouts.app2')

@section('title', 'Checkout')

@section('extra-css')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">


<style>
    .card-container {
        display: flex;
        justify-content: center;
        background-color: white
    }

    .card {
        width: 400px;
        border: 1px solid #ccc;
        border-radius: 8px;
        overflow: hidden;
    }

    .card-header {
        background-color: #f8f9fa;
        padding: 10px;
        text-align: center;
        border-bottom: 1px solid #ccc;
    }

    .card-body {
        padding: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-row {
        display: flex;
    }

    .form-group label {
        font-weight: bold;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    
</style>
@endsection

@section('content')

<div class="container" style="margin-top: 131px;">

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

    <h1 class="checkout-heading stylish-heading">Checkout</h1>
    <div class="row">
      
        <div style="display: inline-block;
border-radius: 0pt;
-webkit-appearance: -apple-pay-button;
-apple-pay-button-type: plain;
-apple-pay-button-style: white-outline;"
lang=en></div>

        <div id="payment-request-button"  class="col-md-2">
                <!-- A Stripe Element will be inserted here. -->
            </div>
        
    </div>
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('checkout.store') }}" method="POST" id="payment-form">
                {{ csrf_field() }}
                <h2>Billing Details</h2>
                    
                <div class="form-group">
                    <label for="email">Email Address</label>
                    @if (auth()->user())
                    <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}"
                        readonly>
                    @else
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"
                        required>
                    @endif
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label for="address">Street Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}"
                        required>
                </div>

                <div class="half-form">
                    <div class="form-group">
                        <label for="postalcode">Postal Code</label>
                        <input type="text" class="form-control" id="postalcode" name="postalcode"
                            value="{{ old('postalcode') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="region">Region</label>
                        <input type="text" class="form-control" id="religion" name="religion"
                            value="{{ old('religion') }}" required>
                    </div>

                </div> <!-- end half-form -->

                <div class="half-form">

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}"
                            required>
                    </div>

                </div> <!-- end half-form -->
                <div class="form-group">
                    <label for="country">Country</label>
                    <select class="form-control" id="country" name="country">
                        <option value="United Kingdom" selected>United Kingdom</option>
                    </select>
                </div>

                <div class="spacer"></div>



                <h4>Card Information</h4>


                <div class="form-group">
                    <label for="cardHolderName">Name on Card</label>
                    <input type="text" class="form-control" id="cardHolderName" name="cardHolderName" value="">
                    @if($buy_now)
                    <input type="hidden" class="form-control" id="amount" name="amount"
                        value="{{ $item_qty*$item_price}}">
                    @else
                    <input type="hidden" class="form-control" id="amount" name="amount" value="{{$newSubtotal }}">
                    @endif

                </div>

                <div class="form-group" style = "margin-bottom: 0px;">

                    <span class="field">
                        <label for="ccnum">Card Number</label>
                        <input placeholder="1234 1234 1234 1234" type="tel" size="19" name="card_no" value=""
                            id="ccnum">
                    </span>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">

                        <input placeholder="MM / YYYY" size="7" type="tel" name="ccExpiryMonth" value="" id="expiry">
                    </div>

                    <div class="form-group col-md-6">

                        <input placeholder="CVC" size="4" type="tel" name="cvvNumber" value="" id="cvc">
                    </div>
                </div>


                <!--<small>type: <strong id="ccnum-type">invalid</strong></small></div>-->
                <div class="spacer"></div>

                <button type="submit" id="complete-order" class="button-primary full-width mb-5">Complete Order</button>


            </form>

            {{--<div class="mt-32">or</div>
            <div class="mt-32">
                <h2>Pay with PayPal</h2>

                <form method="post" id="paypal-payment-form" action="{{ route('checkout.paypal') }}">
                    @csrf
                    <section>
                        <div class="bt-drop-in-wrapper">
                            <div id="bt-dropin"></div>
                        </div>
                    </section>

                    <input id="nonce" name="payment_method_nonce" type="hidden" />
                    <button class="button-primary" type="submit"><span>Pay with PayPal</span></button>
                </form>
            </div>--}}
        </div>



        <div class="checkout-table-container col-md-6">
            <h2>Your Order</h2>

            <div class="checkout-table">
                @if($buy_now)
                <div class="checkout-table-row">
                    <div class="checkout-table-row-left">
                        <img src="{{asset('img/products/'.$item_image)}}" alt="item" class="checkout-table-img">
                        <div class="checkout-item-details">
                            <div class="checkout-table-item">{{ $item_name }}</div>
                            <div class="checkout-table-description">{{ $item_detail}}</div>
                            <div class="checkout-table-price">${{ $item_price}}</div>
                        </div>
                    </div> <!-- end checkout-table -->

                    <div class="checkout-table-row-right">
                        <div class="checkout-table-quantity">{{ $item_qty }}</div>
                    </div>
                </div>
                @else
                @foreach (Cart::content() as $item)
                <div class="checkout-table-row">
                    <div class="checkout-table-row-left">
                        <img src="{{asset('img/products/'.$item->model->image)}}" alt="item" class="checkout-table-img">
                        <div class="checkout-item-details">
                            <div class="checkout-table-item">{{ $item->model->name }}</div>
                            <div class="checkout-table-description">{{ $item->model->details }}</div>
                            <div class="checkout-table-price">£{{ $item->model->price }}</div>
                        </div>
                    </div> <!-- end checkout-table -->

                    <div class="checkout-table-row-right">
                        <div class="checkout-table-quantity">{{ $item->qty }}</div>
                    </div>
                </div> <!-- end checkout-table-row -->
                @endforeach
                @endif

            </div> <!-- end checkout-table -->
            @if($buy_now)
            <div class="checkout-totals">
                <div class="checkout-totals-left">
                    <!--Subtotal <br>-->
                    @if (session()->has('coupon'))
                    Discount ({{ session()->get('coupon')['name'] }}) :
                    <br>
                    <hr>
                    New Subtotal <br>
                    @endif
                    <!--Tax ({{config('cart.tax')}}%)<br>-->
                    <span class="checkout-totals-total">Total</span>

                </div>

                <div class="checkout-totals-right">
                    <!--${{ Cart::subtotal() }} <br>-->
                    @if (session()->has('coupon'))
                    - £{{ $discount }} <br>
                    <hr>
                    £{{ $newSubtotal }} <br>
                    @endif
                    <!--{{ presentPrice($newTax) }} <br>-->
                    <!--<span class="checkout-totals-total">${{$newTotal }}</span>-->
                    <span class="checkout-totals-total">£{{ $item_qty*$item_price }}</span>

                </div>
            </div>
            @else
            <div class="checkout-totals">
                <div class="checkout-totals-left">
                    <!--Subtotal <br>-->
                    @if (session()->has('coupon'))
                    Discount ({{ session()->get('coupon')['name'] }}) :
                    <br>
                    <hr>
                    New Subtotal <br>
                    @endif
                    <!--Tax ({{config('cart.tax')}}%)<br>-->
                    <span class="checkout-totals-total">Total</span>

                </div>

                <div class="checkout-totals-right">
                    <!--${{ Cart::subtotal() }} <br>-->
                    @if (session()->has('coupon'))
                    - ${{ $discount }} <br>
                    <hr>
                    ${{ $newSubtotal }} <br>
                    @endif
                    <!--${{ $newTax }} <br>-->
                    <!--<span class="checkout-totals-total">${{ $newTotal }}</span>-->
                    <span class="checkout-totals-total">£{{ $newSubtotal }}</span>

                </div>
            </div> <!-- end checkout-totals -->
            @endif
        </div>

    </div> <!-- end checkout-section -->
</div>

@endsection

@section('extra-js')
<script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
<script src="
https://cdn.jsdelivr.net/npm/payform@1.4.0/dist/payform.min.js
"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
 var stripe = Stripe('pk_live_ojDcs16o0cACPf2jzleAr3Wl');
        const paymentRequest = stripe.paymentRequest({
  country: 'US',
  currency: 'gbp',
  total: {
    label: 'Demo total',
    amount: 109,
  },
  requestPayerName: true,
  requestPayerEmail: true,
});

const elements = stripe.elements();
const prButton = elements.create('paymentRequestButton', {
  paymentRequest,
});

(async () => {
  // Check the availability of the Payment Request API first.
  const result = await paymentRequest.canMakePayment();
  if (result) {
    prButton.mount('#payment-request-button');
  } else {
    document.getElementById('payment-request-button').style.display = 'none';
  }
})();

paymentRequest.on('paymentmethod', async (ev) => {
  // Confirm the PaymentIntent without handling potential next actions (yet).
  const {paymentIntent, error: confirmError} = await stripe.confirmCardPayment(
    clientSecret,
    {payment_method: ev.paymentMethod.id},
    {handleActions: false}
  );

  if (confirmError) {
    // Report to the browser that the payment failed, prompting it to
    // re-show the payment interface, or show an error message and close
    // the payment interface.
    ev.complete('fail');
  } else {
    // Report to the browser that the confirmation was successful, prompting
    // it to close the browser payment method collection interface.
    ev.complete('success');
    // Check if the PaymentIntent requires any actions and, if so, let Stripe.js
    // handle the flow. If using an API version older than "2019-02-11"
    // instead check for: `paymentIntent.status === "requires_source_action"`.
    if (paymentIntent.status === "requires_action") {
      // Let Stripe.js handle the rest of the payment flow.
      const {error} = await stripe.confirmCardPayment(clientSecret);
      if (error) {
        // The payment failed -- ask your customer for a new payment method.
      } else {
        // The payment has succeeded -- show a success message to your customer.
      }
    } else {
      // The payment has succeeded -- show a success message to your customer.
    }
  }
});




    (function () {
        var ccnum = document.getElementById('ccnum'),
            type = document.getElementById('ccnum-type'),
            expiry = document.getElementById('expiry'),
            cvc = document.getElementById('cvc'),
            submit = document.getElementById('omplete-order'),
            result = document.getElementById('result');

        payform.cardNumberInput(ccnum);
        payform.expiryInput(expiry);
        payform.cvcInput(cvc);

        ccnum.addEventListener('input', updateType);

        submit.addEventListener('click', function () {
            var valid = [],
                expiryObj = payform.parseCardExpiry(expiry.value);

            valid.push(fieldStatus(ccnum, payform.validateCardNumber(ccnum.value)));
            valid.push(fieldStatus(expiry, payform.validateCardExpiry(expiryObj)));
            valid.push(fieldStatus(cvc, payform.validateCardCVC(cvc.value, type.innerHTML)));

            result.className = 'emoji ' + (valid.every(Boolean) ? 'valid' : 'invalid');
        });

        function updateType(e) {
            var cardType = payform.parseCardType(e.target.value);
            type.innerHTML = cardType || 'invalid';
        }


        function fieldStatus(input, valid) {
            if (valid) {
                removeClass(input.parentNode, 'error');
            } else {
                addClass(input.parentNode, 'error');
            }
            return valid;
        }

        function addClass(ele, _class) {
            if (ele.className.indexOf(_class) === -1) {
                ele.className += ' ' + _class;
            }
        }

        function removeClass(ele, _class) {
            if (ele.className.indexOf(_class) !== -1) {
                ele.className = ele.className.replace(_class, '');
            }
        }
    })();

    // credit card input end
</script>
<!--    <script>-->
<!--        (function(){-->
<!--               var stripe = Stripe('pk_test_51NavTdAuNPjg0O2ln7rOs7U7Ja1zFQwuccWLXOJebeOYR9JZnPMfkAwB5FSBZJ9bvBxYU7WV4hyYdIUoXDPywie3007otV7Ehm');-->

<!--    var elements = stripe.elements();-->
<!--    var card = elements.create('card');-->

<!--    card.mount('#card-element');-->

<!--    var form = document.getElementById('payment-form');-->

<!--    form.addEventListener('submit', function (event) {-->
<!--        event.preventDefault();-->

<!--        stripe.createToken(card).then(function (result) {-->
<!--            console.log(result);-->
<!--            if (result.error) {-->
// Handle errors
<!--            } else {-->
// Send the token to your server
<!--                fetch('/create-token', {-->
<!--                    method: 'POST',-->
<!--                    headers: {-->
<!--                        'Content-Type': 'application/json',-->
<!--                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),-->
<!--                    },-->
<!--                    body: JSON.stringify({-->
<!--                        card_number: result.token.card.number,-->
<!--                        exp_month: result.token.card.exp_month,-->
<!--                        exp_year: result.token.card.exp_year,-->
<!--                        cvc: result.token.card.cvc,-->
<!--                    }),-->
<!--                })-->
<!--                .then(response => response.json())-->
<!--                .then(data => {-->
// Handle the response from your server
<!--                    console.log(data);-->
<!--                });-->
<!--            }-->
<!--        });-->
<!--    });-->
<!--        })();-->
<!--    </script>-->
@endsection