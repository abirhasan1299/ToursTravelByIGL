<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use App\Mail\Bkash_Confirm_Booking;
use App\Models\Activity;
use App\Models\Bus;
use App\Models\HotelFacility;
use App\Models\Package;
use App\Models\Payment;
use App\Models\Seat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $data = Package::latest()->get();
        return view('admin.post.index', compact('data'));
    }

    public function show($id)
    {
        $package = Package::findOrFail(base64_decode($id));
        return view('admin.post.verify-post', compact('package'));
    }

    public function edit($id)
    {
        try {
            $decodedId = base64_decode($id);
            $package = Package::findOrFail($decodedId);

            // Fetch bus list
            $bus = Bus::where('status', 'active')->get();
            $facility = HotelFacility::all();

            // Fetch districts for location dropdown
            $state = Http::get('https://bdapis.com/api/v1.2/districts');
            if (!$state->successful()) {
                $state = ['data' => []];
            } else {
                $state = $state->json();
            }

            return view('admin.post.edit', compact('package', 'bus', 'state', 'facility'));

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()
                ->route('admin.post.index')
                ->with('error', 'Package not found or invalid ID.');
        }
    }

    public function update(Request $request, $id)
    {
        $decodedId = base64_decode($id);
        $package = Package::findOrFail($decodedId);

        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|integer|min:0',
            'day' => 'required|integer|min:0',
            'night' => 'required|integer|min:0',
            'tour_category' => 'required|string',
            'tour_type' => 'required|string',
            'transport' => 'required|string',
            'max_people' => 'required|integer|min:1',
            'tour_date' => 'required',
            'start_location' => 'required|string',
            'end_location' => 'required|string',
            'bus_id' => 'required|exists:buses,id',
            'detail' => 'required',
            'facilities' => 'nullable|array',
            'facilities.*' => 'string',
            'cover_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1048', // Changed to nullable for update
        ]);

        try {
            // Handle cover image upload
            $imageName = $package->cover_img; // Keep old image by default

            if ($request->hasFile('cover_img')) {
                // Delete old image if exists
                if ($package->cover_img && Storage::disk('public')->exists('package/' . $package->cover_img)) {
                    Storage::disk('public')->delete('package/' . $package->cover_img);
                }

                $image = $request->file('cover_img');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('package', $imageName, 'public');
            }

            // Process facilities (selected ones are included, unselected are excluded)
            $selectedFacilities = $request->input('facilities', []);

            // Get all possible facilities from the HotelFacility model
            $allFacilities = HotelFacility::pluck('title')->toArray();

            // Calculate excluded facilities (facilities not selected)
            $excludedFacilities = array_diff($allFacilities, $selectedFacilities);

            // Format include and exclude as comma-separated strings
            $includeList = !empty($selectedFacilities) ? implode(', ', $selectedFacilities) : null;
            $excludeList = !empty($excludedFacilities) ? implode(', ', $excludedFacilities) : null;

            // Update the package
            $package->update([
                'title' => $request->title,
                'amount' => $request->amount,
                'day' => $request->day,
                'night' => $request->night,
                'tour_category' => $request->tour_category,
                'tour_type' => $request->tour_type,
                'transport' => $request->transport,
                'max_people' => $request->max_people,
                'tour_date' => $request->tour_date,
                'start_location' => $request->start_location,
                'end_location' => $request->end_location,
                'include' => $includeList,
                'exclude' => $excludeList,
                'detail' => $request->detail,
                'bus_id' => $request->bus_id,
                'cover_img' => $imageName,
            ]);

            return redirect()
                ->route('admin.post.index')
                ->with('success', 'Package updated successfully!');

        } catch (\Exception $e) {
            \Log::error('Package update error: ' . $e->getMessage());
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Failed to update package: ' . $e->getMessage());
        }
    }

    public function getState()
    {
        $response = Http::get('https://bdapis.com/api/v1.2/districts');

        return  $response->json();
    }

    public function create()
    {
        $bus = Bus::where('status','active')->orderBy('id','desc')->get();
        $facility = HotelFacility::all();

        return view('admin.post.create',compact('bus','facility'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|integer|min:0',
            'day' => 'required|integer|min:0',
            'night' => 'required|integer|min:0',
            'tour_category' => 'required',
            'tour_type' => 'required',
            'transport' => 'required',
            'max_people' => 'required|integer|min:1',
            'tour_date' => 'required',
            'start_location' => 'required|string',
            'end_location' => 'required|string',
            'bus_id' => 'required|exists:buses,id',
            'detail' => 'required|string|min:5',
            'facilities' => 'nullable|array',  // Changed from 'include' to 'facilities' to match your form
            'facilities.*' => 'string',
            'cover_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1048',
        ]);

        // Handle cover image upload
        $imageName = null;
        if ($request->hasFile('cover_img')) {
            $image = $request->file('cover_img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('package', $imageName, 'public');
        }

        // Process facilities (selected ones are included, unselected are excluded)
        $selectedFacilities = $request->input('facilities', []); // Changed from 'include' to 'facilities'

        // Define all possible facilities (hardcoded array since you're using checkbox values directly)
        $allFacilities =  HotelFacility::pluck('title')->toArray();

        // Calculate excluded facilities (facilities not selected)
        $excludedFacilities = array_diff($allFacilities, $selectedFacilities);

        // Format include and exclude as comma-separated strings
        $includeList = !empty($selectedFacilities) ? implode(', ', $selectedFacilities) : null;
        $excludeList = !empty($excludedFacilities) ? implode(', ', $excludedFacilities) : null;

        // Create the package
        $package = Package::create([
            'title' => $request->title,
            'amount' => $request->amount,
            'day' => $request->day,
            'night' => $request->night,
            'tour_category' => $request->tour_category,
            'tour_type' => $request->tour_type,
            'transport' => $request->transport,
            'max_people' => $request->max_people,
            'tour_date' => $request->tour_date,
            'start_location' => $request->start_location,
            'end_location' => $request->end_location,
            'include' => $includeList,
            'exclude' => $excludeList,
            'detail' => $request->detail,
            'status' => 'active',
            'user_id' => auth()->id(),
            'cover_img' => $imageName,
            'bus_id' => $request->bus_id,
        ]);

        return redirect()
            ->route('admin.post.index')
            ->with('success', 'Package added successfully');
    }

    public function ActivateStatus($id)
    {
        $data = Package::findOrFail(base64_decode($id));
        $data->status = 'active';
        $data->save();
        return redirect()->route('admin.post.index')->with('success','Package activated successfully');

    }

    public function SuspendedStatus($id)
    {
        $data = Package::findOrFail(base64_decode($id));
        $data->status = 'suspended';
        $data->save();
        return redirect()->route('admin.post.index')->with('success','Package suspended successfully');

    }

    public function Activity($id)
    {
        $data = Package::where('id', base64_decode($id))->first();

        $activity = Activity::where('package_id', base64_decode($id))->orderBy('day_no','asc')->get();

        return view('admin.post.activity',compact('data','activity'));
    }

    public function ActivityStore(Request $request)
    {
        try {

            $package = Package::findOrFail($request->package_id);

            for ($i = 0; $i < $package->day; $i++) {

                Activity::updateOrCreate(
                    [
                        'package_id' => $request->package_id,
                        'day_no' => $request->day_no[$i],
                    ],
                    [
                        'title'  => $request->title[$i] ?? '',
                        'detail' => $request->detail[$i] ?? '',
                        'day_no' => $request->day_no[$i]??'',
                    ]
                );

            }

            return redirect()->route('admin.post.index')
                ->with('success','Activity saved successfully');

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return redirect()->route('admin.post.index')
                ->with('error','Something went wrong');
        }
    }

    public function destroy($id)
    {
        $data = Package::findOrFail($id);
        $data->delete();
        return redirect()->route('admin.post.index')->with('success','Package deleted successfully');
    }

    public function persons($id)
    {
        $data = Seat::where('package_id', base64_decode($id))->orderBy('total_amount','asc')->get();

        $collection = Seat::where('package_id', base64_decode($id))->where('status','booked')->sum('total_amount');

        $pending = Seat::where('package_id', base64_decode($id))->where('status','pending')->sum('total_amount');

        return view('admin.post.person',compact('data','collection','pending'));
    }

    public static function generateTrxId()
    {
        do {
            $trxId = strtoupper(Str::random(10));
        } while (\App\Models\Payment::where('trx_id', $trxId)->exists());

        return $trxId;
    }

    public function CashOnDelivery(Request $request,$id)
    {
        try{
            DB::beginTransaction();

            $seat = Seat::findOrFail($id);
            $seat->status = "booked";
            $seat->save();

            $payment = Payment::create([
                'user_id' => auth()->id()??'0',
                'seats_id' => $seat->id,
                'payment_id'=>'TR0011'.strtoupper(uniqid()),
                'amount' => $seat->total_amount,
                'currency' => "BDT",
                'status' => "Completed",
                'trx_id' => self::generateTrxId(),
            ]);

            DB::commit();

            Mail::to($seat->email)->send(new Bkash_Confirm_Booking($seat,$payment));

            return redirect()->route('admin.post.index')->with('success','Payment & Booking Done');

        }catch (\Exception $e){
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->back()->with('error','Something went wrong');
        }

    }

}
