<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\DestinationImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Destination::latest()->get();
        return view('admin.destination.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $response = Http::withHeaders([
            'X-CSCAPI-KEY' => 'fd6394ac8fc2d21c0a473ee0be18f033fefa1ea0c07b92e598c7cebe983d1c51'
        ])->get('https://api.countrystatecity.in/v1/countries');
        $country = $response->json();

        $json = file_get_contents(resource_path('views\data\languages.json'));

        $languages = json_decode($json, true);

        return view('admin.destination.create',compact('country','languages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // ✅ Validation
        $request->validate([
            'overview' => 'required|string',
            'description' => 'required|string',
            'country' => 'required|string|max:255',
            'price' => 'required|integer|min:0',
            'visa' => 'required|boolean',
            'languages' => 'required',
            'map_link' => 'required|string',

            'images' => 'required|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:100000',
        ]);

        $languages = $request->input('languages', []);

        // ✅ Create Destination
        $destination = Destination::create([
            'overview' => $request->overview,
            'description' => $request->description,
            'country' => $request->country,
            'visa' => $request->visa,
            'price' => $request->price,
            'languages' => $languages,
            'map_link' => $request->map_link,
        ]);

        // ✅ Handle Multiple Images Upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {

                // Store in storage/app/public/destinations
                $path = $image->store('destinations', 'public');

                DestinationImages::create([
                    'destination_id' => $destination->id,
                    'image_name' => $path,
                ]);
            }
        }

        return redirect()
            ->route('admin.des.index')
            ->with('success', 'Destination created successfully!');

    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Destination::findOrFail($id);
        $data->delete();
        return redirect()->route('admin.des.index')->with('success','Destination deleted successfully');
    }
}
