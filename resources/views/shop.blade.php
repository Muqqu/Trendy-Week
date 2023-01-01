@extends('layouts.app')
@section('content')
        <div class="main-content" style="margin-top: 183px;">
            <section class="default-sec pb-0">
                <div class="container">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">All Products</li>
                        </ol>
                    </nav>
                </div>
            </section>
            <section class="default-sec products-sec">
                <div class="container">
                    @if(!empty($category))
                    <h1 class="main-title">✦ {{$category->name}} ✧</h1>
                    @else
                    <h1 class="main-title">✦ Hot Sale ✧</h1>
                    @endif
                    <div class="row">
                        @foreach($products as $product)
                        <div class="col-md-6 col-lg-3">
                            <a href="{{ route('shop.show', $product->slug) }}" class="card product-card">
                                <div class="img-wrapper">
                                    <img src="{{asset('img/products/'.$product->image)}}" alt="" class="card-img">
                                    <img src="{{asset('img/products/'.$product->image)}}" alt=""
                                        class="card-img card-img-2">
                                    <div class="add-to-card-btn">Add To Cart</div>
                                </div>
                                <div class="tag">
                                    <h5 class="title">SAVE</h5>
                                    <h5 class="title">$14.07</h5>
                                </div>
                                <div class="card-body">
                                    
                                    <h3 class="card-title">{{$product->name}}</h3>
                                    
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
                </div>
            </section>
            <section class="default-sec py-3">
                <div class="container">
                    <nav aria-label="...">
                        <ul class="pagination pagination-sm justify-content-center">
                            <li class="page-item active" aria-current="page">
                                <span class="page-link">1</span>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                        </ul>
                    </nav>
                </div>
            </section>

        </div>

@endsection