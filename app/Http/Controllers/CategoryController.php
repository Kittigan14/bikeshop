<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    var $rp = 5;

    public function index()
    {
        $categorys = Category::all();
        return view('category/index', compact('categorys'));
    }

    public function search(Request $request)
    {
        $query = $request->q;

        if ($query) {
            $categorys = Category::where('id', 'like', '%' . $query . '%')
                ->orWhere('name', 'like', '%' . $query . '%')
                ->paginate($this->rp);
        } else {
            $categorys = Category::paginate($this->rp);
        }

        return view('category/index', compact('categorys'));
    }

    public function edit($id = null)
    {
        $category = Category::find($id);

        if ($id) {
            $category = Category::where('id', $id)->first();
            return view('category/edit')
                ->with('category', $category);

        } else {
            return view('category/add')
                ->with('category', $category);
        }
    }

    public function update(Request $request) {

        $id = $request->id;
        $category = Category::find($id);
        $category->name = $request->name;

        $category->save();

        return redirect('category')
            ->with('ok', true)
            ->with('msg', 'บันทึกข้อมูลเรียบร้อยแล้ว');
    }

    public function insert(Request $request) {

        $category = new Category();
        $category->name = $request->name;

        $category->save();

        return redirect('category')
        ->with('ok', true)
        ->with('msg', 'เพิ่มข้อมูลเรียบร้อยแล้ว');

    }

    public function remove($id) {

        Category::find($id)->delete();

        return redirect('category')
        ->with('ok', true)
        ->with('msg', 'ลบข้อมูลสำเร็จ');
        
    }

}
