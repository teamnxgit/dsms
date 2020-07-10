<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonDetail extends Model
{
    public function person(){
        return $this->belongsTo(Person::class,'person_id');
    }
}
