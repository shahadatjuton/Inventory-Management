@extends('layouts.backend.master')

@section('title', 'Manage Report')

@push('css')

@endpush

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <link href="{{asset('assets/backend/css/invoice.css')}}" rel="stylesheet">
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
        @if($low_stocks->count() < 1 )
        <div class="text-warning">
            <h3 class="text-center"> No purchase found from </h3>
        </div>
    @endif
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
                        <div class="col invoice-details">
                            <h1 class="invoice-id text-center"> Low Stock Counts When Product Quantity Is Less Than 20 </h1>
                        </div>
                    </div>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <thead>
                        <tr>
                            <th>Serial Number</th>
                            <th>Category</th>
                            <th>Product Name</th>
                            <th>Current Stock</th>
                            <th>Total Sold</th>
                            <th>Total Purchased</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($low_stocks as $key=>$low_stock)
                            <tr>
                                <td>{{$key +1}}</td>
                                <td>{{$low_stock->category->name}}</td>
                                <td>{{$low_stock->name}}</td>
                                <td>{{$low_stock->quantity}}</td>
                                <td>{{$low_stock->saleDetails->SUM('quantity')}} </td>
                                <td>{{$low_stock->purchaseDetails->SUM('quantity')}} </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </main>


                <div class="float-right">
                    <div class="signature-right">
                        ....................................................
                        <h4>Owner Signature</h4>
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
