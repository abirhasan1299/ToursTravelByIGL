<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Gallery;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $albums = Album::all();
        return view('admin.about.gallery', compact('albums'));
    }


    public function video()
    {
        $videos = Video::orderBy('id', 'desc')->get();
        return view('admin.about.video', compact('videos'));
    }

    public function videostore(Request $request)
    {
        $request->validate([
            'embed_code' => 'required|string'
        ]);

        $embedCode = $request->embed_code;


        preg_match('/youtu(?:\.be|be\.com\/(?:embed\/|v\/|watch\?v=))([\w-]+)/', $embedCode, $matches);

        Video::create([
            'code' => $embedCode,
        ]);

        return redirect()->route('admin.video')
            ->with('success', 'YouTube video added successfully!');
    }

    public function videodestroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return redirect()->route('admin.video')
            ->with('success', 'YouTube video deleted successfully!');
    }

    public function storeAlbum(Request $request)
    {
        $request->validate([
            'album_name' => 'required|string|max:255',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:1048'
        ]);

        $coverImage = $request->file('cover_image');
        $imageName = time().'_'.uniqid().'.'.$coverImage->getClientOriginalExtension();

        $path = $coverImage->storeAs('album_covers', $imageName, 'public');


        if (!$path) {
            return redirect()->back()
                ->with('error', 'Failed to upload cover image!')
                ->withInput();
        }

        Album::create([
            'name' => $request->album_name,
            'cover_img' => $imageName  // Make sure your database column is 'cover_img'
        ]);

        return redirect()->route('admin.gallery')
            ->with('success', 'Album created successfully!');
    }

    public function destroyAlbum($id)
    {
        $album = Album::findOrFail($id);
        // Delete cover image
        if ($album->cover_img) {
            Storage::disk('public')->delete('album_covers/' . $album->cover_img);
        }

        // Delete all photos in the album
        foreach ($album->gallery as $photo) {
            Storage::disk('public')->delete('gallery/' . $photo->img_name);
            $photo->delete();
        }

        $album->delete();
        return redirect()->route('admin.gallery')->with('success', 'Album deleted successfully!');
    }
    public function showAlbum($id)
    {
        $album = Album::findOrFail($id);
        $photos = Gallery::where('album_id',$id)->get();
        return view('admin.about.album-show', compact('album', 'photos'));
    }

    public function storePhotos(Request $request)
    {
        $request->validate([
            'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        $uploadedCount = 0;

        foreach ($request->file('photos') as $photo) {
            $imageName = time() . '_gallery_' . uniqid() . '.' . $photo->getClientOriginalExtension();


            $path = Storage::disk('public')->putFileAs('gallery', $photo, $imageName);


            if ($path) {
                Gallery::create([
                    'img_name' => $imageName,
                    'album_id' => $request->album_id,
                ]);
                $uploadedCount++;
            }
        }

        return redirect()->back()->with('success', $uploadedCount . ' photos uploaded successfully!');
    }

    public function destroyPhoto($id)
    {
        $photo = Gallery::findOrFail($id);
        Storage::disk('public')->delete('gallery/' . $photo->img_name);
        $photo->delete();

        return redirect()->back()->with('success', 'Photo deleted successfully!');
    }
}
