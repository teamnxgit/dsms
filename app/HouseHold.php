<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Person;

class Household extends Model
{
    protected $fillable = ['house_no','gn_division_id','town_id','street_id','owner','gps'];

    public function people(){
        return $this->hasMany('App\Person');
    }

    public function gndivision(){
        return $this->belongsTo(GnDivision::class,'gn_division_id');
    }

    public function town(){
        return $this->belongsTo('App\Town');
    }

    public function street(){
        return $this->belongsTo('App\Street');
    }

    public function electricitySources(){
        return $this->belongsToMany(ElectricitySource::class);
    }
}