<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    // use HasFactory;
    public $table = "villages";
    protected $primaryKey = 'id';
    protected $fillable = [
        'name'
    ];

    public function kecamatan(){
        return $this->belongsTo(Kecamatan::class,'district_id');
    }

    public function customer(){
        return $this->hasMany(Customer::class,'id_kelurahan');
    }
}
