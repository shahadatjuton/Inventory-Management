<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Category;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::latest()->get();
        return view('admin.category.categoryList',compact('categories'));
    }
    public function create(){
        return view('admin.category.createCategory');
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->slug = str::slug($request->name);
        $category->created_by = Auth::id();
        $category->save();
        Toastr::success('Category created successfully','Success!!');
        return redirect()->route('admin.category.index');
    }

    public function edit($id){
        $category = Category::findOrFail($id);
        return view('admin.category.editCategory',compact('category'));
    }
    public function update(Request $request, $id){

        $this->validate($request,[
            'name'=>'required',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug = str::slug($request->name);
        $category->updated_by = Auth::id();
        $category->save();
        Toastr::success('Category Updated successfully','Success!!');
        return redirect()->route('admin.category.index');
    }
    public function destroy($id){
        $category = Category::findOrFail($id);
        $category->delete();
        Toastr::success('Category has been deleted successfully','Success!!');
        return redirect()->route('admin.category.index');
    }
}
