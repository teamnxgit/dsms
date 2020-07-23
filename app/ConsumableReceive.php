<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsumableReceive extends Model
{
    protected $fillable=["consumable_id","date","from","bill_no","qty_received","balance"];
}
