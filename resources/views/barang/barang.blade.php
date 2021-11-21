@extends('Template.master')

@section('title', 'Data Barang')

@section('content')

<!-- <div class="row" style="">
    <div class="col-sm-12 col-md-12 col-xl-12 col-lg-12">
        <div class="container"> -->
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-12 col-xl-12 col-lg-12">
                        <div class="table-responsive">
                            <a href="{{ route('barang.create') }}" class="btn btn-md btn-success mb-3"><i class="far fa-plus-square"></i> TAMBAH DATA BARANG</a>
                            <!-- <a href="{{ url('cetak_barcode')}}" class="btn btn-md btn-info mb-3" target="_blank">CETAK PDF</a> -->
                            <button data-toggle="modal" data-target="#pdf" class="btn btn-md mb-3 btn-success">CETAK TNJ 108</button>
                                <table id="tables" class="table table-striped table-hover" style="width:100%">
                                <caption>List of Barang</caption>
                                    <thead class="thead-dark">
                                        <tr>
                                        <th align="center">
                                            <input name="select_all" value="" id="example-select-all" type="checkbox" /></th>
                                        </th>
                                            <th>NO</th>
                                            <th>NAMA</th>
                                            <th>BARCODE</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($barangs as $barang)
                                    <tr>
                                        <td>{{ $barang->barcode_kode }}</td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $barang->nama_barang }}</td>
                                        
                                        @php
                                            $generatorPNG = new Picqer\Barcode\BarcodeGeneratorPNG();
                                        @endphp
                                        <td align="center"><img src="data:image/png;base64,{{ base64_encode($generatorPNG->getBarcode($barang->barcode_kode, $generatorPNG::TYPE_CODE_128)) }}"><br>
                                        {{ $barang->barcode_kode }}
                                    
                                        </td>
                                                                             
                                        <td class="text-center">
                                        tidak ada aksi
                                    </td>
                                    </tr>

                                  @empty
                                      <div class="alert alert-danger">
                                          Data Barang belum Tersedia.
                                      </div>
                                  @endforelse
                                    </tbody>
                                    <tfoot class="thead-dark">
                                        <tr>
                                        <th align="center">
                                            <input name="select_all" value="" id="example-select-all" type="checkbox" /></th>
                                        </th>
                                            <th>NO</th>
                                            <th>NAMA</th>
                                            <th>BARCODE</th>
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
<div class="modal fade" id="pdf" tabindex="-1" role="dialog" aria-labelledby="pdfLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="pdfLabel">Posisi TNJ 108</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- <div class="modal-body">
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
            </div> -->
            <div class="modal-body">
                <form action="{{ url('/cetakBarcode/') }}" method="post" >
                @csrf
                    <div class="form-group">
                        <label for="row">Baris</label>
                        <input type="number" class="form-control" id="row" placeholder="baris Barang" name="row" required>
                    </div>
                    <div class="form-group">
                        <label for="col">Kolom</label>
                        <input type="number" class="form-control" id="col" placeholder="kolom Barang" name="col" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="generate">Simpan</button>
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
    $(document).ready(function (){   
   var table = $('#tables').DataTable({
    "paging": false,
    "responsive": true,
    "autoWidth": false,  
    'columnDefs': [{
         'targets': 0,
         'searchable':false,
         'orderable':false,
         'className': 'dt-body-center',
         'render': function (data, type, full, meta){
             return '<input type="checkbox" name="check" value="' 
                + $('<div/>').text(data).html() + '">';
         }
      }],
      'order': [1, 'asc']
   });
   
 // Handle click on "Select all" control
   $('#example-select-all').on('click', function(){
      // Check/uncheck all checkboxes in the table
      var rows = table.rows({ 'search': 'applied' }).nodes();
      $('input[type="checkbox"]', rows).prop('checked', this.checked);
   });
   // Handle click on checkbox to set state of "Select all" control
   $('#tables tbody').on('change', 'input[type="checkbox"]', function(){
      // If checkbox is not checked
      if(!this.checked){
         var el = $('#example-select-all').get(0);
         // If "Select all" control is checked and has 'indeterminate' property
         if(el && el.checked && ('indeterminate' in el)){
            // Set visual state of "Select all" control 
            // as 'indeterminate'
            el.indeterminate = true;
         }
      }
   });
   $('#generate').on('click', function(e){
      var favorite = [];
      var row =  Number(document.getElementById("row").value);
      var col =  Number(document.getElementById("col").value);
      $.each($("input[name='check']:checked"), function(){
          favorite.push($(this).val());
      });
      parameter= "/"+ favorite.join()+"/"+col+"/"+row;
      url= "{{url('/cetakBarcode')}}";
      document.location.href=url+parameter;
       e.preventDefault(); 
   });
   });
</script>

@endsection