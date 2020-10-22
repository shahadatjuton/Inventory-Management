@extends('layouts.backend.master')

@section('title', 'Manage Sales')

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
            <h1 class="m-0 text-dark">Manage Sales</h1>
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
               <h4>Add Sale</h4>
                  <a class="btn btn-success btn-sm float-right " href="{{route('admin.sale.index')}}">
                      <i class="fa fa-list"> Sales List</i>
                  </a>
              </div><!-- /.card-header -->
              <div class="card-body">
                  <form action="{{route('admin.sale.cart')}}" method="post" id="createProduct" enctype="multipart/form-data">
                      @csrf
                    <div class="form-row">

                        <div class="form-group col-md-3">
                            <label>Category Name</label>
                            <select name="category_id" id="category_id" class="form-control select2" style="width: 100%;">
                                <option selected="selected">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Product Name</label>
                            <select name="product_id" id="product_id" class="form-control select2" style="width: 100%;">
                                <option selected="selected">Select Product </option>
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <label class="text-center"> Quantity </label>
                            <input id="quantity" class="form-control" readonly>
                        </div>

                        <div class="form-group col-md-2">
                            <label class="text-center"> Quantity </label>
                            <input type="number" name="quantity" class="form-control">
                        </div>

                        <div class="form-group col-md-2">
                            <label class="text-center"> Selling Price </label>
                            <input type="number" name="selling_price" class="form-control">
                        </div>
                        <div class="form-group col-md-4 offset-5">
                            <a href="{{route('admin.purchase.index')}}" class="btn btn-dark"> Back </a>
                            <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle">Add Item</i></button>
{{--                            <a type="submit" class="btn btn-success addEvent" id="addEvent"><i class="fa fa-plus-circle">Add Item</i></a>--}}
                        </div>
                    </div>
                  </form>
              </div><!-- /.card-body -->

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Serial No</th>
                                <th> Category </th>
                                <th> Product Name </th>
                                <th> Quantity </th>
                                <th> Selling Price </th>
                                <th> Total Amount </th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($carts as $key => $cart)
                                <tr>
                                    <td>{{$key +1 }}
                                    <td> {{\App\Model\Product::find($cart->product_id)->category->name}}</td>
                                    <td>{{\App\Model\Product::find($cart->product_id)->name}}</td>
                                    <td>
                                        {{$cart->quantity}}
                                    </td>
                                    <td>{{$cart->price}}</td>
                                    <td>{{$cart->total}}</td>
                                    <td>

                                        <a href="{{route('admin.purchase.cart',$cart->id)}}" class="btn btn-danger btn-sm" title="Remove">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>


                            @empty
                            @endforelse
                            <tr>
                                <td colspan="4"></td>
                                <td>Grand Total</td>
                                <td><b>{{$carts->sum('total')}}</b></td>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="sale-form">
                        <form action="{{route('admin.sale.store')}}" method="post" id="createProduct" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
{{--                                hidden field            --}}
                                <input type="hidden" name="grand_total" value="{{$carts->sum('total')}}">

                                <div class="form-group col-md-3">
                                    <label>Paid Status</label>
                                    <select name="paid_status" id="category_id" class="form-control select2" style="width: 100%;">
                                        <option selected="selected">Select Status</option>
                                        <option value="Paid">Paid</option>
                                        <option value="Due">Due</option>
                                        <option value="Partial">Partial</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Discount</label>
                                    <input type="number" name="discount" class="form-control" min="0" value="0">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Paid Amount</label>
                                    <input type="number" name="paid_amount" class="form-control" value="0">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Customer</label>
                                    <select name="customer_id" id="customer_id" class="form-control select2" style="width: 100%;">
                                        <option selected="selected">Select Customer</option>
                                        @foreach($customers as $customer)
                                        <option value="{{$customer->id}}">{{$customer->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6 offset-3">
                                    <label class="text-center"> Description </label>
                                    <textarea name="description" rows="3" cols="50"></textarea>
                                </div>
                                <div class="form-group col-md-4 offset-5">
                                    <button type="submit" class="btn btn-success">Sale</button>
                                    <a class="btn btn-danger" href="{{route('admin.purchase.cart.clear')}}">Clear</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>



{{--                Another Card Body For item list --}}
{{--                <div class="card-body">--}}
{{--                    <form action="{{route('admin.purchase.store')}}" method="post" id="createProduct" enctype="multipart/form-data">--}}
{{--                    @csrf--}}
{{--                        <table class="table-sm table-bordered">--}}
{{--                            <thead>--}}
{{--                              <tr>--}}
{{--                                  <th>Category</th>--}}
{{--                                  <th>Product Name</th>--}}
{{--                                  <th width="7%">Pcs/Kg</th>--}}
{{--                                  <th width="10%">Unit Price</th>--}}
{{--                                  <th>Description</th>--}}
{{--                                  <th width="10%">Total Price</th>--}}
{{--                                  <th>Action</th>--}}
{{--                              </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody id="addRow" class="addRow">--}}

{{--                            </tbody>--}}
{{--                            <tbody>--}}
{{--                            <tr>--}}
{{--                                <td colspan="5"></td>--}}
{{--                                <td>--}}
{{--                                    <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control form-control-sm text-right estimated_amount" readonly style="background-color: #0c525d">--}}
{{--                                </td>--}}
{{--                                <td></td>--}}
{{--                            </tr>--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                        <br>--}}
{{--                        <div class="form-group">--}}
{{--                            <button type="submit" class="btn btn-primary" id="storeButton">Purchase</button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
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
    <script id="document-template" type="text/x-handlebars-template">
        <tr class="delete-item" id="delete-item">
            <input type="hidden" name="date[]" value="@{{ date }}">
            <input type="hidden" name="purchase_no[]" value="@{{ purchase_no }}">
            <input type="hidden" name="supplier_id[]" value="@{{ supplier_id }}">
            <td>
            <input type="hidden" name="category_id[]" value="@{{ category_id }}">
                @{{ category_name }}
            </td>
            <td>
            <input type="hidden" name="product_id[]" value="@{{ product_id }}">
                @{{ product_name }}
            </td>
            <td>
                <input type="number" min="1" class="form-control form-control-sm text-right quantity" name="quantity[]" value="1">
            </td>
            <td>
                <input type="number" class="form-control form-control-sm text-right unit_price" name="unit_price[]" value="">
            </td>
            <td>
                <input type="text" name="description[]" class="form-control form-control-sm">
            </td>
            <td>
                <input class="form-control form-control-sm text-right buying_price" name="buying_price[]" value="0" readonly>
            </td>
            <td>
                <i class="btn btn-danger btn-sm fa fa-window-close removeevent"></i>
            </td>
        </tr>
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on("click", "addEvent", function () {
                var date = $('#date').val();
                var purchase_no = $('#purchase_no').val();
                var supplier_id = $('#supplier_id').val();
                var category_id = $('#category_id').val();
                var category_name =$('#category_id').find('option:selected').text();
                var product_id = $('#product_id').val();
                var product_name =$('#product_id').find('option:selected').text();

                if (date == ''){
                    $.notify("Date is required",{globalPosition : 'top right', className: 'erroe'});
                    return false;
                }
                if (purchase_no == ''){
                    $.notify("Purchase No is required",{globalPosition : 'top right', className: 'erroe'});
                    return false;
                }
                if (supplier_id == ''){
                    $.notify("Supplier Id is required",{globalPosition : 'top right', className: 'erroe'});
                    return false;
                }
                if (category_id == ''){
                    $.notify("Category Id is required",{globalPosition : 'top right', className: 'erroe'});
                    return false;
                }
                if (product_id == ''){
                    $.notify("Product Id is required",{globalPosition : 'top right', className: 'erroe'});
                    return false;
                }

                var source = $("#document-template").html();
                var template = Handlebars.compile(source);
                var data = {
                    date:date,
                    purchase_no:purchase_no,
                    category_id:category_id,
                    category_name:category_name,
                    product_id:product_id,
                    product_name:product_name
                };
                var html = template(data);
                $("#addRow").append(html);
            });

            $(document).on("click", ".removeevent", function (event) {
                $(this).closest(".delete-item").remove();
                totalAmountPrice();
            });
            $(document).on('keyup click', '.unit_price,.quantity',function () {
                var unit_price = $(this).closest("tr").find("input.unit_price").val();
                var quantity = $(this).closest("tr").find("input.quantity").val();
                var total = unit_price * quantity;
                $(this).closest("tr").find("input.buying_price").val(total);
                totalAmountPrice();
            });
        //    Calculate sum of amount in invoice

            function totalAmountPrice() {
                var sum = 0;
                $(".buying_price").each(function () {
                    var value =$(this).val();
                    if (!isNaN(value) && value.length != 0){
                        sum += parseFloat(value);
                    }
                });
                $('#estimated_amount').val(sum);
            }
        });

    </script>
{{--    Retrieve stock using Ajax--}}
    <script type="text/javascript">
        $(function () {
            $(document).on('change','#product_id',function () {
                var product_id = $(this).val();
                $.ajax({
                    url: "{{route('get-stock')}}",
                    type:"GET",
                    data:{product_id : product_id},
                    success:function (data) {
                        $('#quantity').val(data);
                    }
                });
            });
        });
        {{--    Retrieve Products using Ajax--}}

        $(function () {
            $(document).on('change','#category_id',function () {
                var category_id = $(this).val();
                $.ajax({
                    url: "{{route('get-product')}}",
                    type:"GET",
                    data:{category_id : category_id},
                    success:function (data) {
                        var html = '<option value="">Select Product</option>';
                        $.each(data,function (key,v) {
                            html += '<option value="'+v.id+'">'+v.name+'</option>';
                        });
                        $('#product_id').html(html);
                    }
                });
            });
        });
    </script>


{{--    <script>--}}
{{--        $(function () {--}}
{{--            $('#createProduct').validate({--}}
{{--                rules: {--}}
{{--                    supplier_id: {--}}
{{--                        required: true,--}}
{{--                    },--}}
{{--                    category_id: {--}}
{{--                        required: true,--}}
{{--                    },--}}
{{--                    unit_id: {--}}
{{--                        required: true,--}}
{{--                    },--}}
{{--                    name: {--}}
{{--                        required: true,--}}
{{--                    },--}}

{{--                },--}}
{{--                messages: {--}}

{{--                    name: {--}}
{{--                        required: "Please enter a name"--}}
{{--                    },--}}
{{--                    supplier_id:{--}}
{{--                        required: "Please choose a supplier",--}}
{{--                    },--}}
{{--                    category_id:{--}}
{{--                        required: "Please choose a category",--}}
{{--                    },--}}
{{--                    unit_id:{--}}
{{--                        required: "Please choose a unit",--}}
{{--                    },--}}

{{--                },--}}
{{--                errorElement: 'span',--}}
{{--                errorPlacement: function (error, element) {--}}
{{--                    error.addClass('invalid-feedback');--}}
{{--                    element.closest('.form-group').append(error);--}}
{{--                },--}}
{{--                highlight: function (element, errorClass, validClass) {--}}
{{--                    $(element).addClass('is-invalid');--}}
{{--                },--}}
{{--                unhighlight: function (element, errorClass, validClass) {--}}
{{--                    $(element).removeClass('is-invalid');--}}
{{--                }--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@endpush
