<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductControllerApi extends Controller
{
    public function product_list($category_id = null) {
        if ($category_id) $products = Product::where('category_id', $category_id)->get();
        else $products = Product::all();

        return response()->json(['ok' => true, 'products' => $products]);
    }

    public function product_search(Request $request) {
        $query = $request->input('query');
        $products = Product::where('name', 'LIKE', "%{$query}%")->get();

        return response()->json(['ok' => true, 'products' => $products]);
    }
}
