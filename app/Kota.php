<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    // use HasFactory;
    public $table = "regencies";
    protected $primaryKey = 'id';
    protected $fillable = [
        'name'
    ];

    public function provinsi(){
        return $this->belongsTo(Provinsi::class,'prov_id');
    }
    public function kecamatan(){
        return $this->hasMany(Kecamatan::class,'regency_id');
    }
}
