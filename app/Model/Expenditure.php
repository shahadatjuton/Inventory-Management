<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
    public function user(){
        return $this->belongsTo('App\User','created_by');
    }
}
