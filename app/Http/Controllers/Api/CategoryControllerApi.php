<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryControllerApi extends Controller
{
    public function category_list() {
        $categories = Category::all();
        return response()->json(['ok' => true, 'categories' => $categories]);
    }
}
