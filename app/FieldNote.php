<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FieldNote extends Model
{
    protected $fillable=['heading','note','field_date','user_id'];

    public function notable(){
        return $this->morphTo();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}