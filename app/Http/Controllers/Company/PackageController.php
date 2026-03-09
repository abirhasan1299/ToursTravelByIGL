<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Package::where('user_id', Auth::user()->id)->get();

        return view('admin.package.company_package',compact('data'));
    }

    public function Activity($id)
    {
        $data = Package::where('id', base64_decode($id))->first();

        $activity = Activity::where('package_id', base64_decode($id))->orderBy('day_no','asc')->get();

        return view('admin.package.activity',compact('data','activity'));
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

            return redirect()->route('company.package.index')
                ->with('success','Activity saved successfully');

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return redirect()->route('company.package.index')
                ->with('error','Something went wrong');
        }
    }


    public function create()
    {
        $response = Http::withHeaders([
            'X-CSCAPI-KEY' => 'fd6394ac8fc2d21c0a473ee0be18f033fefa1ea0c07b92e598c7cebe983d1c51'
        ])->get('https://api.countrystatecity.in/v1/countries');

        $data = $response->json();
        $state = $this->getState();

        return view('admin.package.create_company_package',compact('data','state'));
    }

    public function getState()
    {
        $response = Http::withHeaders([

            'X-CSCAPI-KEY' => 'fd6394ac8fc2d21c0a473ee0be18f033fefa1ea0c07b92e598c7cebe983d1c51'

        ])->get('https://api.countrystatecity.in/v1/states');

        return  $response->json();

    }

    /**
     * Store a newly created resource in storage.
     */
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
            'status' => 'required',
            'destination' => 'required',
            'cover_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

       try{
           if($request->hasFile('cover_img'))
           {
               $image = $request->file('cover_img');
               $imageName = time().'.'.$image->getClientOriginalExtension();
               $image->storeAs('package', $imageName, 'public');
           }
           $model = new Package();
           $model->title = $request->title;
           $model->amount = $request->amount;
           $model->day = $request->day;
           $model->night = $request->night;
           $model->tour_type = $request->tour_type;
           $model->max_people = $request->max_people;
           $model->start_location = $request->start_location;
           $model->end_location = $request->end_location;
           $model->include = $request->include;
           $model->exclude = $request->exclude;
           $model->detail = $request->detail;
           $model->status = $request->status;
           $model->user_id = auth()->user()->id;
           $model->cover_img = $imageName;
           $model->subdestination = json_encode($request->destination);
           $model->save();

           return redirect()->route('company.package.index')->with('success','Package added successfully');

       }catch (\Exception $e){

           Log::error($e->getMessage());

           return redirect()->route('company.package.index')->with('error','Something went wrong');
       }

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $data = Package::findOrFail($id);

            // delete activities first
            Activity::where('package_id', $id)->delete();

            // delete package
            $data->delete();

            return redirect()
                ->route('company.package.index')
                ->with('success', 'Package deleted successfully');

        } catch (\Exception $e) {

            Log::error($e->getMessage());

            return redirect()
                ->route('company.package.index')
                ->with('error', 'Something went wrong');
        }
    }
}
