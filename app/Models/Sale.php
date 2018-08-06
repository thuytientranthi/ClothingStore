<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table= 'sale';
    protected $primarykey ='id';

    public function product(){
    	return $this->hasMany('App\Models\Product','id_sale','id'); // khóa ngoại , khóa chính
    }
}
