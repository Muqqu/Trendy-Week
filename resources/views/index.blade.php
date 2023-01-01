@extends('layouts.app')
@section('content')
<div class="main-content" style="margin-top: 183px;">
    <section class="hero-sec">
        <img src="./assets/img/webp/hero.webp" alt="" class="bg">
    </section>
    <section class="default-sec category-sec">
        <div class="container">
            <h1 class="main-title">✦ Classification ✧</h1>
            <div class="row">
                @foreach ($categories as $category)
                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('cat_product.show', $category->slug) }}" class="card">
                        <div class="card-img-wrapper">
                            <div class="overflow-hidden">
                                <img src="{{asset('img/categories/'.$category->image)}}" alt="" class="card-img">
                            </div>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">{{ $category->name }}</h3>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <section class="default-sec products-sec">
        <div class="container">
            <h1 class="main-title">✦ Hot Sale ✧</h1>
            <div class="row">
                @foreach ($products as $product)
                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('shop.show', $product->slug) }}" class="card product-card">
                        <div class="img-wrapper">
                            <img src="{{asset('img/products/'.$product->image)}}" alt="" class="card-img">
                            <img src="{{asset('img/products/'.$product->image)}}" alt="" class="card-img card-img-2">
                            <div class="add-to-card-btn" id="add-to-cart" data-product_id="{{ $product->id }}"data-product="{{ $product->name }}" data-quantity="1" data-price="{{$price_to_show??$product->price }}"  data-image="  <img src={{ asset('img/products/' . $product->image) }}
                                class='product-img' >">Add To Cart</div>
                        </div>
                        @if($product->discount != 0 )
                        @php
                        $disc_perc = $product->price*($product->discount/100);
                        $price_to_show = $product->price - $disc_perc;
                        @endphp
                        <div class="tag">
                            <h5 class="title">SAVE</h5>
                            <h5 class="title">{{$disc_perc}}</h5>
                        </div>
                        @endif
                        <div class="card-body">
                            <h3 class="card-title">{{ $product->name }}</h3>
                            @if($product->discount != 0 )
                            @php
                            $disc_perc = $product->price*($product->discount/100);
                            $price_to_show = $product->price - $disc_perc;
                            @endphp
                            <h3 class="price">
                                @php $formattedNumber = number_format($price_to_show, 2, '.', ',');
                                $formattedNumber =$formattedNumber . PHP_EOL;
                                @endphp
                                £{{ $formattedNumber }}
                            @endif

                            @if($product->discount != 0 )
                            @php $formattedNumber = number_format($product->price, 2, '.', ',');
                            $formattedNumber =$formattedNumber . PHP_EOL;
                            @endphp
                            <span class="card-title text-decoration-line-through text-muted">£{{ $formattedNumber}}</span></h3>
                            @else
                            @php $formattedNumber = number_format($product->price, 2, '.', ',');
                            $formattedNumber =$formattedNumber . PHP_EOL;
                            @endphp
                            <h3 class="price">£{{ $formattedNumber }}</h3>
                            @endif
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-4 mt-lg-5">
                <a href="" class="btn btn-primary">View All Products</a>
            </div>
        </div>
    </section>
    <section class="default-sec simple-text">
        <div class="container">
            <h1 class="main-title mb-3">Where Style Meets Affordability</h1>
            <div class="row justify-content-center">
                <div class="col-lg-4">
                    <p class="text">We're a company dedicated to crafting high-quality products that combine distinctive design and exceptional functionality. Our mission is to improve your daily experiences through innovation.</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection