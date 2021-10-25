<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    // use HasFactory;
    public $table = "districts";
    protected $primaryKey = 'id';
    protected $fillable = [
        'name'
    ];

    public function kota(){
        return $this->belongsTo(Kota::class,'regency_id');
    }
    public function kelurahan(){
        return $this->hasMany(Kelurahan::class,'district_id');
    }
}
