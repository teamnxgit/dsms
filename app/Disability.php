<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disability extends Model
{
    public function person(){
        return $this->belongsTo('App\Person');
    }
}
