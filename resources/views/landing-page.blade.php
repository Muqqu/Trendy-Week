@extends('layouts.app2')

@section('title', 'Landing Page')

@section('extra-css')
<style>
    a {
        text-decoration: none;
        color: inherit;
    }
</style>
@endsection

@section('content')


<div class="main-content" style="margin-top: 131px;">
    <section class="product-sec">
        <div class="container">
            <div class="hero-slider">
                <a href="" class="slider-item">
                    <img src="{{asset('new_assets/img/png/hero-1.png')}}" alt="" class="img-fluid">
                </a>
                <a href="" class="slider-item">
                    <img src="{{asset('new_assets/img/png/hero-2.png')}}" alt="" class="img-fluid">
                </a>
            </div>
            <h3 class="main-title">Categories</h3>
            <div class="categories-slider mb-3 mb-lg-4">
                @foreach ($categories as $category)
                <div class="slider-item">
                    <a href="{{ route('cat_product.show', $category->slug) }}" class="item">
                        <img src="{{asset('new_assets/img/png/'.$category->image)}}" alt="">
                        <h3 class="title">{{$category->name}}</h3>
                    </a>

                </div>
                @endforeach

            </div>
            <h3 class="main-title">Just for you</h3>
            <div class="product-slider">
                @foreach ($products as $product)
                <div class="slider-item">
                    <a href="{{ route('shop.show', $product->slug) }}" class="card product-card mx-2">
                        <div class="card-body">
                            <img src="{{asset('img/products/'.$product->image)}}" alt="" class="card-img">
                            <h3 class="card-title">{{ $product->name }}</h3>

                            <div class="d-flex align-items-center gap-2">
                                @if($product->discount != 0 )
                                @php $formattedNumber = number_format($product->price, 2, '.', ',');
                                $formattedNumber =$formattedNumber . PHP_EOL;
                                @endphp
                                <h3 class="card-title text-decoration-line-through text-muted">£{{ $formattedNumber}}</h3>
                                @else
                                @php $formattedNumber = number_format($product->price, 2, '.', ',');
                                $formattedNumber =$formattedNumber . PHP_EOL;
                                @endphp
                                <h3 class="card-title">£{{ $formattedNumber }}</h3>
                                @endif
                                @if($product->discount != 0 )
                                @php
                                $disc_perc = $product->price*($product->discount/100);
                                $price_to_show = $product->price - $disc_perc;
                                @endphp
                                <h4 class="card-title ">
                                    @php $formattedNumber = number_format($price_to_show, 2, '.', ',');
                                    $formattedNumber =$formattedNumber . PHP_EOL;
                                    @endphp
                                    £{{ $formattedNumber }}</h4>
                                @endif
                            </div>
                            <div class="d-flex align-items-center justify-content-md-between flex-wrap">
                                <p class="card-text">{{ $product->details }}</p>
                                <div class="d-flex align-items-center flex-wrap">
                                    <img src="{{asset('new_assets/img/png/star-fill.png')}}" alt="" class="star">
                                    <p class="ms-sm-2 card-text">(5 Rattings)</p>
                                </div>
                            </div>
                            <p class="card-text">Available <strong>({{ $product->quantity }}/500)</strong></p>
                        </div>
                    </a>
                </div>

                @endforeach
            </div>
            <h3 class="main-title">General Items</h3>
            <div class="product-slider">
                @foreach ($generalproducts as $product)
                <div class="slider-item">
                    <a href="{{ route('shop.show', $product->slug) }}" class="card product-card mx-2">
                        <div class="card-body">
                            <img src="{{asset('img/products/'.$product->image)}}" alt="" class="card-img">
                            <h3 class="card-title">{{ $product->name }}</h3>

                            <div class="d-flex align-items-center gap-2">
                                @if($product->discount != 0 )
                                @php $formattedNumber = number_format($product->price, 2, '.', ',');
                                $formattedNumber =$formattedNumber . PHP_EOL;
                                @endphp
                                <h3 class="card-title text-decoration-line-through text-muted">£{{ $formattedNumber}}</h3>
                                @else
                                @php $formattedNumber = number_format($product->price, 2, '.', ',');
                                $formattedNumber =$formattedNumber . PHP_EOL;
                                @endphp
                                <h3 class="card-title">£{{ $formattedNumber }}</h3>
                                @endif
                                @if($product->discount != 0 )
                                @php
                                $disc_perc = $product->price*($product->discount/100);
                                $price_to_show = $product->price - $disc_perc;
                                @endphp
                                <h4 class="card-title ">
                                    @php $formattedNumber = number_format($price_to_show, 2, '.', ',');
                                    $formattedNumber =$formattedNumber . PHP_EOL;
                                    @endphp
                                    £{{ $formattedNumber }}</h4>
                                @endif
                            </div>
                            <div class="d-flex align-items-center justify-content-md-between flex-wrap">
                                <p class="card-text">{{ $product->details }}</p>
                                <div class="d-flex align-items-center flex-wrap">
                                    <img src="{{asset('new_assets/img/png/star-fill.png')}}" alt="" class="star">
                                    <p class="ms-sm-2 card-text">(5 Rattings)</p>
                                </div>
                            </div>
                            <p class="card-text">Available <strong>({{ $product->quantity }}/500)</strong></p>
                        </div>
                    </a>
                </div>

                @endforeach


            </div>


        </div>
    </section>
    <section class="feature-lane-sec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="d-flex justify-content-center align-items-center gap-3 mb-3 mb-lg-0">
                        <img src="{{asset('new_assets/img/png/dlivery-icon.png')}}" alt="" class="icon">
                        <div>
                            <h3 class="secondary-title">Fast Delivery</h3>
                            <p>Delivery within 24 hours.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="d-flex justify-content-center align-items-center gap-3 mb-3 mb-lg-0">
                        <img src="{{asset('new_assets/img/png/free-icon.png')}}" alt="" class="icon">
                        <div>
                            <h3 class="secondary-title">Free Shipping</h3>
                            <p>No shipping cost 100% free.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="d-flex justify-content-center align-items-center gap-3">
                        <img src="{{asset('new_assets/img/png/quality-icon.png')}}" alt="" class="icon">
                        <div>
                            <h3 class="secondary-title">Best Quality</h3>
                            <p>100% original products</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="product-sec">
        <div class="container">
            <div class="hero-slider">
                <a href="" class="slider-item">
                    <img src="{{asset('new_assets/img/jpg/sale-1.jpg')}}" alt="" class="img-fluid">
                </a>
                <a href="" class="slider-item">
                    <img src="{{asset('new_assets/img/jpg/sale-2.jpg')}}" alt="" class="img-fluid">
                </a>
            </div>
        </div>
    </section>
    <section class="default-sec reviews-sec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="main-title text-center">What our <span>Customers</span> says</h1>
                    <p class="text-center">Our Customers Love Us! Discover why ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div>
            <div class="review-slider mt-4 mt-lg-5">
                @foreach($reviews as $review)
                <div class="slider-item">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex gap-3">
                                <img src="{{ $review->image_url }}" alt="" class="profile-img">
                                <div>
                                    <h3 class="card-title">{{ $review->customer_name }}</h3>
                                    <p class="card-text mb-2">{{ $review->review }}</p>
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{asset('new_assets/img/png/star-fill.png')}}" alt="" class="review-stars">
                                        <p class="card-text mb-0">{{ $review->stars }}/5</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="default-sec faqs-sec">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="main-title text-center">Frequently Asked Questions</h1>
                    <p class="text-center">Your Answers, Tailored for You: Unveiling the FAQs to Simplify Your Pet Food Experience!</p>
                </div>
            </div>
            <div class="accordion mt-4 mt-lg-5" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            What types of pet food do you offer?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>• We offer a diverse range of pet food, catering to various dietary needs and preferences.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            How can I place an order?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>• Placing an order is simple! Visit our website, browse the products, and follow the easy checkout process.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            What payment methods do you accept?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>• We accept a variety of payment methods, including credit/debit cards and secure online payment gateways.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Is there a return policy?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>• Yes, we have a hassle-free return policy. If you're not satisfied with your purchase, contact us for assistance.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            How can I track my order?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>• Once your order is dispatched, you'll receive a tracking number to monitor the delivery status.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Are there any discounts or promotions available?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>• Stay tuned for exciting promotions! Follow us on social media and subscribe to our newsletter for the latest updates.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Do you offer bulk discounts?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>• Yes, we provide discounts on bulk orders. Contact our customer support for personalized assistance.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Is your pet food suitable for all breeds?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>• Our pet food is crafted to suit various breeds. Check product descriptions for specific details.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Are the ingredients in your pet food high quality?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <p>• Absolutely! We prioritize high-quality ingredients to ensure the health and well-being of your pets.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>{{--
<div class="main-content" style="margin-top: 131px;">
    <section class="hero">
        <div class="container">
            <div class="hero-slider">
                <div class="slider-item">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="content-wrapper">
                                <img src="{{asset('new_assets/img/png/hero-secondary-title.png')}}" alt=""
class="hero-secondary-title mb-3">
<h1 class="title mb-3"><span>Healty</span> & natural cat food</h1>
<p class="mb-4"> Your cat deserves the best, and we're here to make every nap,
    playtime, and snack-time extraordinary. Indulge your cat's whims and
    wishes—because at Purrfection Emporium, it's all about celebrating the joy
    of being a cat! </p>
<a href="" class="btn btn-primary">Shop Now Upto 20% Off</a>
</div>
</div>
<div class="col-lg-6 offset-lg-1">
    <img src="{{asset('new_assets/img/png/hero-1.png')}}" alt="" class="img-fluid mt-4 mt-lg-0">
</div>
</div>
</div>
<div class="slider-item">
    <div class="row">
        <div class="col-lg-5">
            <div class="content-wrapper">
                <img src="{{asset('new_assets/img/png/hero-secondary-title.png')}}" alt="" class="hero-secondary-title mb-3">
                <h1 class="title mb-3">Give your dog a new <span>Life</span></h1>
                <p class="mb-4">Discover a world of whiskers and wonder as you explore our
                    exclusive Pat eStore. From cozy beds that cradle your pet in luxury to
                    interactive toys that spark endless curiosity</p>
                <a href="" class="btn btn-primary">Shop Now Upto 20% Off</a>
            </div>
        </div>
        <div class="col-lg-6 offset-lg-1">
            <img src="{{asset('new_assets/img/png/hero-2.png')}}" alt="" class="img-fluid mt-4 mt-lg-0">
        </div>
    </div>
</div>
</div>
</div>
</section>
<section class="feature-lane-sec">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="d-flex justify-content-center align-items-center gap-3 mb-3 mb-lg-0">
                    <img src="{{asset('new_assets/img/png/dlivery-icon.png')}}" alt="" class="icon">
                    <div>
                        <h3 class="secondary-title">Fast Delivery</h3>
                        <p>Delivery within 24 hours.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="d-flex justify-content-center align-items-center gap-3 mb-3 mb-lg-0">
                    <img src="{{asset('new_assets/img/png/free-icon.png')}}" alt="" class="icon">
                    <div>
                        <h3 class="secondary-title">Free Shipping</h3>
                        <p>No shipping cost 100% free.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="d-flex justify-content-center align-items-center gap-3">
                    <img src="{{asset('new_assets/img/png/quality-icon.png')}}" alt="" class="icon">
                    <div>
                        <h3 class="secondary-title">Best Quality</h3>
                        <p>100% original products</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="default-sec product-sec">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="main-title text-center">Our <span>Featured</span> Products</h1>
                <p class="text-center">Discover a world of pet happiness with our premium selections, tailored to delight your furry friends.</p>
            </div>
        </div>
        <ul class="nav nav-tabs justify-content-center my-4 my-md-5" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="Cats-tab" data-bs-toggle="tab" data-bs-target="#Cats-tab-pane" type="button" role="tab" aria-controls="Cats-tab-pane" aria-selected="true">Cats</button>
            </li>
            @foreach ($categories as $category)
            @if($category->name != 'Cats')
            <li class="nav-item" role="presentation">

                <button class="nav-link" id="{{$category->name}}-tab" data-bs-toggle="tab" data-bs-target="#{{$category->name}}-tab-pane" type="button" role="tab" aria-controls="{{$category->name}}-tab-pane" aria-selected="false">{{$category->name}}</button>

            </li>
            @endif
            @endforeach
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="Cats-tab-pane" role="tabpanel" aria-labelledby="eevents-tab" tabindex=" 0">
                <div class="row">
                    @foreach ($products as $product)
                    @foreach($product->categories as $category)
                    @if($category->id == 2)
                    <div class="col-6 col-lg-4">
                        <div class="card product-card">
                            <a href="{{ route('shop.show', $product->slug) }}">
                                <div class="card-body">
                                    <h3 class="card-title" style="height:150px"><b>{{ $product->name }}</b></h3>
                                    <div class="product-img-wrapper">
                                        <img src="{{asset('img/products/'.$product->image)}}" alt="" class="product-img">
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        @if($product->discount != 0 )
                                        @php $formattedNumber = number_format($product->price, 2, '.', ',');
                                        $formattedNumber =$formattedNumber . PHP_EOL;
                                        @endphp
                                        <h3 class="card-title text-decoration-line-through text-muted">£{{ $formattedNumber}}</h3>
                                        @else
                                        @php $formattedNumber = number_format($product->price, 2, '.', ',');
                                        $formattedNumber =$formattedNumber . PHP_EOL;
                                        @endphp
                                        <h3 class="card-title">£{{ $formattedNumber }}</h3>
                                        @endif
                                        @if($product->discount != 0 )
                                        @php
                                        $disc_perc = $product->price*($product->discount/100);
                                        $price_to_show = $product->price - $disc_perc;
                                        @endphp
                                        <h4 class="card-title ">
                                            @php $formattedNumber = number_format($price_to_show, 2, '.', ',');
                                            $formattedNumber =$formattedNumber . PHP_EOL;
                                            @endphp
                                            £{{ $formattedNumber }}</h4>
                                        @endif
                                    </div>
                                    <div class="d-flex align-items-center justify-content-md-between flex-wrap">
                                        <p class="card-text">{{ $product->details }}</p>
                                        <div class="d-flex align-items-center flex-wrap">
                                            <img src="{{asset('new_assets/img/png/star-fill.png')}}" alt="">
                                            <p class="ms-sm-2 card-text">(5 Rattings)</p>
                                        </div>
                                    </div>
                                    <div class="mt-2">

                                    </div>
                                    <!--<p class="card-text mb-3">Available <strong>(2/50)</strong></p>-->
                                    <form action="{{ route('cart.store') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <input type="hidden" name="name" value="{{ $product->name }}">
                                        <input type="hidden" name="price" value="{{ $product->price }}">
                                        <input type="hidden" class="qty" name="qty" value="1">
                                        <button type="submit" class="btn btn-primary w-100">Add to Cart</button>
                                    </form>

                                </div>
                            </a>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    @endforeach

                </div>
                <div class="d-flex justify-content-center">
                    <a href="" class="btn btn-primary my-4">View More</a>
                </div>
            </div>
            @foreach ($categories as $category)
            <div class="tab-pane fade" id="{{$category->name}}-tab-pane" role="tabpanel" aria-labelledby="{{$category->name}}-tab" tabindex=" 0">
                <div class="row">
                    @foreach ($category->products as $product)
                    <div class="col-6 col-lg-4">
                        <div class="card product-card">
                            <a href="{{ route('shop.show', $product->slug) }}">
                                <div class="card-body">
                                    <h3 class="card-title" style="height:150px"><b>{{ $product->name }}</b></h3>
                                    <div class="product-img-wrapper">
                                        <img src="{{asset('img/products/'.$product->image)}}" alt="" class="product-img">
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        @if($product->discount != 0 )
                                        @php $formattedNumber = number_format($product->price, 2, '.', ',');
                                        $formattedNumber =$formattedNumber . PHP_EOL;
                                        @endphp
                                        <h3 class="card-title text-decoration-line-through text-muted">£{{ $formattedNumber}}</h3>
                                        @else
                                        @php $formattedNumber = number_format($product->price, 2, '.', ',');
                                        $formattedNumber =$formattedNumber . PHP_EOL;
                                        @endphp
                                        <h3 class="card-title">£{{ $formattedNumber }}</h3>
                                        @endif
                                        @if($product->discount != 0 )
                                        @php
                                        $disc_perc = $product->price*($product->discount/100);
                                        $price_to_show = $product->price - $disc_perc;
                                        @endphp
                                        <h4 class="card-title ">
                                            @php $formattedNumber = number_format($price_to_show, 2, '.', ',');
                                            $formattedNumber =$formattedNumber . PHP_EOL;
                                            @endphp
                                            £{{ $formattedNumber }}</h4>
                                        @endif
                                    </div>
                                    <div class="d-flex align-items-center justify-content-md-between flex-wrap">
                                        <p class="card-text">{{ $product->details }}</p>
                                        <div class="d-flex align-items-center flex-wrap">
                                            <img src="{{asset('new_assets/img/png/star-fill.png')}}" alt="">
                                            <p class="ms-sm-2 card-text">(5 Rattings)</p>
                                        </div>
                                    </div>
                                    <div class="mt-2">

                                    </div>
                                    <form action="{{ route('cart.store') }}" method="POST">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="id" value="{{ $product->id }}">
                                        <input type="hidden" name="name" value="{{ $product->name }}">
                                        <input type="hidden" name="price" value="{{ $product->price }}">
                                        <button type="submit" class="btn btn-primary w-100">Add to Cart</button>
                                    </form>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach

                </div>
                <div class="d-flex justify-content-center">
                    <a href="" class="btn btn-primary my-4">View More</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<section class="benefits-sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <img src="{{asset('new_assets/img/png/benefits-sec.png')}}" alt="" class="img-fluid mb-4 mb-lg-0">
            </div>
            <div class="col-lg-6">
                <ul class="benefits-list">
                    <li class="list-item">
                        <img src="{{asset('new_assets/img/png/bennefits-list-1.png')}}" alt="" class="icon">
                        Healty Immune System
                    </li>
                    <li class="list-item">
                        <img src="{{asset('new_assets/img/png/bennefits-list-2.png')}}" alt="" class="icon">
                        Healthy Energy
                    </li>
                    <li class="list-item">
                        <img src="{{asset('new_assets/img/png/bennefits-list-3.png')}}" alt="" class="icon">
                        Radiant Coat
                    </li>
                    <li class="list-item">
                        <img src="{{asset('new_assets/img/png/bennefits-list-4.png')}}" alt="" class="icon">
                        Nourishes Skin
                    </li>
                    <li class="list-item">
                        <img src="{{asset('new_assets/img/png/bennefits-list-5.png')}}" alt="" class="icon">
                        Easily Digestible Formula
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<section class="default-sec reviews-sec">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="main-title text-center">What our <span>Customers</span> says</h1>
                <p class="text-center">Our Customers Love Us! Discover why ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
        </div>
        <div class="review-slider mt-4 mt-lg-5">
            @foreach($reviews as $review)
            <div class="slider-item">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex gap-3">
                            <img src="{{ $review->image_url }}" alt="" class="profile-img">
                            <div>
                                <h3 class="card-title">{{ $review->customer_name }}</h3>
                                <p class="card-text mb-2">{{ $review->review }}</p>
                                <div class="d-flex align-items-center gap-3">
                                    <img src="{{asset('new_assets/img/png/star-fill.png')}}" alt="" class="review-stars">
                                    <p class="card-text mb-0">{{ $review->stars }}/5</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<section class="default-sec faqs-sec">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="main-title text-center">Frequently Asked Questions</h1>
                <p class="text-center">Your Answers, Tailored for You: Unveiling the FAQs to Simplify Your Pet Food Experience!</p>
            </div>
        </div>
        <div class="accordion mt-4 mt-lg-5" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        What types of pet food do you offer?
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>• We offer a diverse range of pet food, catering to various dietary needs and preferences.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        How can I place an order?
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>• Placing an order is simple! Visit our website, browse the products, and follow the easy checkout process.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        What payment methods do you accept?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>• We accept a variety of payment methods, including credit/debit cards and secure online payment gateways.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Is there a return policy?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>• Yes, we have a hassle-free return policy. If you're not satisfied with your purchase, contact us for assistance.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        How can I track my order?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>• Once your order is dispatched, you'll receive a tracking number to monitor the delivery status.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Are there any discounts or promotions available?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>• Stay tuned for exciting promotions! Follow us on social media and subscribe to our newsletter for the latest updates.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Do you offer bulk discounts?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>• Yes, we provide discounts on bulk orders. Contact our customer support for personalized assistance.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Is your pet food suitable for all breeds?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>• Our pet food is crafted to suit various breeds. Check product descriptions for specific details.</p>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Are the ingredients in your pet food high quality?
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p>• Absolutely! We prioritize high-quality ingredients to ensure the health and well-being of your pets.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
</div>--}}
@endsection