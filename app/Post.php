<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    public $table = "post";
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'content'
    ];
}
