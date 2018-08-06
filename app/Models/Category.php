<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table= 'category';
    protected $primarykey ='id';

    public function product(){
    	return $this->hasMany('App\Models\Product','id_category','id');
    }
}
