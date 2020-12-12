<?php

namespace App\Http\Controllers\Admin;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Model\Customer;
use App\Model\Order;
use App\Model\Product;
use App\Model\Purchase;
use App\Model\Supplier;
use App\Sale;
use App\SaleDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $last_week = Carbon::now()->subDays(7);
        $last_moth = Carbon::now()->subDays(30);
        $data['total_products'] = Product::all()->count();
        $data['total_suppliers'] = Supplier::all()->count();
        $data['total_sales'] = Sale::all()->count();
        $data['customers'] = Customer::all()->count();
        $data['total_sale_amount'] = Sale::all()->sum('total');
        $data['total_purchase_amount'] = Purchase::all()->sum('total_amount');

        $data['total_quantity_of_products'] = Product::all()->sum('quantity');
        $data['last_week_sales'] = Sale::where('created_at', '>=',$last_week)->count();
        $data['last_month_sales'] = Sale::where('created_at', '>=',$last_moth)->count();
        return view('admin.dashboard',$data);
    }
}
