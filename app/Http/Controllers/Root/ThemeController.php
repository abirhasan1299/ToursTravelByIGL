<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class ThemeController extends Controller
{
    public function index()
    {
        $img = Theme::where('id',1)->first();
        return view('admin.themesImage.index', compact('img'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'theme_background_img' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048'
        ]);

        // Handle upload
        if ($request->hasFile('theme_background_img'))
        {
            $file = $request->file('theme_background_img');

            // Upload new image
            $path = $file->store('uploads/theme-images', 'public');
            $fullPath = 'storage/' . $path;

            $settings = Theme::where('id',1)->first();

            if ($settings) {
                $settings->update(['img' => $fullPath]);
            } else {
                Theme::create(['img' => $fullPath]);
            }

            Artisan::call('cache:clear');

            return redirect()->back()->with('success', 'Image uploaded successfully.');
        }

        return redirect()->back()->with('info', 'No changes made.');

    }

}
