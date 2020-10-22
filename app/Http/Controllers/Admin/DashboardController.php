<?php

namespace App\Http\Controllers\Admin;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Model\Customer;
use App\Model\Order;
use App\Model\Product;
use App\Model\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){

        $last_week = Carbon::now()->subDays(7);
        $last_moth = Carbon::now()->subDays(30);
        $total_products = Product::all()->count();
        $total_suppliers = Supplier::all()->count();
        $total_sales = Order::all()->count();
        $customers = Customer::all()->count();
        $total_sale_amount = Order::all()->sum('total');
        $total_quantity_of_products = Product::all()->sum('quantity');
        $last_week_sales = Order::where('created_at', '>=',$last_week)->count();
        $last_month_sales = Order::where('created_at', '>=',$last_moth)->count();
        return view('admin.dashboard',compact('total_products','total_suppliers',
            'total_sales','customers','last_week_sales','last_month_sales','total_sale_amount','total_quantity_of_products'));
    }

}
