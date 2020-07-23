<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consumable extends Model
{
    public function transactions(){
        return $this->hasMany(ConsumableTransaction::class);
    }
}