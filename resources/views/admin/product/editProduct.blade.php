@extends('layouts.backend.master')

@section('title', 'Manage Product')

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
                    <h1 class="m-0 text-dark">Manage Product</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Product</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12 ">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Product</h4>
                            <a class="btn btn-success btn-sm float-right " href="{{route('admin.product.index')}}">
                                <i class="fa fa-list"> Product List</i>
                            </a>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{route('admin.product.update',$product->id)}}" method="post" id="createProduct" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-row">

                                    <div class="form-group col-md-4">
                                        <label>Supplier Name</label>
                                        <select name="supplier_id" class="form-control select2" style="width: 100%;">
                                            <option selected="selected">Select Supplier</option>
                                            @foreach($suppliers as $supplier)
                                                <option value="{{$supplier->id}}" {{($product->supplier_id == $supplier->id)?"selected":''}}>{{$supplier->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Category Name</label>
                                        <select name="category_id" class="form-control select2" style="width: 100%;">
                                            <option selected="selected">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}" {{($product->category_id == $category->id)?"selected":''}}>{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Unit Name</label>
                                        <select name="unit_id" class="form-control select2" style="width: 100%;">
                                            <option selected="selected">Select Unit</option>
                                            @foreach($units as $unit)
                                                <option value="{{$unit->id}}" {{($product->unit_id == $unit->id)?"selected":''}}>{{$unit->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="text-center"> Product Name</label>
                                        <input type="text" name="name" class="form-control" value="{{$product->name}}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="text-center"> Buying Price </label>
                                        <input type="number" name="buying_price" class="form-control" value="{{$product->buying_price}}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="text-center"> Selling Price </label>
                                        <input type="number" name="selling_price" class="form-control" value="{{$product->selling_price}}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="text-center"> Quantity </label>
                                        <input type="number" name="quantity" class="form-control" value="{{$product->quantity}}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="text-center"> Product Code</label>
                                        <input type="text" name="product_code" class="form-control" value="{{$product->barcode}}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="text-center"> Product Image</label>
                                        <input type="file" name="image" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4 offset-5">
                                        <a href="{{route('admin.product.index')}}" class="btn btn-dark">Back</a>
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </div>

                            </form>
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- /.card -->
                </section>
                <!-- /.Left col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection

@push('js')
    <script>
        $(function () {

            $('#createProduct').validate({
                rules: {
                    supplier_id: {
                        required: true,
                    },
                    category_id: {
                        required: true,
                    },
                    unit_id: {
                        required: true,
                    },
                    name: {
                        required: true,
                    },


                },
                messages: {

                    name: {
                        required: "Please enter a name"
                    },
                    supplier_id:{
                        required: "Please choose a supplier",
                    },
                    category_id:{
                        required: "Please choose a category",
                    },
                    unit_id:{
                        required: "Please choose a unit",
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endpush
