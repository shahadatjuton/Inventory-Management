<?php

namespace App\Http\Controllers\Admin;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Customer;
use App\Model\Order;
use App\Model\OrderDetails;
use App\Model\Product;
use App\Model\Purchase;
use App\Model\PurchaseDetails;
use App\Model\Supplier;
use App\Model\Unit;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{

    public function index(){
        $purchases = Purchase::latest()->get();
        return view('admin.purchase.purchaseList',compact('purchases'));
    }

    public function create(){

        $data['suppliers'] = Supplier::latest()->get();
        $data['categories'] = Category::latest()->get();
        $data['units'] = Unit::latest()->get();
        $data['carts'] = Cart::where('created_by', Auth::id())->latest()->get();
        return view('admin.purchase.createPurchase',$data);
    }

    public function cart(Request $request){

        $this->validate($request, [
            'product_id'=>'required',
            'quantity'=>'required',
            'buying_price'=>'required',
            'selling_price'=>'required',
            'description'=>'required',
        ]);
        $product = Product::find($request->product_id);

        $cart = new Cart();
        $cart->product_id = $request->product_id;
        $cart->quantity = $request->quantity;
        $cart->buying_price = $request->buying_price;
        $cart->selling_price = $request->selling_price;
        $cart->total_price = $request->quantity * $request->buying_price;
        $cart->description = $request->description;
        $cart->created_by = Auth::id();
        $cart->save();
        Toastr::success('Product added into cart list','Success!');
        return redirect()->back();
    }

    public function cartClear(){
        $carts = Cart::where('created_by', Auth::id())->delete();
        Toastr::success('Cart Has Been cleared','Success!');
        return redirect()->back();
    }

    public function store(Request $request){
        $carts = Cart::where('created_by', Auth::id())->get();
        $sum = Cart::where('created_by', Auth::id())->get()->sum('total_price');
        $product_num =  $carts->count();

// ================      Order Number ========================
        $purchases = Purchase::all()->count();
        if ($purchases > 0){
            $purchase_id = Purchase::where('created_by',Auth::id())->get()->last()->id;
        }
        else{
            $purchase_id = 0;
        }
        $year = Carbon::now()->year;
        $date = Carbon::now()->format('Ymd-');
        $purchase_no = '#'.$date.'PTN-'.str_pad( $purchase_id + 1,  "0", STR_PAD_LEFT);
// ================   Save Purchase ===============================
        $purchase = new Purchase();
        $purchase->purchase_no = $purchase_no;
        $purchase->total_amount = $sum;
        $purchase->created_by = Auth::id();
        $purchase->status = 1;
        $purchase->save();

// ================ Purchase Details ==================================
        $purchase_id = Purchase::where('created_by',Auth::id())->get()->last()->id;
        foreach ($carts as $cart){
            $purchase_details = new PurchaseDetails();
            $purchase_details->purchase_id = $purchase_id;
            $purchase_details->purchase_no = $purchase_no;
            $purchase_details->product_id = $cart->product_id;
            $purchase_details->quantity = $cart->quantity;
            $purchase_details->buying_price = $cart->buying_price;
            $purchase_details->selling_price = $cart->selling_price;
            $product = Product::find($cart->product_id);
            $product->quantity = $product->quantity + $cart->quantity;
            $product->save();

            $purchase_details->save();
        }

        Cart::where('created_by', Auth::id())->delete();
        Toastr::success('Purchase completed','Success!!');
        return redirect()->route('admin.purchase.index');
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
            'unit_id'=>'required',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->supplier_id= $request->supplier_id;
        $product->category_id= $request->category_id;
        $product->unit_id= $request->unit_id;
        $product->updated_by = Auth::id();
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

    public function show($id){
        $purchase = Purchase::find($id);
        $purchase_details = PurchaseDetails::where('purchase_id',$id)->get();
        return view('admin.purchase.purchaseDetails',compact('purchase_details','purchase'));
    }

    public function lastWeek(){
        return 'okay';
    }
}
