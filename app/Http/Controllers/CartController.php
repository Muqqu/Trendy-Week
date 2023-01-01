<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Analytics;
use GuzzleHttp\Client;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
         public function trackAddToWishlist()
    {
        $url = 'https://business-api.tiktok.com/open_api/v1.3/event/track';
        $accessToken = '1fbd5ceb886d3c18e799544411d7229915b6b5b4';

        $data = [
            'event_source' => 'web',
            'event_source_id' => 'CLLDS03C77UD34NSP3B0',
            'data' => [
                [
                    'event' => 'AddToWishlist',
                    'user' => [
                        // ... user data ...
                    ],
                    'page' => [
                        'url' => 'https://trendyweek.site/cart',
                    ],
                    'properties' => [
                        'contents' => [
                            // ... contents data ...
                        ],
                        'value' => 100,
                        'currency' => 'GBP',
                    ],
                ],
            ],
        ];

        $client = new Client();

        $response = $client->post($url, [
            'headers' => [
                'Access-Token' => $accessToken,
                'Content-Type' => 'application/json',
            ],
            'json' => $data,
            'allow_redirects' => false, 
        ]);
        return $response->getBody()->getContents();
    }
    public function index()
    {dd();
        $mightAlsoLike = Product::mightAlsoLike()->get();
        $this->trackAddToWishlist();
        Analytics::create([
        'event'=>'add_to_cart',
        'slug'=>'3d_bear',
            ]);
        return view('cart')->with([
            'mightAlsoLike' => $mightAlsoLike,
            'discount' => getNumbers()->get('discount'),
            'newSubtotal' => getNumbers()->get('newSubtotal'),
            'newTax' => getNumbers()->get('newTax'),
            'newTotal' => getNumbers()->get('newTotal'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
            return $cartItem->id === $request->id;
        });

        if ($duplicates->isNotEmpty()) {
           
            return redirect()->route('cart.index')->with('success_message', 'Item is already in your cart!');
        }

        Cart::add($request->id, $request->name, $request->qty, $request->price)
            ->associate('App\Models\Product');
          
           

        return redirect()->route('cart.index')->with('success_message', 'Item was added to your cart!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|between:1,5'
        ]);

        if($validator->fails()){
            session()->flash('errors', collect(['Quantity must be between 1 and 5.']));
            return response()->json(['success' => false], 400); //400 is an error code
        }

        if ($request->quantity > $request->productQuantity) {
            session()->flash('errors', collect(['We currently do not have enouogh items in stock.']));
            return response()->json(['success' => false], 400); //400 is an error code
        }

        Cart::update($id, $request->quantity);
        session()->flash('success_message', 'Quantity was updated successfully!');
        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);

        return back()->with('success_message', 'Item has been removed!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function switchToSaveForLater($id)
    {
        $item = Cart::get($id);

        Cart::remove($id);

        $duplicates = Cart::instance('saveForLater')->search(function ($cartItem, $rowId) use ($id) {
            return $rowId === $id;
        });

        if ($duplicates->isNotEmpty()) {
            return redirect()->route('cart.index')->with('success_message', 'Item is already Saved For Later!');
        }

        // instance is used for other cart
        Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price)
            ->associate('App\Models\Product');

        return redirect()->route('cart.index')->with('success_message', 'Item has been Saved For Later!');
    }
    
     public function clearcart(){
          Cart::destroy();
         return back()->with('success_message', 'Your Cart has been cleared!');
     
     }
    
}
