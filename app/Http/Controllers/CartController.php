<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function viewCart() {
        $cart_items = Session::get('cart_items');
        return view('cart/index', compact('cart_items'));
    }

    public function addToCart($id) {
        $product = Product::find($id);

        $cart_items = Session::get('cart_items');
        if(is_null($cart_items)) $cart_items = [];

        $qty = 0;
        if(array_key_exists($product->id, $cart_items)) $qty = $cart_items[$product->id]['qty'];

        $cart_items[$product['id']] = [
            'id' => $product->id,
            'code' => $product->code,
            'name' => $product->name,
            'price' => $product->price,
            'image_url' => $product->image_url,
            'qty' => $qty + 1,
        ];

        Session::put('cart_items', $cart_items);
        return redirect('cart/view');
    }

    public function deleteCart($id) {
        $cart_items = Session::get('cart_items');
        unset($cart_items[$id]);
    
        Session::put('cart_items', $cart_items);
        return redirect('cart/view');
    }

    public function updateCart($id, $qty) {
        if(is_numeric($qty) && $qty > 0) {
            $cart_items = Session::get('cart_items');
            $cart_items[$id]['qty'] = $qty;
            
            Session::put('cart_items', $cart_items);
            return redirect('cart/view');
        } else {
            return redirect('cart/view')->with('error', 'Quantity must be a valid number greater than 0');
        }
    }
    
}
