<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use App\Models\HotelFacility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index()
    {
        $data = HotelFacility::latest()->get();
        return view('admin.HotelFacility.index',compact('data'));
    }

    public function destroy($id)
    {
        $data = HotelFacility::findOrFail($id);
        $data->delete();
        return redirect()->route('admin.facility.index')->with('success','Data deleted successfully');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'detail' => 'nullable|string',
        ]);

        HotelFacility::create($data);
        return redirect()->route('admin.facility.index')->with('success','Facility added successfully');
    }
}
