<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function orders(){
        $this->hasMany('App\Model\Order');
    }
}
