<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
class ProductController extends Controller
{
    //
    public function addProduct(Request $request)
    {
        $categories = Category::all();
         return view('addProduct',compact('categories'));
    }
     public function storeProduct(Request $request)
    {
       
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products',
            'details' => 'nullable|string|max:255',
            'price' => 'required',
            'description' => 'nullable|string',
            'featured' => 'required|boolean',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle image upload
        $imageName = null;
      
         $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('img/products'), $imageName);
                $imagePaths[] = $imageName;
            }
        }
        // Insert into the database using DB facade
         $product = Product::create([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'details' => $request->input('details'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'featured' => $request->input('featured'),
            'quantity' => $request->input('quantity'),
            'image' => $imageName,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $ids = $request->category_id ;
        if ($ids) {
        if ($ids) {
    $product->categories()->attach($ids);
}
        }

        foreach ($imagePaths as $imagePath) {
            $product->productImages()->create([
                'path' => $imagePath,
            ]);
        }


        

        return redirect('/')->with('success', 'Product added successfully!');
    }
}
