<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\CompanyPackage;
use App\Models\Credit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function index()
    {
        $package = CompanyPackage::where('p_status','active')->get();
        $credit = Credit::where('c_user_id',Auth::user()->id)->first();

        return view('admin.package.subscription',compact('package','credit'));
    }

}
