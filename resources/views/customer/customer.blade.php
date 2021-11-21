@extends('Template.master')

@section('title', 'Data Customer')

@section('content')

<!-- <div class="row" style="">
    <div class="col-sm-12 col-md-12 col-xl-12 col-lg-12">
        <div class="container"> -->
            @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @if(isset($errors) && $errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                        {{ $error }}
                        @endforeach
                    </div>
                @endif
                @if (session()->has('failures'))
                    <table class="table table-danger">
                    <tr>
                        <td>Row</td>
                        <td>Attribute</td>
                        <td>Error</td>
                        <td>value</td>
                    </tr>
                    @foreach(session()->get('failures') as $validation)
                        <tr>
                        <td>{{ $validation->row() }}</td>
                        <td>{{ $validation->attribute() }}</td>
                        <td>
                            <ul>
                                @foreach($validation->errors() as $e)
                                <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            {{ $validation->values()[$validation->attribute()]}}
                        </td>
                        </tr>
                    @endforeach
                    </table>
                @endif
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-12 col-xl-12 col-lg-12">
                        <div class="table-responsive">
                            <a href="{{ route('customer.create') }}" class="btn btn-md btn-success mb-3"><i class="far fa-plus-square"></i> TAMBAH DATA CUSTOMER</a>
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                                Import Excel
                            </button>
                                <table id="tables" class="table table-striped table-hover" style="width:100%">
                                <caption>List of Customer</caption>
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>NO</th>
                                            <th>NAMA</th>
                                            <th>ALAMAT</th>
                                            <th>FOTO</th>
                                            <th>PATH</th>
                                            <th>KELURAHAN</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($customers as $customer)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $customer->nama }}</td>
                                        <td>{{ $customer->alamat }}</td>
                                        
                                            <td><img width="150px" src="{{ $customer->foto }}"/></td>
                                        
                                            <td><img width="150px" src="{{ url('/storage/'.$customer->path) }}"></td>
                                        
                                        <td>{{ $customer->kelurahan->name }}</td>                                        
                                        <td class="text-center">
                                        ndak ada aksi
                                    </td>
                                    </tr>

                                  @empty
                                      <div class="alert alert-danger">
                                          Data Customer belum Tersedia.
                                      </div>
                                  @endforelse
                                    </tbody>
                                    <tfoot class="thead-dark">
                                        <tr>
                                            <th>NO</th>
                                            <th>NAMA</th>
                                            <th>ALAMAT</th>
                                            <th>FOTO</th>
                                            <th>PATH</th>
                                            <th>KELURAHAN</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </tfoot>
                                </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- </div>
    </div>
</div> -->
<!-- Modal Import Excel -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="importExcel">
          <form action="{{ url('/customer/export-excel') }}" method="post" enctype="multipart/form-data">
              @csrf
                <div class="item form-group" style="margin-right:-40px;">
                    <label class="control-label col-md-4 col-sm-4 col-xs-12" style="text-align:left; margin-right: -100px;" required>Upload File Excel <span class="required">*</span></label>
                    <div class="col-md-9 col-sm-6 col-xs-12" style="margin-left:60px;">
                        <input type="file" id="excel" name="excel" accept=".xls, .xlsx">
                    </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Import</button>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
<!-- <link rel="stylesheet" href="/css/admin_custom.css"> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css"> -->
<style>
    .table .thead-dark th {
  color: #fff;
  background-color: #212529;
  border-color: #32383e;
}
</style>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
     -->
<script>
    $(document).ready(function() {
    $('#tables').DataTable({
        responsive: true
    });
    } );
</script>

@endsection