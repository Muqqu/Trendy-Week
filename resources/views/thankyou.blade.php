@extends('layouts.app2')

@section('title', 'Thank You')

@section('extra-css')
<style>
    .thank-you-section {
            text-align: center;
        }
</style>
@endsection

@section('body-class', 'sticky-footer')

@section('content')

   <div class="thank-you-section" style="margin-top: 131px;">
       <h1>Thank you for <br> Your Order!</h1>
       <p>A confirmation email was sent</p>
       <div class="spacer"></div>
       <div>
           <a href="{{ route('shop.index') }}" class="btn btn-success">Continue Shopping</a>
       </div>
       <div class="spacer"></div>
   </div>




@endsection
