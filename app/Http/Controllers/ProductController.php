<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    var $rp = 3;

    public function index()
    {
        $products = Product::paginate($this->rp);
        return view('product/index', compact('products'));
    }

    public function search(Request $request)
    {
        $query = $request->q;

        if ($query) {
            $products = Product::where('code', 'like', '%' . $query . '%')
                ->orWhere('name', 'like', '%' . $query . '%')
                ->paginate($this->rp);
        } else {
            $products = Product::paginate($this->rp);
        }

        return view('product/index', compact('products'));
    }

    public function edit($id = null)
    {
        $categories = Category::pluck('name', 'id')->prepend('เลือกรายการ', '');
        $product = Product::find($id);

        if ($id) {
            $product = Product::where('id', $id)->first();
            return view('product/edit')
                ->with('product', $product)
                ->with('categories', $categories);

        } else {
            return view('product/add')
                ->with('categories', $categories);
        }
    }

    public function update(Request $request)
    {
        $rules = [
            'code' => 'required',
            'name' => 'required',
            'category_id' => 'required|numeric',
            'price' => 'numeric',
            'stock_qty' => 'numeric',
        ];

        $messages = [
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน',
            'numeric' => 'กรุณากรอกข้อมูล :attribute ให้เป็นตัวเลข',
        ];

        $id = $request->id;
        $temp = [
            'code' => $request->code,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stock_qty' => $request->stock_qty,
        ];

        $validator = Validator::make($temp, $rules, $messages);

        if ($validator->fails()) {
            return redirect('product/edit/' . $id)
                ->withErrors($validator)
                ->withInput();
        }

        $product = Product::find($id);
        $product->code = $request->code;
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->stock_qty = $request->stock_qty;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $upload_to = 'upload/images';
            $relative_path = $upload_to . '/' . $file->getClientOriginalName();
            $absolute_path = public_path($upload_to);
            $file->move($absolute_path, $file->getClientOriginalName());

            Image::make(public_path($relative_path))->resize(320, 250)->save();

            $product->image_url = $relative_path;
        }

        $product->save();

        return redirect('product')
            ->with('ok', true)
            ->with('msg', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }

    public function insert(Request $request) {

        $product = new Product();
        $product->code = $request->code;
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->stock_qty = $request->stock_qty;
        $product->price = $request->price;

        $product->save();

        return redirect('product')
        ->with('ok', true)
        ->with('msg', 'เพิ่มข้อมูลเรียบร้อยแล้ว');

    }
}
