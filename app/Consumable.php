<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consumable extends Model
{
    public function receives(){
        return $this->hasMany(ConsumableReceive::class);
    }

    public function issues(){
        return $this->hasMany(ConsumableIssue::class);
    }
}
