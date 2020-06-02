<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GnDivision extends Model{

    protected $fillable = ['number', 'name']; 

    public function households(){
        return $this->hasMany('App\HouseHold');
    }

    public function people(){
        return $this->hasMany('App\Person');
    }

    public function towns(){
        return $this->hasMany('App\Town');
    }
}
