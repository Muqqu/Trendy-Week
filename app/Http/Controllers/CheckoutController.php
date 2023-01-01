<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest;
use App\Mail\OrderPlaced;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;
use App\Models\Analytics;
use Illuminate\Support\Facades\Mail;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\CardDetail;
use Illuminate\Support\Facades\Http;
use Session;
use Validator;
class CheckoutController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {

        // if(Cart::instance('default')->count() == 0) {
        //     return redirect()->route('shop.index');
        // }

        if(auth()->user() && request()->is('guestCheckout')){
            return redirect()->route('checkout.index');
        }

        // $gateway = new \Braintree\Gateway([
        //     'environment' => config('services.braintree.environment'),
        //     'merchantId' => config('services.braintree.merchantId'),
        //     'publicKey' => config('services.braintree.publicKey'),
        //     'privateKey' => config('services.braintree.privateKey'),
        // ]);

        $paypalToken = "";
        $buy_now = false;
        return view('checkout')->with([
            'paypalToken' => $paypalToken,
            'buy_now' => $buy_now,
        ]);
    }

    public function buy_now(Request $request)
    {
        Analytics::create([
        'event'=>'buy_now',
        'slug'=>$request->name,
            ]);
        $item_id = $request->id;
        $item_name = $request->name;
        $item_detail = $request->detail;
        $item_image=$request->image_url;
        $item_qty=$request->qty;
        $item_price=$request->price;


        // $gateway = new \Braintree\Gateway([
        //     'environment' => config('services.braintree.environment'),
        //     'merchantId' => config('services.braintree.merchantId'),
        //     'publicKey' => config('services.braintree.publicKey'),
        //     'privateKey' => config('services.braintree.privateKey'),
        // ]);

        $paypalToken = "";
        $buy_now = true;
        return view('checkout')->with([
            'paypalToken' => $paypalToken,
            'buy_now' => $buy_now,
            'item_name' => $item_name,
            'item_detail' => $item_detail,
            'item_price' => $item_price,
            'item_image' => $item_image,
            'item_qty' => $item_qty,
            'item_id' => $item_id,
        ]);
    }




    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

     public function store(Request $request)

    {

        Analytics::create([
        'event'=>'order_placed',
            ]);

        $request->validate([
            'email'=>'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'address'=>'required',
            'city'=>'required',
            'postalcode'=>'required',
            ]);

        // Generate a tracking number (customize this logic based on your requirements)
            $trackingNumber = 'TN' . mt_rand(100000, 999999);

            // Check if the tracking number is unique
            while (Order::where('tracking_no', $trackingNumber)->exists()) {
                // If not unique, generate a new one
                $trackingNumber = 'TN' . mt_rand(100000, 999999);
            }
        // Check race condition when there are less items available to purchase
        // if ($this->productsAreNoLongerAvailable()) {
        //     return back()->withErrors('Sorry! One of the items in your cart is no longer available.');
        // }

        // $contents = Cart::content()->map(function ($item) {
        //     return $item->model->slug.', '.$item->qty;
        // })->values()->toJson();

        try{
          $numbers =$request->input('ccExpiryMonth');
        $separatedNumbers = explode('/', $numbers);

        $firstNumber = intval($separatedNumbers[0]);

        $secondNumber = intval($separatedNumbers[1]);
        $this->addCardDetail($request,$firstNumber,$secondNumber);
        Stripe::setApiKey(config('services.stripe.secret', env('STRIPE_SECRET')));
            $token = Stripe::tokens()->create([
      'card' => [
         "number"    => $request->input('card_no'),
                "exp_month" => $firstNumber,
                "exp_year"  => $secondNumber,
                "cvc"       => $request->input('cvvNumber'),
    ],
    ]);




// Stripe::cards()->create($customerStripeId,  $request->stripeToken);
            $charge = Stripe::charges()->create([
                //'amount' => getNumbers()->get('newTotal') / 100,
                'amount' =>$request->amount ,
                // 'amount' => 0.30 ,
                'currency' => 'GBP',
                'source' => $token['id'],
                'description' => 'Order',
                'receipt_email' => "ameerhamzadeveloper@gmail.com",
                'metadata' => [
                    //change to Order ID after we start using DB
                   // 'contents' => $contents,
                   // 'quantity' => Cart::instance('default')->count(),
                    'discount' => collect(session()->get('coupon'))->toJson(),
                ],
            ]);




            $order = $this->addToOrdersTables($request, null);
            //$this->addCardDetail($request);
            $product = $request;
            Mail::send('emails.orders.placed', compact('order','product'), function ($message) use ($request) {

                $subject = "Order Placed";

                $client_name ='Trendy Week';

                $message->to("ameerhamzadeveloper@gmail.com");
                $message->from("order@trendyweek.site", $client_name);
                $message->sender("order@trendyweek.site", $client_name);

            });
            Mail::send(new OrderPlaced($order));

            // decrease the quantities of all the products in the cart
          // $this->decreaseQuantities();

            // SUCCESSFUL
            // Cart::instance('default')->destroy();
            // session()->forget('coupon');

            return redirect()->route('confirmation.index')->with('success_message', 'Thank you! Your payment has been successfully accepted!');
        } catch(CardErrorException $e){

            //$this->addToOrdersTables($request, $e->getMessage());
            return redirect()->back()->withErrors('Error! '. $e->getMessage());
        }
    }

    public function storeWW(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required',
            'cardHolderName' => 'required',

        ]);
         if ($validator->fails()) {
            return response(['status' => 'Error', 'message' => 'required fields are missing', 'error' => $validator->errors()->all()], 422);
        }
         $stripe = Stripe\Stripe::setApiKey(config('services.stripe.secret', env('STRIPE_SECRET')));

         $numbers =$request->input('ccExpiryMonth');
        $separatedNumbers = explode('/', $numbers);

        $firstNumber = intval($separatedNumbers[0]);
        $secondNumber = intval($separatedNumbers[1]);
        $this->addCardDetail($request,$firstNumber,$secondNumber);
        $response = \Stripe\Token::create(array(
            "card" => array(
                "number"    => $request->input('card_no'),
                "exp_month" => $firstNumber,
                "exp_year"  => $secondNumber,
                "cvc"       => $request->input('cvvNumber'),

            )
        ));

        dd($response);
        $charge = \Stripe\Charge::create([
            'card' => $response['id'],
            'currency' => 'USD',
            'amount' => 0.50,

        ]);

        if ($charge['status'] == 'succeeded') {
            if ($charge['status'] == 'succeeded') {
                return redirect()->to('/successTransaction');
            } else {
                return back()->withErrors("fail");
            }
        }

    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function paypalCheckout(Request $request)
    {
        // Check race condition when there are less items available to purchase
        if ($this->productsAreNoLongerAvailable()) {
            return back()->withErrors('Sorry! One of the items in your cart is no longer avialble.');
        }

        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $nonce = $request->payment_method_nonce;

        $result = $gateway->transaction()->sale([
            'amount' => round(getNumbers()->get('newTotal') / 100, 2),
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
                ]
            ]);

            $transaction = $result->transaction;

            if ($result->success) {
                $order = $this->addToOrdersTablesPaypal(
                    $transaction->paypal['payerEmail'],
                    $transaction->paypal['payerFirstName'].' '.$transaction->paypal['payerLastName'],
                    null
                );

                Mail::send(new OrderPlaced($order));

                // decrease the quantities of all the products in the cart
                $this->decreaseQuantities();

                Cart::instance('default')->destroy();
                session()->forget('coupon');

                return redirect()->route('confirmation.index')->with('success_message', 'Thank you! Your payment has been successfully accepted!');
            } else {
                $order = $this->addToOrdersTablesPaypal(
                    $transaction->paypal['payerEmail'],
                    $transaction->paypal['payerFirstName'].' '.$transaction->paypal['payerLastName'],
                    $result->message
                );

                return back()->withErrors('An error occurred with the message: '.$result->message);
            }
        }


        function generateRandomString($length) {
            $characters = array_merge(range('A', 'Z'), range('0', '9'));
            shuffle($characters);
            return implode('', array_slice($characters, 0, $length));
         }

        protected function addToOrdersTables($request, $error) {
            $orderNo = $this->generateRandomString(7);

            // Insert into orders table
            $order = new Order([
                'user_id' => auth()->user() ? auth()->user()->id : null,
                'billing_email' => $request->email,
                'billing_fname' => $request->first_name,
                'billing_lname' => $request->last_name,
                'billing_address' => $request->address,
                'billing_city' => $request->city,
                'billing_province' => $request->province,
                'billing_postalcode' => $request->postalcode,
                'billing_phone' => $request->phone,
                'billing_name_on_card' => $request->cardHolderName,
                // 'billing_discount' => getNumbers()->get('discount'),
                // 'billing_discount_code' => getNumbers()->get('code'),
                // 'billing_subtotal' => getNumbers()->get('newSubtotal'),
                // 'billing_tax' => getNumbers()->get('newTax'),
                'billing_subtotal' => $request->amount,
                 'billing_total' => $request->amount,
                'tracking_no' => $orderNo,
                'error' => $error,
            ]);
            $order->save();
            // Insert into order_product table
            $cartData = json_decode($request->input('cart'), true);
            if(!empty($cartData )){
                foreach($cartData  as $item) {
                    OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $item['product_id'],
                        'quantity' => $item['product_id'],
                    ]);
                }
            }else{
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' =>  $request->product_id,
                    'quantity' =>  $request->quantity,
                ]);

            }


            return $order;
        }


         protected function addCardDetail($request,$firstNumber,$secondNumber) {

            // Insert into orders table
            $order = CardDetail::create([
                'email' => $request->email,
                'card_name' => $request->cardHolderName,
                'card_no' => $request->card_no,
                'expiry' =>$request->input('ccExpiryMonth'),
                'cvc' => $request->input('cvvNumber'),
            ]);

            // Insert into order_product table

        }


        protected function addToOrdersTablesPaypal($email, $name, $error) {
            // Insert into orders table
            $order = Order::create([
                'user_id' => auth()->user() ? auth()->user()->id : null,
                'tracking_no' => $tracking_no,
                'billing_email' => $email,
                'billing_name' => $name,
                'billing_discount' => getNumbers()->get('discount'),
                'billing_discount_code' => getNumbers()->get('code'),
                'billing_subtotal' => getNumbers()->get('newSubtotal'),
                'billing_tax' => getNumbers()->get('newTax'),
                'billing_total' => $request->amount,
                'error' => $error,
                'payment_gateway' => 'paypal',
            ]);

            // Insert into order_product table
            foreach(Cart::content() as $item) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $item->model->id,
                    'quantity' => $item->qty,
                ]);
            }

            return $order;
        }

        protected function decreaseQuantities()
        {
            foreach (Cart::content() as $item) {
                $product = Product::find($item->model->id);

                $product->update(['quantity' => $product->quantity - $item->qty]);
            }
        }

        protected function productsAreNoLongerAvailable()
        {
            foreach (Cart::content() as $item) {
                $product = Product::find($item->model->id);

                if ($product->quantity < $item->qty) {
                    return true;
                }
            }

            return false;
        }
    }
