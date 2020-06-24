<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $fillable = ['name','type'];
    
    public function facility_type(){
        return $this->belongsTo(FacilityType::class,'type');
    }

    public function households(){
        return $this->belongsToMany(Household::class,'facility_household','facility_id','household_id')->withPivot('description');
    }

    
}
