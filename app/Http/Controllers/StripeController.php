<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;
use Stripe;
use Session;
use Validator;

class StripeController extends Controller
{

    public function index(Request $request)
    {
        return view('stripe.index');
    }

    public function payStripe(Request $request)
    {
        
        $this->validate($request, [
            'card_no' => 'required',
            'expiry_month' => 'required',
            'expiry_year' => 'required',
            'cvv' => 'required',
        ]);
 
        // $stripe = Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        dd($stripe);
 
        try {
            $response = \Stripe\Token::create(array(
                "card" => array(
                    "number"    => $request->input('card_no'),
                    "exp_month" => $request->input('expiry_month'),
                    "exp_year"  => $request->input('expiry_year'),
                    "cvc"       => $request->input('cvv')
                )));
            if (!isset($response['id'])) {
                return redirect()->route('addmoney.paymentstripe');
            }
            $charge = \Stripe\Charge::create([
                'card' => $response['id'],
                'currency' => 'USD',
                'amount' =>  100 * 0.50,
                'description' => 'wallet',
            ]);
 
            if($charge['status'] == 'succeeded') {
                echo 'test success';
                exit;
                return redirect('stripe')->with('success', 'Payment Success!');
 
            } else {
                echo 'something went wrong';
                exit;
                return redirect('stripe')->with('error', 'something went to wrong.');
            }
 
        }
        catch (Exception $e) {
            return $e->getMessage();
        }
 
    }
}
