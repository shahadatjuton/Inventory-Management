<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function supplier(){
        return $this->belongsTo('App\Model\Supplier');
    }
    public function category(){
        return $this->belongsTo('App\Model\Category');
    }
    public function unit(){
        return $this->belongsTo('App\Model\Unit');
    }
    public function cart(){
        return $this->belongsTo('App\Cart');
    }
}
