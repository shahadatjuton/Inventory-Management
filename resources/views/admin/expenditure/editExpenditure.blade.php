@extends('layouts.backend.master')

@section('title', 'Manage Unit')

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
            <h1 class="m-0 text-dark">Manage Unit</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Unit</li>
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
               <div class="text-left">
                   <img src="{{asset('storage/voucher/'.$expenditure->voucher)}}" alt="{{$expenditure->voucher}}'Images" height="120" width="140">
               </div>
                  <a class="btn btn-success btn-sm float-right " href="{{route('admin.unit.index')}}">
                      <i class="fa fa-list"> Unit List</i>
                  </a>
              </div><!-- /.card-header -->
              <div class="card-body">
                  <form action="{{route('admin.expenditure.update',$expenditure->id)}}" method="post" id="createUser" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <div class="form-row">
                          <div class="form-group col-md-6">
                              <label class="text-center"> Purpose </label>
                              <input type="text" name="purpose" class="form-control" value="{{$expenditure->purpose}}">
                          </div>
                          <div class="form-group col-md-6">
                              <label class="text-center"> Amount</label>
                              <input type="text" name="amount" class="form-control" value="{{$expenditure->amount}}">
                          </div>
                          <div class="form-group col-md-6">
                              <label class="text-center"> Upload Voucher</label>
                              <input type="file" name="voucher" class="form-control">
                          </div>
                          <div class="form-group col-md-4 offset-5">
                              <a href="{{route('admin.expenditure.index')}}" class="btn btn-dark">Back</a>
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

                },
                messages: {
                    name: {
                        required: "Please enter a name"
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
