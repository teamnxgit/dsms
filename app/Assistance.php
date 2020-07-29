<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assistance extends Model
{
    public function people(){
        return $this->belongsToMany(Person::class)->withPivot('from', 'to','note');
    }
}
