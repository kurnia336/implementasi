<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    //
    public $table = "toko";
    protected $primaryKey = 'barcode_toko';
    protected $fillable = [
        'barcode_toko',
        'nama_toko',
        'latitude',
        'longitude',
        'akurasi'
    ];
}
