<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table= 'product';
    protected $primarykey ='id';

    protected $filltable = [
    	'name',
    	'price',
    	'describe',
    ];

    public function sale(){
    	return $this->belongsTo('App\Models\Sale','id_sale','id');
    }

    public function category(){
    	return $this->belongsTo('App\Models\Category','id_category','id');
    }
    public function size(){
    	return $this->hasManyThrough('App\Models\Size', 'App\Models\Detail','id_product','id_size',
            'id','id');
    }
    
}
