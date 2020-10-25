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
               <h4>Sales List</h4>
                  <a class="btn btn-success btn-sm float-right " href="{{route('admin.sale.create')}}">
                      <i class="fa fa-plus-circle"> Create Sale </i>
                  </a>
              </div><!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>SL No</th>
                        <th>Sale No</th>
                        <th> No of Products</th>
                        <th> Total Amount </th>
                        <th> Customer Name </th>
                        <th> Purchase Created </th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sales as $key=>$sale)
                    <tr>
                        <td>{{$key +1}}</td>
                        <td>{{$sale->invoice_no}}</td>
                        <td>{{$sale->count()}}</td>
                        <td>{{$sale->total}}</td>
                        <td>{{$sale->customer->name}}</td>
                        <td>{{$sale->created_at->format('d-M-Y')}}</td>
                        <td>
                            <a href="{{route('admin.sale.show',$sale->id)}}" class="btn btn-primary btn-sm" title="View Details">
                                <i class="fa fa-eye"></i>
                            </a>
                            <button type="button"  class="btn btn-danger waves-effect btn-sm" onclick="deletedata({{$sale->id}})">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <form  id="delete-data-{{$sale->id}}" action="{{route('admin.sale.destroy',$sale->id)}}"
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
