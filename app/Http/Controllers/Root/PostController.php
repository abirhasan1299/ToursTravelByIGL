<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

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

    public function getState()
    {
        $response = Http::withHeaders([
            'X-CSCAPI-KEY' => 'fd6394ac8fc2d21c0a473ee0be18f033fefa1ea0c07b92e598c7cebe983d1c51'
        ])->get('https://api.countrystatecity.in/v1/states');

        return  $response->json();
    }

    public function create()
    {
        $response = Http::withHeaders([
            'X-CSCAPI-KEY' => 'fd6394ac8fc2d21c0a473ee0be18f033fefa1ea0c07b92e598c7cebe983d1c51'
        ])->get('https://api.countrystatecity.in/v1/countries');

        $data = $response->json();
        $state = $this->getState();

        return view('admin.post.create',compact('data','state'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'amount' => 'required|integer',
            'day' => 'required|integer',
            'night' => 'required|integer',
            'tour_type' => 'required',
            'max_people' => 'required|integer',
            'start_location' => 'required',
            'end_location' => 'required',
            'include' => 'required',
            'exclude' => 'required',
            'detail' => 'required',
            'destination' => 'required|array',
            'cover_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $imageName = null;

        if ($request->hasFile('cover_img')) {
            $image = $request->file('cover_img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('package', $imageName, 'public');
        }

        Package::create([
            'title' => $request->title,
            'amount' => $request->amount,
            'day' => $request->day,
            'night' => $request->night,
            'tour_type' => $request->tour_type,
            'max_people' => $request->max_people,
            'start_location' => $request->start_location,
            'end_location' => $request->end_location,
            'include' => $request->include,
            'exclude' => $request->exclude,
            'detail' => $request->detail,
            'status' => 'active',
            'user_id' => auth()->id(), // safer
            'cover_img' => $imageName,
            'subdestination' => json_encode($request->destination),
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

    public function destroy($id)
    {
        $data = Package::findOrFail($id);
        $data->delete();
        return redirect()->route('admin.post.index')->with('success','Package deleted successfully');
    }

}
