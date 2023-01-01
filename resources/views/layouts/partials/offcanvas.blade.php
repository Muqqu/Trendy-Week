<div class="offcanvas offcanvas-end" tabindex="-1" id="cartCanvas" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header border-bottom">
        <button type="button" class="btn-close" id="btn-close"  data-bs-dismiss="offcanvas" aria-label="Close"></button>
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">YOUR CART</h5>
        <div></div>
    </div>
    <div class="offcanvas-body">
        <p class="text-muted">Congratulations！You get free shipping！</p>
        <div class="bg-light py-1 px-2 d-flex align-items-center gap-2 mb-4">
            <img src="./assets/img/png/tag-icon.png" alt="">
            <p class="text-muted mb-0">10% already! Buy 1 more item(s) and save 20%</p>
        </div>
        <ul class="products-list" id="cart-items">
           
        </ul>
    </div>
    <div class="offcanvas-footer p-3 shadow">
        {{-- <div class="d-flex justify-content-between">
            <h3 class="title">Subtotal</h3>
            <h3 class="title text-primary">$50.00</h3>
        </div>
        <div class="d-flex justify-content-between">
            <h3 class="title">Discount</h3>
            <h3 class="title text-primary">$50.00</h3>
        </div> --}}
        <hr>
        <div class="d-flex justify-content-between">
            <h3 class="title">Total</h3>
            <h3 class="title text-primary total">$50.00</h3>
        </div>
        <p class="text-muted" style="font-size: 10px;">Taxes and shipping calculated at checkout</p>
        
        <a href="{{ route('guestCheckout.index') }}"  class="btn btn-primary w-100">Checkout</a>
    </div>
</div>

<div class="modal" tabindex="-1" id="productImgModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <button type="button" class="btn-close btn-primary"
                onclick="$('#productImgModal').modal('hide')"></button>
            <div class="modal-body">
                <div class="img-wrapper">
                    <img src="" alt="" class="single-img">
                </div>
            </div>
        </div>
    </div>
</div>