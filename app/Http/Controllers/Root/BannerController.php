<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    public function index()
    {
        $photos = Banner::orderBy('id', 'desc')->get();
        return view('admin.about.banner', compact('photos'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:1024'
            ], [
                'photos.*.image' => 'Each file must be an image',
                'photos.*.mimes' => 'Only JPG, PNG, WEBP, GIF formats are allowed',
                'photos.*.max' => 'Each image must not exceed 1MB'
            ]);

            if (!$request->hasFile('photos')) {
                return back()->with('error', 'Please select at least one image to upload.');
            }

            $uploadedCount = 0;
            $failedCount = 0;

            foreach ($request->file('photos') as $image) {
                try {
                    // Generate unique filename
                    $extension = $image->getClientOriginalExtension();
                    $filename = Str::random(40) . '.' . $extension;

                    // Store image in gallery folder
                    $path = $image->storeAs('banner', $filename, 'public');

                    if ($path) {
                        // Store in database with the generated filename
                        Banner::create([
                            'name' => $filename // Store the filename in the 'name' field
                        ]);
                        $uploadedCount++;
                    } else {
                        $failedCount++;
                    }
                } catch (\Exception $e) {
                    $failedCount++;
                    \Log::error('Image upload failed: ' . $e->getMessage());
                }
            }

            if ($uploadedCount > 0) {
                $message = $uploadedCount . ' image(s) uploaded successfully.';
                if ($failedCount > 0) {
                    $message .= ' ' . $failedCount . ' image(s) failed.';
                }
                return back()->with('success', $message);
            } else {
                return back()->with('error', 'Failed to upload images. Please try again.');
            }

        } catch (\Exception $e) {
            \Log::error('Upload error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while uploading. Please try again.');
        }
    }

    /**
     * Delete a specific image
     */
    public function destroy($id)
    {
        try {
            $photo = Banner::findOrFail($id);

            // Delete the physical file from storage
            $filePath = 'gallery/' . $photo->name;
            if (Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            // Delete the database record
            $photo->delete();

            return back()->with('success', 'Image deleted successfully.');

        } catch (\Exception $e) {
            \Log::error('Delete error: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete the image. Please try again.');
        }
    }
}
