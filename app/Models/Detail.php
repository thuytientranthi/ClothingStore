<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table = 'detail';
    protected $filltable = [
    	'id','id_product', 'id_size', 'quantity', 'color'
    ];

    // public function size(){
    // 	return $this->belongsToMany('App\Models\Size','id_size','id');
    // }
}
