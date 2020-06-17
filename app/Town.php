<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    protected $fillable = ['name','gn_division_id'];

    public function gndivision(){
        return $this->belongsTo('App\GnDivision');
    }

    public function people(){
        return $this->hasMany('App\Person');
    }

    public function households(){
        return $this->hasMany(Household::class);
    }
}
