<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    public function gndivision(){
        return $this->belongsTo('App\GnDivision');
    }

    public function people(){
        return $this->hasMany('App\Person');
    }

    public function households(){
        return $this->hasMany('App\HouseHold');
    }
}
