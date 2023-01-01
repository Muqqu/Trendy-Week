<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
     public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $categoryId = $request->input('category');

        $query = Product::query();

        if ($searchTerm) {
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }

        if ($categoryId) {
            $query->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('id', $categoryId);
            });
        }

        $results = $query->get();

        return view('search', compact('categories', 'results'));
    }
}
