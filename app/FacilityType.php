<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacilityType extends Model
{
    protected $fillable = ['name','icon','shorthand'];

    public function facilities(){
        return $this->hasMany(Facility::class,'id');
    }

    public function facility($type){
        return $this::where('type',$type);
    }
}