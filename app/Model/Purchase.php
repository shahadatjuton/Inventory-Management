<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
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
    public function product(){
        return $this->belongsTo('App\Product');
    }
    public function user(){
        return $this->belongsTo('App\User','created_by');
    }
}
