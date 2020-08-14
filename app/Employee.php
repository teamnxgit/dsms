<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function attendance(){
        return $this->hasMany(Attendance::class);
    }

    public function leaves(){
        return $this->hasMany(Leave::class);
    }

    public function system_user(){
        return $this->belongsTo(User::class,'system_user_id');
    }
}