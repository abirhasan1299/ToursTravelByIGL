<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Controller;
use App\Models\CompanyPackage;
use App\Models\Credit;
use App\Models\UserPlanOwn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function index()
    {
        $authController = new AuthController();
        $authController->Shutdown();

        $package = CompanyPackage::where('p_status','active')->get();
        $credit = Credit::where('c_user_id',Auth::user()->id)->first();
        $own_package = UserPlanOwn::where('user_id',auth()->user()->id)->first();

        if (!empty($own_package))
        {
            $expiryDate = $own_package->created_at
                ->copy()
                ->addDays((int) $own_package->userPackage->p_date_range);

            $daysLeft = now()->diffInDays($expiryDate,false);
        }else{
            $expiryDate=null;
            $daysLeft=null;
        }



        return view('admin.package.subscription',compact('package','credit','own_package','daysLeft','expiryDate'));
    }

}
