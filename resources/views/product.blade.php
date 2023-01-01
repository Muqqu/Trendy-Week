@extends('layouts.app')
@section('content')
<div class="main-content" style="margin-top: 183px;">
    <section class="default-sec product-single-sec">
        <div class="container">
            <div class="mb-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pet food large for kittens</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-lg-5">
                    @if(!empty($product->productImages))
                        @foreach ($product->productImages as $key => $image)
                    <div class="product-img-wrapper mb-3 mb-lg-4">
                        <img src="{{ asset('img/products/' . $image->path) }}" alt="" id="product-img-preview">
                    </div>
                    @php break; @endphp
                    @endforeach
                        @endif

                    <div class="product-slider-nav">
                        @if(!empty($product->productImages))
                        @foreach ($product->productImages as $key => $image)
                        <div class="slider-item" color="blue">
                            <img src="{{ asset('img/products/' . $image->path) }}" alt=""
                                class="img-fluid">
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <h1 class="title mb-3 mt-3">{{ $product->name }}</h1>
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <h3 class="price-title">£{{$product->price}}</h3>
                        @if($product->discount != 0 )
                            @php
                            $disc_perc = $product->price*($product->discount/100);
                            $disc_perc = number_format($disc_perc, 2, '.', ',');
                            $disc_perc =$disc_perc . PHP_EOL;
                            $price_to_show = $product->price - $disc_perc;
                            $price_to_show = number_format($price_to_show, 2, '.', ',');
                            $price_to_show =$price_to_show . PHP_EOL;
                            @endphp
                            <h4 class="price-title text-decoration-line-through text-muted">
                                £{{$price_to_show}}</h4>
                            @endif
                    </div>
                    @if(!empty($product->variantTypes))
                    @foreach($product->variantTypes as $variantType)
                    <div class="variation-wrapper mb-4">
                        <h4 class="variation-title">{{$variantType->name}}</h4>
                        <div class="d-flex align-items-center gap-3 flex-wrap">
                            @foreach($variantType->variationData as $variationData)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios"
                                    id="colorVariation1" value="blue" checked>
                                <label class="form-check-label" for="colorVariation1">
                                    {{$variationData->name}}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                    @endif
                    <div class="quantity-input input-group mb-3">
                        <button type="button" onclick="decrementQuantity()" class="btn btn-primary">-</button>
                        <input type="number" id="quantity" class="quantity form-control" name="quantity" min="1"
                            max="200" value="1" required="" data-id="4" data-productquantity="200">
                        <button type="button" onclick="incrementQuantity()" class="btn btn-primary">+</button>
                    </div>
                    <p class="text-muted">Only 5% items left in stock</p>
                    <div class="rounded-pill d-flex justify-content-start align-items-center gap-2 py-1 px-3 mb-3" style="background-color: #b8e986; max-width: fit-content;">
                        <img src="{{ asset('assets/img/png/eye-icon.png') }}" alt="" style="width: 20px;">
                        <p class="mb-0">
                            1120 visitors currently looking at this product
                        </p>
                    </div>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <img src="{{ asset('assets/img/png/globe-icon.png') }}" alt="">
                        <p class="mb-0">It's been recommended by 6.19K people on Facebook</p>
                    </div>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <img src="{{ asset('assets/img/png/box-icon.png') }}" alt="">
                        <p class="mb-0">Free Shipping On All Orders</p>
                    </div>
                    <div class="d-flex align-items-center gap-2 mb-3 mb-lg-4">
                        <img src="{{ asset('assets/img/png/lock-icon.png') }}" alt="">
                        <p class="mb-0">Secure payment via PayPal & Credit Card</p>
                    </div>
                    <form action="{{ route('buy_now') }}" method="GET" class="mt-2">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="name" value="{{ $product->name }}">
                        <input type="hidden" name="detail" value="{{ $product->details }}">
                        <input type="hidden" name="image_url" value="{{  $product->image }}">
                        <input type="hidden" class="qty" name="qty" value="1">
                        <input type="hidden" name="price" value="{{ $price_to_show??$product->price }}">
                        <button type="submit" class="btn btn-success mb-5 w-100" >Buy Now</button>
                    </form>
                    <button class="btn btn-primary add-to-cart w-100" id="add-to-cart" data-product_id="{{ $product->id }}"data-product="{{ $product->name }}" data-quantity="1" data-price="{{$price_to_show??$product->price }}"  data-image="  <img src={{ asset('img/products/' . $image->path) }}
                        class='product-img' >">Add to Cart</button>
                    @if ($product->quantity > 0)
                    {{-- <form action="{{ route('cart.store') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="name" value="{{ $product->name }}">
                        <input type="hidden" name="price" value="{{$price_to_show??$product->price }}">
                        <input type="hidden" class="qty" name="qty" value="1">
                        <button type="submit" class="btn btn-primary w-100" >Add to Cart</button>
                    </form> --}}
                    @endif
                    <img style="max-width: 400px;" src="{{ asset('assets/img/webp/payment-methods-group.webp') }}" alt=""
                    class="img-fluid mx-auto d-block">

                    </div>
                </div>
            </div>
    </section>
    <section class="default-sec pt-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <img src="{{ asset('assets/img/webp/products/product-single-dummy-gif.webp') }}" alt=""
                        class="img-fluid mb-3 mb-lg-5" style="width: 100%;">
                </div>
                <div class="col-lg-7 offset-lg-1">
                    <p class="text-primary fw-bold fs-6 ">😍💥The thinnest, lightest, most convenient, and best
                        shaving experience.</p>
                    <p>No one wants to carry a huge electric razor when traveling, because it is too bulky and
                        difficult to carry. Our portable mini electric razor is easily carried in your jeans
                        pocket and very suitable for carrying around.</p>
                    <div class="paragraph-wrapper">
                        <h6 class="paragraph-title text-start mb-2 text-primary">MAIN FEATURES</h6>
                        <ul>
                            {!! $product->description?? "Not yet" !!}
                        </ul>
                    </div>


                </div>
            </div>
            <div class="pragraph-wrapper">
                <h6 class="paragraph-title text-start mb-2 text-primary">SPECIFICATIONS</h6>
                <ul>
                    {!! $product->specifications?? "Not yet" !!}
                </ul>
            </div>
            <div class="pragraph-wrapper">
                <h6 class="paragraph-title text-start mb-2 text-primary">PACKAGE</h6>
                <ul>
                    {!! $product->package?? "Not yet" !!}
                </ul>
            </div>
            <div class="pragraph-wrapper">
                <h6 class="paragraph-title text-start mb-2 text-primary">NOTE</h6>
                <ul>
                    <li>
                        <p>Please allow slight measurement deviations due to manual measurement.</p>
                    </li>
                </ul>
            </div>
            <div class="pragraph-wrapper">
                <h6 class="paragraph-title text-start mb-2 text-primary">HOW TO PAY</h6>
                <ul>
                    <li>
                        <p>✅Payments Via PayPal®, Debit and CreditCard.</p>
                    </li>
                    <li>
                        <p> Add to cart first, and Check out, then select Shipping method and Payment method.
                        </p>
                        <img src="{{ asset('assets/img/webp/payment-method-product-single.webp') }}" class="img-fluid"
                            alt="">
                    </li>
                    <li>
                        <p>If you checkout with a Debit / Credit Card, just enter your * Card Number, *
                            Expiration Date, and * Secure Code.</p>
                        <img src="{{ asset('assets/img/webp/payment-method-product-single-2.webp') }}" class="img-fluid"
                            alt="">
                    </li>
                </ul>
            </div>
            <div class="pragraph-wrapper">
                <h6 class="paragraph-title text-start mb-2 text-primary">Worldwide Shipping ✈ </h6>
                <ul>
                    <li>
                        <p>Delivery typically takes different times based on the different destination. You may
                            receive your items earlier. Tracking Numbers will always be sent so you can track it
                            every step of the way! </p>
                        <img src="{{ asset('assets/img/gif/payment-method-product-single.gif'.$product->gif_img) }}" class="img-fluid" alt="">
                    </li>
                    <li>
                        <p><b>🔒 100% Risk-Free Purchase </b>If you bought it and felt that it is not for you,
                            don't worry. Send a message
                            for us, and we will make it right by offering you a replacement or refund. 100%
                            Simple & Risk-Free process.</p>
                    </li>
                    <li>
                        <p><b>🏭 Our Warehouse </b>Once your order is dispatched, depending on your country or
                            region, products will be delivered to you as soon as possible.</p>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <section class="cta-sec default-sec">
        <div class="container">
            <h1 class="main-title text-center mb-3">Trendy Week</h1>
            <a href="#" class="btn mb-4 mb-lg-5">
                Start Your Perfect Shoopping Trip Now
            </a>
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="d-flex align-items-center gap-3 mb-3 mb-lg-0">
                        <img src="{{ asset('assets/img/webp/delivery-icon.webp') }}" alt="">
                        <h5 class="text-white mb-0">Delivery by DHL/EUB</h5>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="d-flex align-items-center gap-3 mb-3 mb-lg-0">
                        <img src="{{ asset('assets/img/webp/secure-icon.webp') }}" alt="">
                        <h5 class="text-white mb-0">Payment Security</h5>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="d-flex align-items-center gap-3 mb-3 mb-lg-0">
                        <img src="{{ asset('assets/img/webp/24-7-icon.webp') }}" alt="">
                        <h5 class="text-white mb-0">24/7 Service</h5>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="d-flex align-items-center gap-3 mb-3 mb-lg-0">
                        <img src="{{ asset('assets/img/webp/24-7-icon.webp') }}" alt="">
                        <h5 class="text-white mb-0">Money Back Gurantee</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection