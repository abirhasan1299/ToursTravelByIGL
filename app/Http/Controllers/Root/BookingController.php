<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function index()
    {
        $packages = Booking::orderBy('id','desc')->get();

        return view('admin.booking.admin',compact('packages'));

    }

    public function EditStatus($id)
    {
        $bookings = Booking::findOrFail($id);
        return response()->json($bookings);
    }

    public function UpdateStatus(Request $request,$id)
    {
        try{
            $data = Booking::findOrFail($id);
            $data->status = $request->status;
            $data->save();
            return redirect()->back()->with('success','Status Updated Successfully');
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            return redirect()->back()->with('error','Something went wrong');
        }
    }
}
