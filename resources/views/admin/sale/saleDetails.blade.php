@extends('layouts.backend.master')

@section('title', 'Manage Sale')

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
            <h1 class="m-0 text-dark">SALE DETAILS</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sale Details</li>
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
                      <h4>Products List</h4>
                      <a class="btn btn-success btn-sm float-right  mr-4" href="{{route('admin.sale.index')}}">
                          <i class="fa fa-list"> Invoice List </i>
                      </a>

                      <a class="btn btn-success btn-sm float-right mr-4 " href="{{route('admin.pdf.invoice')}}">
                        Print Invoice
                      </a>
                  </div><!-- /.card-header -->
                  <div class="card-body">
                      <table id="example1" class="table table-bordered table-hover">
                          <thead>
                          <tr>
                              <th>SL No</th>
                              <th> Invoice No </th>
                              <th> Product Name </th>
                              <th> Quantity </th>
                              <th> Price </th>
                              <th> Total </th>
                          </tr>
                          </thead>
                          <tbody>
                          @foreach($sale_details as $key=>$sale_detail)
                              <tr>
                                  <td>{{$key +1}}</td>
                                  <td>{{$sale->invoice_no}}</td>
                                  <td>{{\App\Model\Product::find($sale_detail->product_id)->name}}</td>
                                  <td>{{$sale_detail->quantity}}</td>
                                  <td>{{$sale_detail->unit_price}}</td>
                                  <td>{{$sale_detail->total}}</td>
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
