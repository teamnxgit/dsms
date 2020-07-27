<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\HouseHold;

class Person extends Model
{
    public function household(){
        return $this->belongsTo(Household::class);
    }

    public function gndivision(){
        return $this->belongsTo('App\GnDivision','gn_division_id');
    }

    public function town(){
        return $this->belongsTo('App\Town','town_id');
    }

    public function disabilities(){
        return $this->hasMany('App\Disability');
    }

    public function jobs(){
        return $this->belongsToMany(Job::class,'job_people')->withPivot('income','note');
    }

    public function notes(){
        return $this->morphMany(FieldNote::class, 'notable');
    }

    public function vulnerable(){
        return $this->morphMany(Vulnerability::class,'vulnerable');
    }

    public function persondetail(){
        return $this->hasOne(PersonDetail::class);
    }

    public function benefits(){
        return $this->belongsToMany(Benefit::class)->withPivot('note', 'date');
    }
}
