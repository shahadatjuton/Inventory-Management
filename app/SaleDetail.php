<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    public function products(){
        return $this->hasMany('App\Model\Product');
    }
}
