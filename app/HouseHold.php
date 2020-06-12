<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Person;

class HouseHold extends Model
{
    protected $fillable = ['house_no','gn_division_id','town_id','street_id','owner','gps'];

    public function people(){
        return $this->hasMany('App\Person');
    }

    public function gndivision(){
        return $this->belongsTo('App\GnDivision');
    }

    public function town(){
        return $this->belongsTo('App\Town');
    }
}