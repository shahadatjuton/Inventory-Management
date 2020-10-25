<?php

namespace App\Http\Controllers\Admin;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\Customer;
use App\Model\Product;
use App\Model\Supplier;
use App\Model\Unit;
use App\Payment;
use App\PaymentDetail;
use App\Sale;
use App\SaleCart;
use App\SaleDetail;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class SaleController extends Controller
{
    public function index(){
        $sales = Sale::latest()->get();
        return view('admin.sale.saleList',compact('sales'));
    }

    public function create(){
        $data['customers'] = Customer::latest()->get();
        $data['categories'] = Category::latest()->get();
        $data['units'] = Unit::latest()->get();
        $data['carts'] = SaleCart::where('created_by', Auth::id())->latest()->get();
        return view('admin.sale.createSale',$data);
    }

    public function cart(Request $request){

        $this->validate($request, [
            'product_id'=>'required',
            'quantity'=>'required',
            'selling_price'=>'required',
        ]);
//        $product = Product::find($request->product_id);

        $cart = new SaleCart();
        $cart->product_id = $request->product_id;
        $cart->quantity = $request->quantity;
        $cart->price = $request->selling_price;
        $cart->total = $request->quantity * $request->selling_price;
        $cart->created_by = Auth::id();
        $cart->save();
        Toastr::success('Product added into cart list','Success!');
        return redirect()->back();
    }

    public function cartClear(){
        $carts = SaleCart::where('created_by', Auth::id())->delete();
        Toastr::success('Cart Has Been cleared','Success!');
        return redirect()->back();
    }

    public function store(Request $request){
// ================      Last Sale Number ========================
        $sales = Sale::all()->count();
        if ($sales > 0){
            $sale_id = Sale::where('created_by',Auth::id())->get()->last()->id;
        }
        else{
            $sale_id = 0;
        }
        $year = Carbon::now()->year;
        $date = Carbon::now()->format('Ymd-');
        $invoice_no = '#'.$date.'STN-'.str_pad( $sale_id + 1,  "0", STR_PAD_LEFT);
// ================   Save Purchase ===============================
        $sale = new Sale();
        $sale->customer_id = $request->customer_id;
        $sale->invoice_no = $invoice_no;
        $sale->total = $request->grand_total;
        $sale->description = $request->description;
        $sale->status = 1;
        $sale->created_by = Auth::id();

        DB::transaction(function () use ($request, $sale){
                if ($sale->save()){
                    $sale_carts = SaleCart::where('created_by', Auth::id())->get();
                    foreach ($sale_carts as $sale_cart){

                        $sale_details = new SaleDetail();
                        $sale_details->sale_id = $sale->id;
                        $sale_details->product_id = $sale_cart->product_id;
                        $sale_details->quantity = $sale_cart->quantity;
                        $sale_details->unit_price = $sale_cart->price;
                        $sale_details->total = $sale_cart->total;
                        $sale_details->status = 1;

                        $product = Product::find($sale_cart->product_id);
                        $product->quantity = $product->quantity - $sale_cart->quantity;
                        $product->save();
                        $sale_details->save();
                    }

                    if ($request->grand_total > $request->paid_amount){
                        $before_discount = $request->grand_total - $request->paid_amount;
                        $due = $before_discount - $request->discount;
                        $paid_status = "Partial-Paid";
                    }elseif ($request->grand_total == $request->paid_amount){
                        $due = 0;
                        $paid_status = "Full-Paid";
                    }elseif( $request->paid_amount > $request->grand_total){
                        Toastr::warning('Paid Amount Can Not Be Greater Than Total Amount','Warning!!');
                        return redirect()->back();
                    }
                    elseif ($request->paid_amount == 0){
                        $paid_status = "Full-Due";
                    }

                    $payment = new Payment();
                    $payment->sale_id = $sale->id;
                    $payment->customer_id = $request->customer_id;
                    $payment->paid_status = $paid_status;
                    $payment->paid_amount = $request->paid_amount;
                    $payment->due_amount = $due;
                    $payment->discount_amount = $request->discount;
                    $payment->total_amount = $request->grand_total;
                    $payment->save();

                    $payment_details = new PaymentDetail();
                    $payment_details->sale_id = $sale->id;
                    $payment_details->payment_id = $payment->id;
                    $payment_details->current_paid_amount = $request->paid_amount;
                    $payment_details->date = Carbon::now();
                    $payment_details->updated_by = Auth::id();
                    $payment_details->save();


                    $sale_carts = SaleCart::where('created_by', Auth::id())->delete();
                }
        });

        Toastr::success('Sale completed Successfully!','Success!!');
        return redirect()->route('admin.sale.index');

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

        $sale = Sale::findOrFail($id);
        $sale->delete();
        Toastr::success('Sale has been deleted successfully','Success!!');
        return redirect()->route('admin.sale.index');
    }

    public function show($id){
//        $data['date'] = Carbon::now();
//        $data['sale'] = Sale::find($id);
//        $data['payment'] = Payment::where('sale_id',$id)->get();
//        $data['sale_details'] = SaleDetail::where('sale_id',$id)->get();
            $date  = Carbon::now();
            $sale = Sale::find($id);
            $payment = Payment::where('sale_id',$id)->first();
            $sale_details = SaleDetail::where('sale_id',$id)->get();

//        $pdf = PDF::loadView('admin.sale.saleInvoice', compact('date','sale','payment','sale_details'));
//        return $pdf->stream('invoice.pdf');

         return view('admin.sale.saleInvoice',compact('date','sale','payment','sale_details'));
    }

    public function pdfInvoice(){
        $pdf = PDF::loadView('pdf.invoice');
        return $pdf->stream('invoice.pdf');

    }

//$pdf = PDF::loadView('admin.reports.user', compact('users'));
//return $pdf->stream('user_report.pdf');


}
