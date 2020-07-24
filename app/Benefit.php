<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    public function people(){
        return $this->belongsToMany(Person::class)->withPivot('note', 'date');
    }
}
