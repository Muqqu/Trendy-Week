@extends('layouts.app2')

@section('title', 'Shopping Cart')

@section('extra-css')
   <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="https://js.stripe.com/v3/"></script>
<style>
    .quantity-input {
    display: flex;
    align-items: center;
}

.quantity-btn {
    background-color: #4CAF50; /* Green background */
    border: none; /* Remove borders */
    color: white; /* White text */
    padding: 2px 15px; /* Some padding */
    font-size: 16px; /* Set a font size */
    cursor: pointer; /* Mouse pointer on hover */
}

.quantity {
    width: 50px;
    text-align: center;
    font-size: 16px;
    border: 1px solid #ddd; /* Add a border */
    margin: 0 10px; /* Add some margin between the input and buttons */
}

</style>
@endsection


@section('content')

    <div class="cart-section container" style="margin-top: 131px;">
        <div>
            @if (session()->has('success_message'))
                <div class="alert alert-success">
                    {{ session()->get('success_message') }}
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (Cart::count() > 0)
                
                <h2 style="margin-top: 131px;">{{ Cart::count() }} item(s) in Shopping Cart</h2>

                <div class="cart-table">
                    @foreach (Cart::content() as $item)
                        <div class="cart-table-row">
                            <div class="cart-table-row-left">
                                <a href="{{ route('shop.show', $item->model->slug) }}"><img src="{{asset('img/products/'.$item->model->image)}}" alt="item" class="cart-table-img"></a>
                                <div class="cart-item-details">
                                    <div class="cart-table-item"><a href="{{ route('shop.show', $item->model->slug) }}">{{ $item->model->name }}</a></div>
                                    <div class="cart-table-description">{{ $item->model->details }}</div>
                                </div>
                            </div>
                            <div class="cart-table-row-right">
                                <div class="cart-table-actions">
                                    <form action="{{ route('cart.destroy', $item->rowId) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="cart-options">Remove</button>
                                    </form>
                                    <form action="{{ route('cart.switchToSaveForLater', $item->rowId) }}" method="POST">
                                        {{ csrf_field() }}
                                        <button type="submit" class="cart-options">Save for Later</button>
                                    </form>
                                </div>
                                
                                <div class="quantity-input">
                                    <div type="button" onclick="decrementQuantity('{{ $item->model->id }}')">-</div>
                                    <input type="number" id="quantity{{ $item->model->id }}" class="quantity" name="quantity" min="1" max="10" value="{{$item->qty}}" required
                                        data-id="{{ $item->rowId }}" data-price="{{$item->model->price}}" data-productQuantity="{{$item->model->quantity}}">
                                    <div type="button" onclick="incrementQuantity('{{ $item->model->id }}')">+</div>
                                </div>
                                <div id ="subtotal{{ $item->model->id }}">£{{ $item->subtotal }}</div>
                            </div>
                        </div> <!-- end cart-table-row -->
                    @endforeach
                </div> <!-- end cart-table -->

                @if (! session()->has('coupon'))
                  <a href="#" class="have-code">Have a Code?</a>

                  <div class="have-code-container">
                    <form action="{{ route('coupon.store') }}" method="POST">
                      {{ csrf_field() }}
                      <input type="text" name="coupon_code" id="coupon_code">
                      <button type="submit" class="button button-plain">Apply</button>
                    </form>
                  </div> <!-- end have-code-container -->
                @endif

                <div class="cart-totals">
                    <div class="cart-totals-left">
                        Shipping is free because we’re awesome like that. Also because that’s additional stuff I don’t feel like figuring out :).
                    </div>

                    <div class="cart-totals-right">
                        <div>
                            <!--Subtotal <br>-->
                            @if (session()->has('coupon'))
                                Code ({{ session()->get('coupon')['name'] }})
                                <form action="{{ route('coupon.destroy') }}" method="POST" style="display: inline">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button type="submit" style="font-size: 14px">Remove</button>
                                </form>
                                <br>
                                <hr>
                                New Subtotal <br>
                            @endif
                            <!--Tax (13%)<br>-->
                            <span class="cart-totals-total">Total</span>
                        </div>
                        <div class="cart-totals-subtotal">
                            <!--${{ Cart::subtotal() }} <br>-->
                            @if (session()->has('coupon'))
                                -{{ $discount }} <br>
                                <hr>
                                £{{ $newSubtotal }} <br>
                            @endif
                            <!--${{ $newTax }} <br>-->
                            <!--<span class="cart-totals-total">${{ $newTotal }}</span>-->
                            <input type="hidden" id="grand_total" value="{{ $newSubtotal }}">
                            <span class="cart-totals-total" id="total">£{{ $newSubtotal }}</span>
                        </div>
                    </div>
                </div> <!-- end cart-totals -->

                <div class="cart-buttons">
                    <a href="{{ route('shop.index') }}" class="button">Continue Shopping</a>
                    <a href="{{ route('guestCheckout.index') }}" class="button-primary">Proceed to Checkout</a>
                </div>

            @else
                <h3>No items in Cart!</h3>
                <div class="spacer"></div>
                <a href="{{ route('shop.index') }}" class="button">Continue Shopping</a>
                <div class="spacer"></div>
            @endif

            @if (Cart::instance('saveForLater')->count() > 0)

                <h2>{{ Cart::instance('saveForLater')->count() }} item(s) Saved For Later</h2>

                <div class="saved-for-later cart-table">
                    @foreach (Cart::instance('saveForLater')->content() as $item)
                        <div class="cart-table-row">
                            <div class="cart-table-row-left">
                                <a href="{{ route('shop.show', $item->model->slug) }}"><img src="{{ productImage($item->model->image) }}" alt="item" class="cart-table-img"></a>
                                <div class="cart-item-details">
                                    <div class="cart-table-item"><a href="{{ route('shop.show', $item->model->slug) }}">{{ $item->model->name }}</a></div>
                                    <div class="cart-table-description">{{ $item->model->details }}</div>
                                </div>
                            </div>
                            <div class="cart-table-row-right">
                                <div class="cart-table-actions">
                                    <form action="{{ route('saveForLater.destroy', $item->rowId) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="cart-options">Remove</button>
                                    </form>
                                    <form action="{{ route('saveForLater.switchToCart', $item->rowId) }}" method="POST">
                                        {{ csrf_field() }}
                                        <button type="submit" class="cart-options">Move to Cart</button>
                                    </form>
                                </div>
                                <div>{{ $item->model->presentPrice() }}</div>
                            </div>
                        </div> <!-- end cart-table-row -->
                    @endforeach

                </div> <!-- end saved-for-later -->

            @else

            <h3>You have no items Saved for Later.</h3>

            @endif
        </div>

    </div> <!-- end cart-section -->


