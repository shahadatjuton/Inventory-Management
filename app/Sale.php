<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function customer(){
        return $this->belongsTo('App\Model\Customer');
    }
    public function user(){
        return $this->belongsTo('App\User','created_by');
    }
}
