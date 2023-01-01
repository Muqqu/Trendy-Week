<header class="header fixed-top w-100">
    <div class="header-top">
        <div class="container-fluid">
            <div class="header-top-slider">
                <div class="slick-slide">Free Shipping on all orders</div>
                <div class="slick-slide">Buy more save more</div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg">
        <div class="container d-block">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="d-lg-block">
                    <button class="navbar-toggler border-0 p-0 shadow-none" type="button"
                        data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <a class="navbar-brand" href="#"><img src="{{asset('assets/img/png/trendy-logo.png')}}" alt=""></a>
                <div class="d-flex gap-3">
                    <a href="" class="icon"><img src="{{asset('assets/img/png/search-icon.png')}}" alt=""></a>
                    <a class="icon" data-bs-toggle="offcanvas" href="#cartCanvas" role="button" aria-controls="cartCanvas"><img src="{{asset('assets/img/png/cart-ico.png')}}" alt=""></a>
                </div>
            </div>

            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('landing-page') ? 'active' : '' }}" aria-current="page" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('shop.index') ? 'active' : '' }}" href="{{ route('shop.index') }}">All Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('ordertrack.show') ? 'active' : '' }}" href="{{ route('ordertrack.show') }}">Track Your Order</a>
                        </li>
                    </ul>
                </ul>
            </div>
        </div>
    </nav>
</header>