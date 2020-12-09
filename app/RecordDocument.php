<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecordDocument extends Model
{
    public function bundle(){
        return $this->belongsTo(RecordBundle::class,'bundle_id');
    }
}
