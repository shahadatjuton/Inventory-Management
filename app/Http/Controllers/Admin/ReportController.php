<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Purchase;
use App\Sale;
use Illuminate\Http\Request;

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
}
