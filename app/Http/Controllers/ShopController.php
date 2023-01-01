<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Analytics;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use GuzzleHttp\Client;
use DB;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Paginator::useBootstrap();

        $pagination = 500;
        $categories = Category::all();


        if (request()->category) {
            $products = Product::with('categories')->whereHas('categories', function ($query) {
                $query->where('slug', request()->category);
            });

            $categoryName = optional($categories->where('slug', request()->category)->first())->name;
        } else {
            $categoryName = 'Featured';
        }

        if (request()->sort == 'low_high') {
            $products = Product::orderBy('price')->paginate($pagination);
        } elseif (request()->sort == 'high_low') {
            $products = Product::orderBy('price', 'desc')->paginate($pagination);
        } else {
            $products = Product::paginate($pagination);
        }

        return view('shop')->with([
            'products' => $products,
            'categories' => $categories,
            'categoryName' => $categoryName,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $client = new Client();
        // $response = $client->get('https://api.ipregistry.co/?key=tryout');

        // // Decode the JSON response
        // $data = json_decode($response->getBody(), true);
        //dd($data);
        Analytics::create([
            'event' => 'product.show',
            'slug' => $slug,
        ]);
        $product = Product::where('slug', $slug)->firstOrFail();
        $mightAlsoLike = Product::where('slug', '!=', $slug)->mightAlsoLike()->get();

      //  $stockLevel = getStockLevel($product->quantity);

        // return view('product')->with([
        //     'product' => $product,
        //     'stockLevel' => $stockLevel,
        //     'mightAlsoLike' => $mightAlsoLike
        //     ]);
        $category = Category::where('id', '1')->take(8)->inRandomOrder()->firstOrFail();
        $products = $category->products;
        //$products = Product::where('featured', true)->take(8)->inRandomOrder()->get();
        return view('product')->with([
            'product' => $product,
         //   'stockLevel' => $stockLevel,
            'mightAlsoLike' => $mightAlsoLike,
            'products' => $products,
        ]);
    }

    public function search(Request $request)
    {
        Paginator::useBootstrap();

        $request->validate([
            'query' => 'required|min:3',
        ]);

        $query = $request->input('query');

        // $products = Product::where('name', 'like', "%$query%")
        //                     ->orWhere('details', 'like', "%$query%")
        //                     ->orWhere('description', 'like', "%$query%")
        //                     ->paginate(10);

        $products = Product::search($query)->paginate(10);

        return view('search-results')->with('products', $products);
    }

    public function searchAlgolia(Request $request)
    {
        return view('search-results-algolia');
    }
}
