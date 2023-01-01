<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class CategoryProductController extends Controller
{
    //
     public function show($slug)
    {
  
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = $category->products;
      $category = null;
      

         return view('shop')->with([
            'products' => $products,
            'category' => $category,
            ]);
    }
}
