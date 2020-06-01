<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Street extends Model
{
    public function gn_division(){
        return $this->belongsTo('App\GnDivision');
    }

    public function town(){
        return $this->belongsTo('App\Town');
    }

    public function people(){
        return $this->hasMany('App\Person');
    }

    public function houseHolds(){
        return $this->hasMany('App\HouseHold');
    }
}
