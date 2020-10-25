
@extends('layouts.backend.master')

@section('title', 'Manage Report')

@push('css')

@endpush

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark text-center"> Select date to see purchase report </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Sales</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-2">
                    <form action="{{route('admin.report.dailyPurchase')}}" method="post" id="createProduct" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Start Date</label>
                                <input type="date" name="start_date" class="form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>End Date</label>
                                <input type="date" name="end_date" class="form-control">
                            </div>
                            <div class="form-group col-md-4 offset-5">
                                <button type="submit" class="btn btn-success">Generate Report</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->

@endsection

@push('js')
    <script type="text/javascript">

    </script>
@endpush
