@extends('layouts.backend.master')

@section('title', 'Manage Customer')

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
            <h1 class="m-0 text-dark">Manage Customer</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Customer</li>
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
               <h4>Update Customer</h4>
                  <a class="btn btn-success btn-sm float-right " href="{{route('admin.customer.index')}}">
                      <i class="fa fa-list"> Customer List</i>
                  </a>
              </div><!-- /.card-header -->
              <div class="card-body">
                  <form action="{{route('admin.customer.update',$customer->id)}}" method="post" id="createUser" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <div class="form-row">
                          <div class="form-group col-md-6">
                              <label>Name</label>
                              <input type="text" name="name" value="{{$customer->name}}" class="form-control">
                          </div>
                          <div class="form-group col-md-6">
                              <label>E-mail</label>
                              <input type="email" name="email" value="{{$customer->email}}" class="form-control">
                          </div>
                          <div class="form-group col-md-6">
                              <label>Phone</label>
                              <input type="text" name="phone" value="{{$customer->phone}}" class="form-control">
                          </div>
                          <div class="form-group col-md-6">
                              <label>Address</label>
                              <input type="text" name="address" value="{{$customer->address}}" class="form-control">
                          </div>

                          <div class="form-group col-md-4 offset-5">
                              <a href="{{route('admin.customer.index')}}" class="btn btn-dark">Back</a>
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

            $('#createUser').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 4
                    },
                    password_confirmation: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Please enter a name"
                    },
                    email: {
                        required: "Please enter a email address",
                        email: "Please enter a vaild email address"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    password_confirmation:  {
                        required: "Please provide a password",
                        minlength: "Your password does not match!"
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
