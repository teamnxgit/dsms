<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\HouseHold;

class Person extends Model
{
    public function household(){
        return $this->belongsTo('App\HouseHold');
    }

    public function fgndivision(){
        return $this->belongsTo('App\GnDivision');
    }

    public function town(){
        return $this->belongsTo('App\Town');
    }

    public function disabilities(){
        return $this->hasMany('App\Disability');
    }

    public function occupations(){
        return $this->belongsToMany('App\Job');
    }
}
