<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $guarded = [];
    protected $casts = [
        'facilities' => 'array',
    ];
    public function images()
    {
        return $this->hasMany(HotelImage::class, 'hotel_id', 'id');
    }
}
