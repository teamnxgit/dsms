<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConsumableIssue extends Model
{
    protected $fillable=["consumable_id","date","to","req_no","qty_issued","balance"];

    public function branch(){
        return $this->belongsTo(Branch::class,'to');
    }
}
