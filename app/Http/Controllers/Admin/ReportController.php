<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Purchase;
use App\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller
{
    public function dailySaleReport(Request $request){
        return view('report.date_wise_sales_report');
    }

    public function generateDailySaleReport(Request $request){
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $sales = Sale::whereBetween('created_at',[$start_date, $end_date])->get();
        return view('pdf.dailySaleInvoice',compact('start_date','end_date','sales'));
    }

    public function dailyPurchaseReport(Request $request){
        return view('report.date_wise_purchase_report');
    }

    public function generateDailyPurchaseReport(Request $request){

        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $purchases = Purchase::whereBetween('created_at',[$start_date, $end_date])->get();
        return view('pdf.dailyPurchaseInvoice',compact('start_date','end_date','purchases'));
    }

    public function lowStock(){
        $low_stocks = Product::where('quantity','<',  25)->get();
        return view('pdf.lowStock',compact('low_stocks'));
    }

    public function lastWeekSaleReport(){
        $last_week = Carbon::now()->subDays(7);
        $last_week_sales = Sale::where('created_at', '>=',$last_week)->get();
        return view('pdf.lastWeekSaleList',compact('last_week_sales'));
    }
    public function lastMonthSaleReport(){
        $last_moth = Carbon::now()->subDays(30);
        $last_month_sales = Sale::where('created_at', '>=',$last_moth)->get();
        return view('pdf.lastMonthSaleList',compact('last_month_sales'));
    }

    public function test(){
        $last_moth = Carbon::now()->subDays(30);
        $last_month_sales = Sale::where('created_at', '>=',$last_moth)->get();

        $pdf = PDF::loadView('pdf.lastMonthSaleList',compact('last_month_sales'));
        return $pdf->download('invoice.pdf');
    }


}
