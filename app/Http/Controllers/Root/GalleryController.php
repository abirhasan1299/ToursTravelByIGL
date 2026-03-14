<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $photos = Gallery::orderBy('id','DESC')->get();
        return view('admin.about.gallery', compact('photos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'photos.*' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        if($request->hasFile('photos'))
        {
            foreach($request->file('photos') as $image)
            {
                $filename = time().'_'.$image->getClientOriginalName();

                $image->storeAs('gallery', $filename, 'public');

                Gallery::create([
                    'img_name' => $filename
                ]);
            }
        }

        return back()->with('success','Images uploaded successfully');
    }

    public function destroy($id)
    {
        try{
            Gallery::findOrFail($id)->delete();
            return redirect()->back()->with('success','Deleted successfully');
        }catch(Exception $e){
            Log::error($e->getMessage());
            return redirect()->back()->with('error','Delete Failed');
        }
    }

   
}
