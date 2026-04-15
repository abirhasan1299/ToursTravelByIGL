<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $guarded = [];

    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id','id');
    }
}
