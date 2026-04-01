<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $guarded=[];
    protected $casts = [
        'languages' => 'array',
    ];
    public function images()
    {
        return $this->hasMany(DestinationImages::class,'destination_id','id');
    }
}
