<?php

namespace App\Http\Controllers;

use App\Models\Seo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class SeoController extends Controller
{
    public function index()
    {
        $dat = Seo::orderBy('id', 'desc')->get();
        $url = $this->existingUrls();

        return view('admin.seo.index',compact('dat','url'));
    }
    public function edit($id)
    {
        $seo = Seo::findOrFail($id);
        $url = $this->existingUrls();

        return view('admin.seo.edit',compact('seo','url'));
    }

    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'page_name' => 'required|string|max:255',
        'robots' => 'nullable|string|max:255',
        'description' => 'nullable|string',
        'keywords' => 'nullable|array',
        'keywords.*' => 'string',
        'icon' => 'nullable|image|mimes:png,ico,jpg,jpeg,svg|max:1024',
        'canonical_url' => 'nullable|url',
        'og_type' => 'nullable|string',
        'og_title' => 'nullable|string',
        'og_description' => 'nullable|string',
        'og_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'og_image_width' => 'nullable|string',
        'og_image_height' => 'nullable|string',
        'twitter_cart' => 'nullable|string',
        'twitter_title' => 'nullable|string',
        'twitter_description' => 'nullable|string',
        'twitter_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'twitter_site' => 'nullable|string',
        'structured_data' => 'nullable|string',
        'remove_icon' => 'nullable|boolean',
        'remove_og_image' => 'nullable|boolean',
        'remove_twitter_image' => 'nullable|boolean',
    ]);

    $seo = Seo::findOrFail($id);

    // Handle icon upload/removal
    if ($request->has('remove_icon') && $seo->icon) {
        $iconPath = public_path($seo->icon);
        if (file_exists($iconPath)) {
            unlink($iconPath);
        }
        $validated['icon'] = null;
    }

    if ($request->hasFile('icon')) {
        if ($seo->icon) {
            $iconPath = public_path($seo->icon);
            if (file_exists($iconPath)) {
                unlink($iconPath);
            }
        }
        $iconFile = $request->file('icon');
        $iconName = time() . '_icon_' . $iconFile->getClientOriginalName();
        $iconFile->move(public_path('uploads/seo/icons'), $iconName);
        $validated['icon'] = 'uploads/seo/icons/' . $iconName;
    } else {
        $validated['icon'] = $seo->icon;
    }

    // Handle OG image
    if ($request->has('remove_og_image') && $seo->og_image) {
        $ogImagePath = public_path($seo->og_image);
        if (file_exists($ogImagePath)) {
            unlink($ogImagePath);
        }
        $validated['og_image'] = null;
    }

    if ($request->hasFile('og_image')) {
        if ($seo->og_image) {
            $ogImagePath = public_path($seo->og_image);
            if (file_exists($ogImagePath)) {
                unlink($ogImagePath);
            }
        }
        $ogImageFile = $request->file('og_image');
        $ogImageName = time() . '_og_' . $ogImageFile->getClientOriginalName();
        $ogImageFile->move(public_path('uploads/seo/og'), $ogImageName);
        $validated['og_image'] = 'uploads/seo/og/' . $ogImageName;
    } else {
        $validated['og_image'] = $seo->og_image;
    }

    // Handle Twitter image
    if ($request->has('remove_twitter_image') && $seo->twitter_image) {
        $twitterImagePath = public_path($seo->twitter_image);
        if (file_exists($twitterImagePath)) {
            unlink($twitterImagePath);
        }
        $validated['twitter_image'] = null;
    }

    if ($request->hasFile('twitter_image')) {
        if ($seo->twitter_image) {
            $twitterImagePath = public_path($seo->twitter_image);
            if (file_exists($twitterImagePath)) {
                unlink($twitterImagePath);
            }
        }
        $twitterImageFile = $request->file('twitter_image');
        $twitterImageName = time() . '_twitter_' . $twitterImageFile->getClientOriginalName();
        $twitterImageFile->move(public_path('uploads/seo/twitter'), $twitterImageName);
        $validated['twitter_image'] = 'uploads/seo/twitter/' . $twitterImageName;
    } else {
        $validated['twitter_image'] = $seo->twitter_image;
    }

    // Convert keywords array to JSON
    if (isset($validated['keywords'])) {
        $validated['keywords'] = json_encode($validated['keywords']);
    }

    $seo->update($validated);

    return redirect()->route('admin.seo.index')
        ->with('success', 'SEO configuration updated successfully!');
}

    public function store(Request $request)
    {
        $request->validate([
            'page_name' => 'required|string|max:255|unique:seos,page_name',
            'description' => 'nullable|string',
            'keywords' => 'nullable|array',
            'robots' => 'nullable|string',
            'icon' => 'nullable|image|mimes:png,jpg,jpeg,ico|max:2048',
            'og_type' => 'nullable|string',
            'og_title' => 'nullable|string',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|image|max:4096',
            'og_image_width' => 'nullable|string',
            'og_image_height' => 'nullable|string',
            'twitter_cart' => 'nullable|string',
            'twitter_title' => 'nullable|string',
            'twitter_description' => 'nullable|string',
            'twitter_image' => 'nullable|image|max:4096',
        ]);

        $data = $request->except(['icon', 'og_image', 'twitter_image']);

        $data['keywords'] = $request->keywords
            ? implode(',', $request->keywords)
            : null;

        // Handle icon upload
        if ($request->hasFile('icon')) {
            $iconFile = $request->file('icon');
            $iconName = time() . '_icon_' . $iconFile->getClientOriginalName();
            $iconFile->move(public_path('uploads/seo/icons'), $iconName);
            $data['icon'] = 'uploads/seo/icons/' . $iconName;
        }

        // Handle OG image upload
        if ($request->hasFile('og_image')) {
            $ogImageFile = $request->file('og_image');
            $ogImageName = time() . '_og_' . $ogImageFile->getClientOriginalName();
            $ogImageFile->move(public_path('uploads/seo/og'), $ogImageName);
            $data['og_image'] = 'uploads/seo/og/' . $ogImageName;
        }

        // Handle Twitter image upload
        if ($request->hasFile('twitter_image')) {
            $twitterImageFile = $request->file('twitter_image');
            $twitterImageName = time() . '_twitter_' . $twitterImageFile->getClientOriginalName();
            $twitterImageFile->move(public_path('uploads/seo/twitter'), $twitterImageName);
            $data['twitter_image'] = 'uploads/seo/twitter/' . $twitterImageName;
        }

        Seo::create($data);

        return redirect()->back()->with('success', 'SEO data saved successfully!');
    }

    public function destroy(Seo $seo,$id)
    {
        $seo->destroy($id);
        return redirect()->route('admin.seo.index');
    }

    public function existingUrls()
    {

        $routes = Route::getRoutes();

        $routeData = [];

        foreach ($routes as $route) {
            $routeData[] = [
                'uri' => $route->uri(),
                'methods' => $route->methods(),
                'name' => $route->getName(),
                'action' => $route->getActionName(),
            ];
        }

        return $routeData;
    }

}
