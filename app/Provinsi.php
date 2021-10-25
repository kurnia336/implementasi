<?php

namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
    // use HasFactory;
    public $table = "provinces";
    protected $primaryKey = 'id';
    protected $fillable = [
        'name'
    ];

    public function kota()
    {
    	return $this->hasMany(Kota::class,'province_id');
    }
}
