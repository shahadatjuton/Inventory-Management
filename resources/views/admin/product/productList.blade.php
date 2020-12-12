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
               <h4>Product List</h4>
                  <a class="btn btn-success btn-sm float-right " href="{{route('admin.product.create')}}">
                      <i class="fa fa-plus-circle"> Add Product </i>
                  </a>
              </div><!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>SL No</th>
                        <th>Barcode</th>
                        <th>Product Image</th>
                        <th>Supplier</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Unit</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $key=>$product)
                    <tr>
                        <td>{{$key +1}} </td>
                        <td>
                            @php
                                echo DNS1D::getBarcodeHTML($product->barcode, 'C39',1,40);
                            @endphp
                        </td>
                        <td>
                            <img src="{{asset('storage/product/'.$product->image)}}" alt="{{$product->name}}'Images" height="40" width="60">
                        </td>
                        <td>{{$product->supplier->name}}</td>
                        <td>{{$product->category->name}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->unit->name}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>
                            <a href="{{route('admin.product.edit',$product->id)}}" class="btn btn-primary btn-sm" title="Edit">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button type="button"  class="btn btn-danger waves-effect btn-sm" onclick="deletedata({{$product->id}})">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <form  id="delete-data-{{$product->id}}" action="{{route('admin.product.destroy',$product->id)}}"
                                   method="post" style="display:none;"
                            >
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
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
    <script type="text/javascript">

        function deletedata(id) {

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-data-' + id).submit();
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }

    </script>
@endpush
