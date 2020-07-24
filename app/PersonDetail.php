<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonDetail extends Model
{
    protected $primaryKey = 'person_id';
    
    public function person(){
        return $this->belongsTo(Person::class,'person_id','person_detail');
    }
}
