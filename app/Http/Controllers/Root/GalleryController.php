<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $photos = Gallery::orderBy('created_at', 'desc')->get();
        return view('admin.about.gallery', compact('photos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        foreach ($request->file('photos') as $photo) {
            $filename = time() . '_' . $photo->getClientOriginalName();
            $path = $photo->storeAs('gallery', $filename, 'public');

            Gallery::create([
                'img_name' => $filename,
                'filename' => $photo->getClientOriginalName()
            ]);
        }

        return redirect()->route('admin.gallery')->with('success', 'Photos uploaded successfully!');
    }

    public function destroy($id)
    {
        try {
            $photo = Gallery::findOrFail($id);

            // Delete file from storage
            if (Storage::disk('public')->exists('gallery/' . $photo->img_name)) {
                Storage::disk('public')->delete('gallery/' . $photo->img_name);
            }

            $photo->delete();

            return redirect()->route('admin.gallery')->with('success', 'Photos Deleted  successfully!');
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function batchDestroy(Request $request)
    {
        try {
            $request->validate([
                'ids' => 'required|array',
                'ids.*' => 'exists:galleries,id'
            ]);

            $photos = Gallery::whereIn('id', $request->ids)->get();

            foreach ($photos as $photo) {
                // Delete file from storage
                if (Storage::disk('public')->exists('gallery/' . $photo->img_name)) {
                    Storage::disk('public')->delete('gallery/' . $photo->img_name);
                }
            }

            Gallery::whereIn('id', $request->ids)->delete();

            return redirect()->route('admin.gallery')->with('success', 'Photos Deleted  successfully!');
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
