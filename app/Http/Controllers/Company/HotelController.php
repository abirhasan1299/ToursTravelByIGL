<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\HotelFacility;
use App\Models\HotelImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Log;

class HotelController extends Controller
{
    public function index()
    {
        $data = Hotel::where('user_id',auth()->user()->id)->latest()->get();
        return view('admin.hotel.index',compact('data') );
    }
    public function create()
    {
        $facilities = HotelFacility::all();
        return view('admin.hotel.create',compact('facilities'));
    }

    public function store(Request $request)
    {
            $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'address' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'map_url' => 'required|url',
            'map_embed_code' => 'required|string',
            'checkIn' => 'required|',
            'checkOut' => 'required|',
            'description' => 'required|string',
            'images.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);
            $listing = Hotel::create([
                'user_id' => auth()->user()->id,
                'name' => $request->name,
                'price' => $request->price,
                'address' => $request->address,
                'location' => $request->location,
                'map_url' => $request->map_url,
                'map_embed_code' => $request->map_embed_code,
                'checkIn' => $request->checkIn,
                'checkOut' => $request->checkOut,
                'description' => $request->description,
                'facilities' => $request->facilities ?? []
            ]);
            if ($request->hasFile('images')) {

                foreach ($request->file('images') as $image) {

                    $path = $image->store('hotels', 'public');

                    HotelImage::create([
                        'hotel_id' => $listing->id,
                        'image_name' => $path
                    ]);
                }
            }
            return redirect()
                ->route('company.hotel.index')
                ->with('success', 'Hotel created successfully!');

    }
    public function edit($id)
    {
        $hotel = Hotel::find($id);
        return view('admin.hotel.edit', compact('hotel'));
    }
    public function update(Request $request, $id)
    {
        $hotel = Hotel::find($id);
        dd($request->all());
    }

    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();
        return redirect()->route('company.hotel.index')->with('success', 'Hotel deleted successfully');
    }

}
