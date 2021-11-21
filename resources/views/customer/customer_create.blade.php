@extends('Template.master')

@section('title', 'Tambah Customer')

@section('content')

<div class="container" style="">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
                        
                            @csrf

                            <div class="form-group">
                                <label class="font-weight-bold">NAMA CUSTOMER</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" style="" id="nama" name="nama" autocomplete="off" required>
                            
                                <!-- error message untuk title -->
                                @error('nama')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">ALAMAT</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" value="{{ old('alamat') }}" placeholder="Masukkan Alamat">
                            
                                <!-- error message untuk title -->
                                @error('alamat')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">PROVINSI</label>
                                <!-- <select class="cari_provinsi form-control @error('id_provinsi') is-invalid @enderror" style="" id="id_provinsi" name="id_provinsi" autocomplete="off" ></select> -->

                                <select class="form-control @error('id_provinsi') is-invalid @enderror" style="" id="id_provinsi" name="id_provinsi" autocomplete="off" placeholder=". . .">
			                          @foreach ($prov as $key => $value)<option value="{{ $key }}">{{ $value }}</option>@endforeach</select>

                                <!-- error message untuk title -->
                                @error('id_provinsi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">KOTA</label>
                                <!-- <select class="cari_kota form-control @error('id_kota') is-invalid @enderror" style="" id="id_kota" name="id_kota" autocomplete="off" ></select> -->

                                <select class="form-control @error('id_kota') is-invalid @enderror" style="" id="id_kota" name="id_kota" autocomplete="off">
                                    <option value="">== Pilih Provinsi Dulu ==</option>
                                </select>
                                <!-- error message untuk title -->
                                @error('id_kota')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">KECAMATAN</label>
                                <!-- <select class="cari_kecamatan form-control @error('id_kecamatan') is-invalid @enderror" style="" id="id_kecamatan" name="id_kecamatan" autocomplete="off" ></select> -->

                                <select class="form-control @error('id_kecamatan') is-invalid @enderror" style="" id="id_kecamatan" name="id_kecamatan" autocomplete="off">
                                    <option value="">== Pilih Kota Dulu ==</option>
                                </select>

                                <!-- error message untuk title -->
                                @error('id_kecamatan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">KELURAHAN</label>
                                <!-- <select class="cari_kelurahan form-control @error('id_kelurahan') is-invalid @enderror" style="" id="id_kelurahan" name="id_kelurahan" autocomplete="off" required></select> -->

                                <select class="form-control @error('id_kelurahan') is-invalid @enderror" style="" id="id_kelurahan" name="id_kelurahan" autocomplete="off" required>
                                    <option value="">== Pilih Kecamatan Dulu ==</option>
                                </select>

                                <!-- error message untuk title -->
                                @error('id_kelurahan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">FOTO</label>
                                <!-- <input type="file" class="form-control @error('foto') is-invalid @enderror" style="" id="foto" name="foto" autocomplete="off" required> -->
                                
                                <!-- error message untuk title -->
                                @error('foto')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div id="my_camera"></div>
                            <input type=button value="Configure" onClick="configure()">
                            <input type=button value="Take Snapshot" onClick="take_snapshot()">

                            <!-- <input type=button value="Save Snapshot" onClick="saveSnap()"> -->
                            <input type="hidden" name="image" class="image-tag">

                            <div id="results">Gambarnya muncul disini...</div>
                            
                            <br>

                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>
                            <a href="{{ route('customer.index') }}" class="btn btn-md btn-secondary">BACK</a>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
</div>

<script type="text/javascript">
function configure(){
    Webcam.set({
       width: 100,
       height: 100,
       image_format: 'png',
       jpeg_quality: 50
    });
    Webcam.attach( '#my_camera' );
 }
 // A button for taking snaps


 // preload shutter audio clip
 var shutter = new Audio();
 shutter.autoplay = false;
 shutter.src = navigator.userAgent.match(/Firefox/) ? 'shutter.ogg' : 'shutter.mp3';

 function take_snapshot() {
    // play sound effect
    shutter.play();

    // take snapshot and get image data
    Webcam.snap( function(data_uri) {
       // display results in page
       $(".image-tag").val(data_uri);
       document.getElementById('results').innerHTML = 
           '<img id="imageprev" name="img" src="'+data_uri+'"/>';
     } );

     Webcam.reset();
 }

function saveSnap(){
   // Get base64 value from <img id='imageprev'> source
   var base64image = document.getElementById("imageprev").src;

   Webcam.upload( base64image, 'upload.php', function(code, text) {
        console.log('Save successfully');
       //console.log(text);
   });

}

        jQuery(document).ready(function ()
        {
                jQuery('select[name="id_provinsi"]').on('change',function(){
                   var prov_id = jQuery(this).val();
                   if(prov_id)
                   {
                      jQuery.ajax({
                         url : '{{url("tambahCustomer/getcities")}}' + '/' + prov_id,
                         type : "GET",
                         dataType : "json",
                         success:function(data)
                         {
                            console.log(data);
                            jQuery('select[name="id_kota"]').empty();
                            jQuery.each(data, function(key,value){
                               $('select[name="id_kota"]').append('<option value="'+ key +'">'+ value +'</    option>');
                            });
                         }
                      });
                   }
                   else
                   {
                      $('select[name="id_kota"]').empty();
                   }
                });
        });
        jQuery(document).ready(function ()
        {
                jQuery('select[name="id_kota"]').on('change',function(){
                   var city_id = jQuery(this).val();
                   if(city_id)
                   {
                      jQuery.ajax({
                         url : '{{url("tambahCustomer/getdistricts")}}' + '/' + city_id,
                         type : "GET",
                         dataType : "json",
                         success:function(data)
                         {
                            console.log(data);
                            jQuery('select[name="id_kecamatan"]').empty();
                            jQuery.each(data, function(key,value){
                               $('select[name="id_kecamatan"]').append('<option value="'+ key +'">'+ value +'</    option>');
                            });
                         }
                      });
                   }
                   else
                   {
                      $('select[name="id_kecamatan"]').empty();
                   }
                });
        });
        jQuery(document).ready(function ()
        {
                jQuery('select[name="id_kecamatan"]').on('change',function(){
                   var dis_id = jQuery(this).val();
                   if(dis_id)
                   {
                      jQuery.ajax({
                         url : '{{url("tambahCustomer/getsubdistricts")}}' + '/' + dis_id,
                         type : "GET",
                         dataType : "json",
                         success:function(data)
                         {
                            console.log(data);
                            jQuery('select[name="id_kelurahan"]').empty();
                            jQuery.each(data, function(key,value){
                               $('select[name="id_kelurahan"]').append('<option value="'+ key +'">'+ value +'</    option>');
                            });
                         }
                      });
                   }
                   else
                   {
                      $('select[name="id_kelurahan"]').empty();
                   }
                });
        });


  // $('.cari_provinsi').select2({
  //   placeholder: 'Pilih Provinsi',
  //   ajax: {
  //     url: "{{url('/cari_provinsi')}}",
  //     dataType: 'json',
  //     delay: 250,
  //     processResults: function (data) {
  //       return {
  //         results:  $.map(data, function (item) {
  //           return {
  //             text: item.name,
  //             id: item.id
  //           }
  //         })
  //       };
  //     },
  //     cache: false
  //   }
  // });

  // $('.cari_kota').select2({
  //   placeholder: 'Pilih Kota',
  //   ajax: {
  //     url: "{{url('/cari_kota')}}",
  //     dataType: 'json',
  //     delay: 250,
  //     processResults: function (data) {
  //       return {
  //         results:  $.map(data, function (item) {
  //           return {
  //             text: item.name,
  //             id: item.id
  //           }
  //         })
  //       };
  //     },
  //     cache: false
  //   }
  // });

  // $('.cari_kecamatan').select2({
  //   placeholder: 'Pilih Kecamatan',
  //   ajax: {
  //     url: "{{url('/cari_kecamatan')}}",
  //     dataType: 'json',
  //     delay: 250,
  //     processResults: function (data) {
  //       return {
  //         results:  $.map(data, function (item) {
  //           return {
  //             text: item.name,
  //             id: item.id
  //           }
  //         })
  //       };
  //     },
  //     cache: false
  //   }
  // });

  // $('.cari_kelurahan').select2({
  //   placeholder: 'Pilih Kelurahan',
  //   ajax: {
  //     url: "{{url('/cari_kelurahan')}}",
  //     dataType: 'json',
  //     delay: 250,
  //     processResults: function (data) {
  //       return {
  //         results:  $.map(data, function (item) {
  //           return {
  //             text: item.name,
  //             id: item.id
  //           }
  //         })
  //       };
  //     },
  //     cache: false
  //   }
  // });

</script>

@endsection