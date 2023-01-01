<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Received</title>
</head>
<body>

<!-- Header with Logo -->
<img src="{{asset('assets/img/png/trendy-logo.png')}}" alt="Logo" style="max-width: 100%; height: auto; display: block; margin: 0 auto;">

<!-- Order Received Content -->
<div style="max-width: 600px; margin: 20px auto; padding: 10px; border: 1px solid #ccc;">

    <h2>Order Received</h2>

    <p>Thank you for your order.</p>

    <p><strong>Order ID:</strong> {{ $order->id }}</p>
    <p><strong>Tracking No:</strong> {{ $order->tracking_no }}</p>
    <p><strong>Billing Email:</strong> {{ $order->billing_email }}</p>
    <p><strong>Billing Name:</strong> {{ $order->billing_name }}</p>
    <p><strong>Order Total:</strong> {{$order->billing_total}}</p>

    <h3>Items Ordered</h3>
    @foreach($order->products as $product)
        <p>
            <strong>Name:</strong> {{ $product->name }} <br>
            <strong>Price:</strong> € {{ number_format($product->price, 2) }} <br>
            <strong>Quantity:</strong> {{ $product->pivot->quantity }} <br>
        </p>
    @endforeach

    <p>You can get further details about your order by logging into our website.</p>

    <p>
        <a href="{{ config('app.url') }}" style="display: inline-block; padding: 10px 20px; background-color: green; color: #fff; text-decoration: none;">
            Go to Website
        </a>
    </p>

    <p>Thank you again for choosing us.</p>

    <p>Regards, <br>
    {{ config('app.name') }}</p>
    
</div>

</body>
</html>
