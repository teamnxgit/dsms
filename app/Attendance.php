<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $primaryKey=[];

    public function dates(){
        return $this->belongsTo(Calendar::class,'date');
    }

    public function employee(){
        return $this->belongsTo(Employee::class,'emp_id');
    }

    
}
