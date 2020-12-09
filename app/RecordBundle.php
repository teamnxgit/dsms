<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecordBundle extends Model
{
    public function documents(){
        return $this->hasMany(RecordDocument::class,'bundle_id');
    }
}
