@extends('Template.master')

@section('title', 'Data Customer')

@section('content')

<!-- <div class="row" style="">
    <div class="col-sm-12 col-md-12 col-xl-12 col-lg-12">
        <div class="container"> -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-12 col-xl-12 col-lg-12">
                        <div class="table-responsive">
                            <a href="{{ route('customer.create') }}" class="btn btn-md btn-success mb-3"><i class="far fa-plus-square"></i> TAMBAH DATA CUSTOMER</a>
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