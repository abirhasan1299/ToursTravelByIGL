<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    public $timestamps = false;
    protected $table = 'albums';
    protected $guarded=[];

    public function gallery()
    {
        return $this->hasMany(Gallery::class, 'album_id', 'id');
    }
}
