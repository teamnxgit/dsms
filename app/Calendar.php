<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    public function attendances(){
        return $this->hasMany(Attendance::class,'date');
    }

    public function leaves(){
        return $this->hasMany(Leave::class,'date');
    }

    public function absentees(){
        
    }
}
