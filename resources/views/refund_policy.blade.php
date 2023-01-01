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

<div class="container">



        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="main-title text-center">Return <span>Refund Policy</span></h1>
            </div>
        </div>

        <p>
            If your product is defective / damaged or incorrect/incomplete at the time of delivery, please contact us within 1-2 hours.
        </p>
        <p>Your product may be eligible for refund or replacement depending on the product category and condition.</p>
        <h2>Conditions for Returns</h2>
        <ol>
            <li>The product must be unused, unworn, unwashed and without any flaws.</li>
            <li>The product must include the original tags, user manual, freebies and accessories.</li>
            <li>The product must be returned in the original and undamaged manufacturer packaging/box. Do not put tape or stickers on the manufacturer’s box.</li>
        </ol>
        <div class="row">
            <div class="vertical-line"></div>
            <div class="text">If a product is returned to us in an inadequate condition, we reserve the right to send it back to you.</div>
        </div>
        <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. ...</p> -->

        <h2>Issuance of Refunds</h2>
        <p>If your product is eligible for a refund, please send your bank details to info@petsone.pk to claim the refund.</p>
        <p>We will process your refund after receiving the return item. It takes 5-7 Days.</p>

        <h2>Exchange</h2>
        <p>We only accept pet’s accessories for exchange, if you have color or size issue.</p>
        <p>Food Items are not eligible for exchange unless we sent the wrong item.</p>
        <!-- Add more sections as needed -->



</div>
@endsection
