<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public $timestamps = false;
    protected $table = 'banners';

    public $guarded = [];

    public function getImageUrlAttribute()
    {
        return asset('storage/banner/' . $this->name);
    }

    // Accessor for filename without extension
    public function getFilenameAttribute()
    {
        $pathInfo = pathinfo($this->name);
        return $pathInfo['filename'] ?? $this->name;
    }

}
