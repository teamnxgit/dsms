<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HouseholdNote extends Model
{
    public function households(){
        return $this->belongsTo(Household::class);
    }
}
