<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = "size";

    public function product(){
    	return $this->belongsToMany('App\Models\Product','App\Models\Detail','id_size','id');
    }
}
