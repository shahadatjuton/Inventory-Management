@extends('layouts.backend.master')

@section('title', 'Manage Report')

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
        @if($sales->count() < 1 )
        <div class="text-warning">
            <h3 class="text-center"> No sales found from {{$start_date}} to {{$end_date}}</h3>
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
                            <h1 class="invoice-id text-center">{{$start_date}} To {{$end_date}}</h1>
                        </div>
                    </div>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <thead>
                        <tr>
                            <th>Serial Number</th>
                            <th>Invoice Number</th>
                            <th>Created By</th>
                            <th>Created Date</th>
                            <th>TOTAL</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sales as $key=>$sale)
                            <tr>
                                <td>{{$key +1}}</td>
                                <td>{{$sale->invoice_no}}</td>
                                <td>{{$sale->user->name}}</td>
                                <td>{{$sale->created_at->format('d-M-Y')}}</td>
                                <td>{{$sale->total}} <span>TAKA</span></td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">GRAND TOTAL</td>
                            <td>{{ $sales->sum('total')}} TAKA </td>
                        </tr>
                        </tfoot>
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
