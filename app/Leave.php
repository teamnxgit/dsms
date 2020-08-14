<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    public function employee(){
        return $this->belongsTo(Employee::class,'emp_id');
    }

    
}
