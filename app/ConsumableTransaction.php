<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsumableTransaction extends Model
{
    protected $fillable=["consumable_id","type","date","from_or_to","ref_no","qty","balance"];

    public function consumable(){
        return $this->belongsTo(Consumable::class);
    }
}
