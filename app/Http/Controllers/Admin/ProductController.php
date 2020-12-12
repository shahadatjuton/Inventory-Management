<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Product;
use App\Model\Supplier;
use App\Model\Unit;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Milon\Barcode\DNS2D;

class ProductController extends Controller
{
    public function index(){
        $products = Product::latest()->get();
        return view('admin.product.productList',compact('products'));
    }

    public function create(){
        $data['suppliers'] = Supplier::latest()->get();
        $data['categories'] = Category::latest()->get();
        $data['units'] = Unit::latest()->get();
        return view('admin.product.createProduct',$data);
    }

    public function store(Request $request){

        $this->validate($request,[
            'name'=>'required',
            'supplier_id'=>'required',
            'category_id'=>'required',
            'unit_id'=>'required',
            'product_code'=>'required',
        ]);

        $image = $request->file('image');
        $slug = str::slug($request->name);

        if (isset($image)) {
            $currant_date=Carbon::now()->toDateString();
            $image_name=$slug.'-'.$currant_date.'-'.uniqid().'.'.$image->getClientOriginalExtension();

            //==========Check and set Image Directory==================
            if (!Storage::disk('public')->exists('product')) {

                Storage::disk('public')->makeDirectory('product');
            }

            $imageSize=Image::make($image)->resize(1600,1066)->save($image->getClientOriginalExtension());

            Storage::disk('public')->put('product/'.$image_name,$imageSize);

        }else {

            $image_name="default.png";
        }
        $product = new Product();
        $product->name = $request->name;
        $product->barcode = $request->product_code;
        $product->supplier_id= $request->supplier_id;
        $product->category_id= $request->category_id;
        $product->unit_id= $request->unit_id;
        $product->created_by = Auth::id();
        $product->quantity = 0;
        $product->image = $image_name;
        $product->save();
        Toastr::success('Product created successfully','Success!!');
        return redirect()->route('admin.product.index');
    }

    public function edit($id){
        $data['product'] = Product::findOrFail($id);
        $data['suppliers'] = Supplier::latest()->get();
        $data['categories'] = Category::latest()->get();
        $data['units'] = Unit::latest()->get();
        return view('admin.product.editProduct',$data);
    }
    public function update(Request $request, $id){
        $this->validate($request,[
            'name'=>'required',
            'supplier_id'=>'required',
            'category_id'=>'required',
            'quantity'=>'required',
            'product_code'=>'required',
        ]);
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->supplier_id= $request->supplier_id;
        $product->category_id= $request->category_id;
        $product->unit_id= $request->unit_id;
        $product->updated_by = Auth::id();
        $product->barcode = $request->product_code;
        $product->quantity = 0;
        $product->save();
        Toastr::success('Product Has Been Updated Successfully','Success!!');
        return redirect()->route('admin.product.index');
    }
    public function destroy($id){

        $product = Product::findOrFail($id);
        $product->delete();
        Toastr::success('Product has been deleted successfully','Success!!');
        return redirect()->route('admin.product.index');
    }


}
