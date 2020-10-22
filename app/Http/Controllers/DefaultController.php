<?php

namespace App\Http\Controllers;

use App\Model\Product;
use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function getCategory(Request $request){
        $supplier_id = $request->supplier_id;
        $categories = Product::with(['category'])->select('category_id')->where('supplier_id',$supplier_id)->groupBy('category_id')->get();
        return response()->json($categories);
    }

    public function getProduct(Request $request){
        $category_id = $request->category_id;
        $products = Product::where('category_id',$category_id)->get();
        return response()->json($products);
    }

    public function getStock(Request $request){
        $sproduct_id = $request->product_id;
        $stock = Product::where('id', $sproduct_id)->first()->quantity;
        return response()->json($stock);
    }
}

