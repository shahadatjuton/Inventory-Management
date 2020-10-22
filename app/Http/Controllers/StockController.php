<?php

namespace App\Http\Controllers;

use App\Model\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(){
        $products = Product::latest()->get();
        return view('stock.stockList',compact('products'));
    }
}
