<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GnDivision extends Model{

    protected $fillable = ['number', 'name']; 

    protected $table = 'gn_divisions';

    public function households(){
        return $this->hasMany(Household::class);
    }

    public function people(){
        return $this->hasMany('App\Person');
    }

    public function towns(){
        return $this->hasMany('App\Town');
    }

    public function notes(){
        return $this->morphMany(FieldNote::class, 'notable');
    }
}
