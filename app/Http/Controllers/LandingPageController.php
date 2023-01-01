<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;
use DB;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Category::all();
        $generalproducts = Product::where('featured', true)->take(8)->inRandomOrder()->get();
        $products = Product::take(8)->inRandomOrder()->get();
        $reviews = Review::all();

        return view('index', compact('products', 'generalproducts', 'categories', 'reviews'));
    }

   
    public function about()
    {
        return view('about');
    }
    public function shipping()
    {
        return view('shipping');
    }
    public function terms()
    {
        return view('terms');
    }
    public function refund_policy()
    {
        return view('refund_policy');
    }
    public function policy()
    {
        return view('policy');
    }
}
