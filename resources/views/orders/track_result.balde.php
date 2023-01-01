<!-- resources/views/orders/track.blade.php -->
@extends('layouts.app')
@section('content')
<div class="main-content" style="margin-top: 131px;">
            <section class="default-sec product-sec">
                <div class="container">
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
    </div>
    <div class="container">
        
        <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <h1 class="main-title text-center">Track Your <span>Order</span></h1>
                            <p class="text-center">Track your order with ease using our efficient order search feature for real-time updates on delivery status and location.</p>
                        </div>
                    </div>
                    <div class="row justify-content-center mb-4 mb-lg-5">
                        <div class="col-lg-8">
                            <form action="{{ route('order.track') }}" method="post">
                            @csrf
                            <div class="input-group">
                                <input  type="text" name="tracking_no" id="tracking_no" class="form-control" placeholder="Enter tracking number">
                                <button type="submit" class="btn btn-primary ">Search</button>
                            </div>
                            </form>
                        </div>
                    </div>

        
    </div>
    </section>
    </div>
@endsection
