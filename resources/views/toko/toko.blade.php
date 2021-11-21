@extends('Template.master')

@section('title', 'Data Toko')

@section('content')

<!-- <div class="row" style="">
    <div class="col-sm-12 col-md-12 col-xl-12 col-lg-12">
        <div class="container"> -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-12 col-xl-12 col-lg-12">
                        <div class="table-responsive">
                            <!-- <a href="{{ route('toko.create') }}" class="btn btn-md btn-success mb-3"><i class="far fa-plus-square"></i> TAMBAH DATA TOKO</a> -->
                            <!-- <a href="{{ url('cetak_barcode')}}" class="btn btn-md btn-info mb-3" target="_blank">CETAK PDF</a> -->
                            <button data-toggle="modal" data-target="#tambahtoko" class="btn btn-md mb-3 btn-success"><i class="far fa-plus-square"></i> TAMBAH DATA TOKO</button>
                                <table id="tables" class="table table-striped table-hover" style="width:100%">
                                <caption>List of Toko</caption>
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>NO</th>
                                            <th>NAMA</th>
                                            <th>BARCODE TOKO</th>
                                            <th>LATITUDE</th>
                                            <th>LONGITUDE</th>
                                            <th>AKURASI</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($tokos as $toko)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $toko->nama_toko }}</td>
                                        
                                        @php
                                            $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
                                        @endphp
                                        <td align="center"><img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($toko->barcode_toko, $generatorPNG::TYPE_CODE_128)) }}">
                                        </td>
                                        <!-- <td class="text-center">
                                        {{ $toko->nama_toko }}
                                        </td>                                      -->
                                        <td class="text-center">
                                        {{ $toko->latitude }}
                                        </td>
                                        <td class="text-center">
                                        {{ $toko->longitude }}
                                        </td>
                                        <td class="text-center">
                                        {{ $toko->akurasi }}
                                        </td>
                                        <td class="text-center">
                                        <a href="{{ url('/cetak_toko/'.$toko->barcode_toko)}}" class="btn btn-md btn-info mb-3" target="_blank">EXPORT PDF</a>
                                        </td>
                                    </tr>

                                  @empty
                                      <div class="alert alert-danger">
                                          Data toko belum Tersedia.
                                      </div>
                                  @endforelse
                                    </tbody>
                                    <tfoot class="thead-dark">
                                        <tr>
                                            <th>NO</th>
                                            <th>NAMA</th>
                                            <th>BARCODE TOKO</th>
                                            <th>LATITUDE</th>
                                            <th>LONGITUDE</th>
                                            <th>AKURASI</th>
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

<!-- Modal -->
<div class="modal fade" id="tambahtoko" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Data Toko</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('toko.store') }}" method="post">
                @csrf
                    <div class="form-group">
                        <label for="barcode">Barcode Number</label>
                        <input type="text" class="form-control" id="barcode" placeholder="Barcode Number" name="barcode_toko" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_toko">Nama Toko</label>
                        <input type="text" class="form-control" id="nama_toko" placeholder="Nama Toko" name="nama_toko" required>
                    </div>
                    <div class="form-group">
                        <label for="latitude">latitude</label>
                        <input type="text" class="form-control" id="latitude" placeholder="Latitude" name="latitude" required>
                    </div>
                    <div class="form-group">
                        <label for="longitude">Longitude</label>
                        <input type="text" class="form-control" id="longitude" placeholder="Longitude" name="longitude" required>
                    </div>
                    <div class="form-group">
                        <label for="accuracy">Accuracy</label>
                        <input type="number" class="form-control" id="accuracy" placeholder="Accuracy" name="accuracy" required>
                    </div>
                    <a class="btn btn-info" id="" href="#" onclick="getLocation()">Generate Location</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
            <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- End modal Tambah -->

<!-- Modal -->
<div class="modal fade" id="pdf" tabindex="-1" role="dialog" aria-labelledby="pdfLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="pdfLabel">Posisi TNJ 108</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/barang/cetakpdf/') }}" method="post">
                @csrf
                    <div class="form-group">
                        <label for="baris_barang">Baris</label>
                        <input type="number" class="form-control" id="baris_barang" placeholder="baris Barang" name="baris_barang" required>
                    </div>
                    <div class="form-group">
                        <label for="kolom_barang">Kolom</label>
                        <input type="number" class="form-control" id="kolom_barang" placeholder="kolom Barang" name="kolom_barang" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
            <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Script Datatables -->
<!-- @php
$generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
@endphp

<img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode('000005263635', $generatorPNG::TYPE_CODE_128)) }}"> -->
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
<script>
var x = document.getElementById("latitude");
var y = document.getElementById("longitude");
var acc = document.getElementById("accuracy");
// var latitude_user;
// var longitude_user;
// var accuracy_user;
function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    x.value = "Geolocation is not supported by this browser.";
    y.value = "Geolocation is not supported by this browser.";
  }
}
function showPosition(position) {
  x.value = position.coords.latitude;
  y.value = position.coords.longitude;
  acc = position.coords.accuracy;
  // latitude_user = position.coords.latitude;
  // longitude_user = position.coords.longitude;
}
</script>

@endsection