@endsection

@section('extra-js')
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
const classname = document.querySelectorAll('.quantity');

        function updateQuantity(id, newQuantity,data_id,op) {
            const productQuantity = document.getElementById('quantity'+data_id).getAttribute('data-productQuantity');
            const productPrice = document.getElementById('quantity'+data_id).getAttribute('data-price');
            const total = newQuantity*productPrice;
            const grand_total = document.getElementById('grand_total').value;
            var new_total = parseFloat(grand_total)+parseFloat(productPrice);
            
            if(op === "dec"){
            var new_total = parseFloat(grand_total)-parseFloat(productPrice);
            }
            document.getElementById('total').innerHTML = "£ "+new_total.toFixed(2);
            document.getElementById('grand_total').value = new_total.toFixed(2);
            axios.patch(`/cart/${id}`, {
                quantity: newQuantity,
                productQuantity: productQuantity
            })
                .then(function (response) {
                    // Redirect to the cart page after successful update
                   // window.location.href = '{{ route('cart.index') }}';
                   document.getElementById('subtotal'+data_id).innerHTML = "£ "+total.toFixed(2);
                })
                .catch(function (error) {
                    // Redirect to the cart page even if there is an error
                    window.location.href = '{{ route('cart.index') }}';
                });
        }
    function incrementQuantity(data_id) {
  
        const quantityInput = document.getElementById('quantity'+data_id);
        //const quantity = document.getElementById('qty');
            const currentQuantity = parseInt(quantityInput.value, 10);
          
            const maxQuantity = parseInt(quantityInput.max, 10);

            if (currentQuantity < maxQuantity) {
                const newQuantity = currentQuantity + 1;
                quantityInput.value = newQuantity;
                //quantity.value = newQuantity;
                const id = quantityInput.getAttribute('data-id');
                updateQuantity(id, newQuantity,data_id,"inc");
            }
    }

    function decrementQuantity(data_id) {
         const quantityInput = document.getElementById('quantity'+data_id);
         //const quantity = document.getElementById('qty');
            const currentQuantity = parseInt(quantityInput.value, 10);

            if (currentQuantity > 1) {
                const newQuantity = currentQuantity - 1;
                quantityInput.value = newQuantity;
               // quantity.value = newQuantity;
                const id = quantityInput.getAttribute('data-id');
                updateQuantity(id, newQuantity,data_id,"dec");
            }
    }
</script>
    <script>
        (function(){
            const classname = document.querySelectorAll('.quantity')

            Array.from(classname).forEach(function(element){
                element.addEventListener('change', function(){
                    const id = element.getAttribute('data-id')
                    const productQuantity = element.getAttribute('data-productQuantity')

                    axios.patch(`/cart/${id}`, {
                        quantity: this.value,
                        productQuantity: productQuantity
                    })
                    .then(function (response) {
                        // console.log(response);
                       // window.location.href = '{{ route('cart.index') }}'
                    })
                    .catch(function (error) {
                        // console.log(error);
                      //  window.location.href = '{{ route('cart.index') }}'
                    });
                })
            })
        })();
    </script>
@endsection

@section('extra-js')
    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('js/algolia.js') }}"></script>
@endsection