<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    public function facility_type(){
        return $this->belongsTo(FacilityType::class);
    }
}
