<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public function people(){
        return $this->belongsToMany('App\Person')->withPivot('income','note');
    }
}
