<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPlanOwn extends Model
{
    protected $guarded = [];

    public function userPackage()
    {
        return $this->belongsTo(CompanyPackage::class,'company_package_id','id');
    }
}
