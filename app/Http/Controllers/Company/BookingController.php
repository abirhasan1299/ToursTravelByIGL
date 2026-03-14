<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $packages = Package::where('user_id',auth()->id())->pluck('id');

        $data = Booking::whereIn('package_id',$packages)->get();

        return view('admin.booking.index',compact('data'));

    }
}
