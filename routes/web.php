<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\CustomerController;
// use App\Http\Controllers\BarangController;
// use App\Http\Controllers\ScannerController;
// use App\Http\Controllers\BarangController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('beranda');
});
// Route::get('/barang', function () {
//     return view('barang');
// });
// Route::get('/barcode', function () {
//     return view('scanbarcode');
// });

route::view('/home','home');

// route::get('/barang','BarangController@index');
// Route::get('/pdf',[BarangController::class,'cetak_pdf']);
// Route::get('cetak_barcode', 'BarangController@cetak_pdf')->name('print');

// route::get('/dataCustomer','customerController@indexDataCust');
// route::get('/tambahCust1','customerController@tambahCustomer1');
// route::get('/tambahCust2','customerController@tambahCustomer2');
Route::post('/customer/export-excel', 'customerController@importExcel' );
Route::get('tambahCustomer/getcities/{id}','customerController@getCities');
Route::get('tambahCustomer/getdistricts/{id}','customerController@getDistricts');
Route::get('tambahCustomer/getsubdistricts/{id}','customerController@getSubdistricts');
Route::get('cetak_barcode','BarangController@cetak_pdf');
// Route::post('/barang/cetakpdf/','BarangController@cetakTNJ' );
Route::get('/cetakBarcode/{id_barang}/{col}/{row}', 'BarangController@cetakPdf');

// Route::post('/tambahCustomer1/store1','customerController@store1');
// Route::post('/tambahCustomer2/store2','customerController@store2');

// Route::resource('barang2', 'Barang2Controller');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
Route::resource('customer', customerController::class);
Route::resource('barang', BarangController::class);
// Route::get('/barang/cetak_barcode',  [App\Http\Controllers\BarangController::class, 'cetak_pdf']);

Route::resource('scanner', ScannerController::class);
Route::post('/scan_toko/getLocationToko', 'TokoController@getLocationToko');
Route::post('/scan_toko/getDistanceFromLatLonInKm', 'TokoController@getDistanceFromLatLonInKm');
Route::get('/cetak_toko/{id}', 'TokoController@cetak_toko');
Route::get('/scan_toko', 'TokoController@scan_toko');
Route::resource('toko', TokoController::class);
// Route::get('/cari_provinsi', [customerController::class,'loadData_provinsi']);
// Route::get('/cari_kota', [customerController::class,'loadData_kota']);
// Route::get('/cari_kecamatan', [customerController::class,'loadData_kecamatan']);
// Route::get('/cari_kelurahan', [customerController::class,'loadData_kelurahan']);
// Route::get('cetak_barcode',[BarangController::class,'cetak_pdf']);
// Route::get('tambahCustomer/getcities/{id}',[CustomerController::class,'getCities']);
// Route::get('tambahCustomer/getdistricts/{id}',[CustomerController::class,'getDistricts']);
// Route::get('tambahCustomer/getsubdistricts/{id}',[CustomerController::class,'getSubdistricts']);
// Route::resources('customer', [App\Http\Controllers\customerController::class])->name('customer');