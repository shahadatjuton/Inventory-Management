@extends('layouts.backend.master')

@section('title', 'Manage Sale')

@push('css')

@endpush

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
{{--    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">--}}
    <link href="{{asset('assets/backend/css/invoice.css')}}" rel="stylesheet">
{{--    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>--}}
{{--    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>--}}
    <!------ Include the above in your HEAD tag ---------->

    <!--Author      : @arboshiki-->
    <div id="invoice">

        <div class="toolbar hidden-print">
            <div class="text-right">
                <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
                <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
            </div>
            <hr>
        </div>
        <div class="invoice overflow-auto">
            <div style="min-width: 600px">
                <header>
                    <div class="row">
                        <div class="col">
                            <h4>POS</h4>
                        </div>
                        <div class="col company-details">
                            <h2 class="name">
                                <a target="_blank" href="https://lobianijs.com">
                                    POS
                                </a>
                            </h2>
                            <div>18-Kemal Ataturk, Banani , Dhaka.</div>
                            <div>(123) 456-789</div>
                            <div>company@example.com</div>
                        </div>
                    </div>
                </header>
                <main>
                    <div class="row contacts">
                        <div class="col invoice-to">
                            <div class="text-gray-light">INVOICE TO:</div>
                            <h2 class="to">{{$sale->customer->name}}</h2>
                            <div class="email">{{$sale->customer->phone}}</div>
                            <div class="email">{{$sale->customer->email}}</div>
                            <div class="address">{{$sale->customer->address}}</div>

                        </div>
                        <div class="col invoice-details">
                            <h1 class="invoice-id">{{$sale->invoice_no}}</h1>
                            <div class="date">Date of Sale: {{$sale->created_at->format('d-M-Y')}}</div>
                            <div class="date">Invoice Created: {{$date->format('d-M-Y')}}</div>
                        </div>
                    </div>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <thead>
                        <tr>
                            <th>Serial Number</th>
                            <th>Product Name</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>TOTAL</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sale_details as $key=>$sale_detail)
                            <tr>
                                <td>{{$key +1}}</td>
                                <td>{{\App\Model\Product::find($sale_detail->product_id)->name}}</td>
                                <td>{{$sale_detail->unit_price}}</td>
                                <td>{{$sale_detail->quantity}}</td>
                                <td>{{$sale_detail->total}} TAKA</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">SUBTOTAL</td>
                            <td>{{$sale_details->sum('total')}} TAKA</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">DISCOUNT</td>
                            <td>{{$payment->discount_amount}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">PAID AMOUNT</td>
                            <td>{{$payment->paid_amount}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">DUE</td>
                            <td>{{$payment->due_amount}}</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">GRAND TOTAL</td>
                            <td>{{ $payment->total_amount - $payment->discount_amount }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </main>

                <div class="float-left">
                    <div class="signature-left">
                        ....................................................
                        <h4>Customer Signature</h4>
                    </div>
                </div>
                <div class="float-right">
                    <div class="signature-right">
                        ....................................................
                        <h4>Authority Signature</h4>
                    </div>
                </div>
            </div>
            <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
            <div></div>
        </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @endsection

@push('js')
    <script type="text/javascript">

    </script>
@endpush
