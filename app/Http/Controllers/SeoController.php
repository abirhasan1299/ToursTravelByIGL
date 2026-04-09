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
        'description' => 'nullable|string|max:500',
        'keywords' => 'nullable|array',
        'keywords.*' => 'string|max:100',
        'icon' => 'nullable|image|mimes:png,ico,jpg,jpeg,svg|max:1024',
        'canonical_url' => 'nullable|url|max:500',
        'og_type' => 'nullable|string|max:50',
        'og_title' => 'nullable|string|max:255',
        'og_description' => 'nullable|string|max:500',
        'og_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'og_image_width' => 'nullable|string|max:10',
        'og_image_height' => 'nullable|string|max:10',
        'twitter_cart' => 'nullable|string|max:50',
        'twitter_title' => 'nullable|string|max:255',
        'twitter_description' => 'nullable|string|max:500',
        'twitter_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'twitter_site' => 'nullable|string|max:100',
        'structured_data' => 'nullable|string',
        'remove_icon' => 'nullable|boolean',
        'remove_og_image' => 'nullable|boolean',
        'remove_twitter_image' => 'nullable|boolean',
    ]);
    $seo = Seo::findOrFail($id);
    // Handle icon upload/removal
    if ($request->has('remove_icon') && $seo->icon) {
        Storage::disk('public')->delete($seo->icon);
        $validated['icon'] = null;
    }

    if ($request->hasFile('icon')) {
        if ($seo->icon) {
            Storage::disk('public')->delete($seo->icon);
        }
        $validated['icon'] = $request->file('icon')->store('seo/icons', 'public');
    } else {
        $validated['icon'] = $seo->icon;
    }

    // Handle OG image
    if ($request->has('remove_og_image') && $seo->og_image) {
        Storage::disk('public')->delete($seo->og_image);
        $validated['og_image'] = null;
    }

    if ($request->hasFile('og_image')) {
        if ($seo->og_image) {
            Storage::disk('public')->delete($seo->og_image);
        }
        $validated['og_image'] = $request->file('og_image')->store('seo/og', 'public');
    } else {
        $validated['og_image'] = $seo->og_image;
    }

    // Handle Twitter image
    if ($request->has('remove_twitter_image') && $seo->twitter_image) {
        Storage::disk('public')->delete($seo->twitter_image);
        $validated['twitter_image'] = null;
    }

    if ($request->hasFile('twitter_image')) {
        if ($seo->twitter_image) {
            Storage::disk('public')->delete($seo->twitter_image);
        }
        $validated['twitter_image'] = $request->file('twitter_image')->store('seo/twitter', 'public');
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


        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('seo/icon', 'public');
        }

        if ($request->hasFile('og_image')) {
            $data['og_image'] = $request->file('og_image')->store('seo/og', 'public');
        }

        if ($request->hasFile('twitter_image')) {
            $data['twitter_image'] = $request->file('twitter_image')->store('seo/twitter', 'public');
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
