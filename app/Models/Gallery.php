<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $guarded=[];

    protected $fillable = [
        'img_name',
        'filename'
    ];
}
