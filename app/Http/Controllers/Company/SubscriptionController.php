<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\CompanyPackage;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function index()
    {
        $package = CompanyPackage::all();
        return view('admin.package.subscription',compact('package'));
    }

}
