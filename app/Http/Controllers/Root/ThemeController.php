<?php

namespace App\Http\Controllers\Root;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    /**
     * Display the theme images settings form.
     */
    public function index()
    {
        // Get current settings from config or database
        // For this example, we'll use config/settings.php or return an array
        // You can store these in database table 'settings' or config file

        $settings = $this->getThemeSettings();

        return view('admin.themesImage.index', compact('settings'));
    }

    /**
     * Update theme images.
     */
    public function update(Request $request)
    {
        // Define all 11 image fields with validation rules
        $imageFields = [
            'theme_background_img',
            'about_large_img',
            'about_small_img',
            'bd_travels_bg',
            'choose_round_img',
            'choose_taller_img',
            'choose_glass_img',
            'about_us_bg_img',
            'about_us_single_girl_img',
            'theme_overlay_img',
            'footer_pattern_img'
        ];

        // Build validation rules dynamically
        $validationRules = [];
        foreach ($imageFields as $field) {
            $validationRules[$field] = 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120'; // 5MB max
        }

        // Add remove checkboxes validation
        foreach ($imageFields as $field) {
            $validationRules['remove_' . $field] = 'nullable|boolean';
        }

        $request->validate($validationRules);

        // Get current settings
        $settings = $this->getThemeSettings();

        // Process each image field
        foreach ($imageFields as $field) {
            $removeField = 'remove_' . $field;

            // Check if remove checkbox is checked
            if ($request->has($removeField) && $request->input($removeField) == 1) {
                // Delete the existing image file
                if (isset($settings[$field]) && $settings[$field] && file_exists(public_path($settings[$field]))) {
                    unlink(public_path($settings[$field]));
                }
                $settings[$field] = null;
                continue;
            }

            // Upload new image if provided
            if ($request->hasFile($field)) {
                $file = $request->file($field);

                // Delete old file if exists
                if (isset($settings[$field]) && $settings[$field] && file_exists(public_path($settings[$field]))) {
                    unlink(public_path($settings[$field]));
                }

                // Generate unique filename
                $filename = time() . '_' . $field . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('uploads/theme-images');

                // Create directory if not exists
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }

                // Move file to public directory
                $file->move($destinationPath, $filename);

                // Save relative path
                $settings[$field] = 'uploads/theme-images/' . $filename;
            }
        }

        // Save settings (you can store in database, config, or cache)
        $this->saveThemeSettings($settings);

        return redirect()->route('admin.theme-images.index')
            ->with('success', 'Theme images updated successfully!');
    }

    /**
     * Get current theme settings.
     * You can store these in database or config file.
     */
    private function getThemeSettings()
    {
        // Option 1: Stored in config file
        // return config('theme_images', []);

        // Option 2: Stored in database (recommended)
        // $settings = Setting::where('key', 'theme_images')->first();
        // return $settings ? json_decode($settings->value, true) : [];

        // Option 3: For demo, return empty array or existing values
        // You can replace this with actual data source

        $defaults = [
            'theme_background_img' => null,
            'about_large_img' => null,
            'about_small_img' => null,
            'bd_travels_bg' => null,
            'choose_round_img' => null,
            'choose_taller_img' => null,
            'choose_glass_img' => null,
            'about_us_bg_img' => null,
            'about_us_single_girl_img' => null,
            'theme_overlay_img' => null,
            'footer_pattern_img' => null,
        ];

        // Load from database or file
        $savedSettings = $this->loadSettingsFromFile();

        return array_merge($defaults, $savedSettings);
    }

    /**
     * Save theme settings.
     */
    private function saveThemeSettings($settings)
    {
        // Option 1: Save to config file (not recommended for production)
        // $configPath = config_path('theme_images.php');
        // file_put_contents($configPath, '<?php return ' . var_export($settings, true) . ';');

        // Option 2: Save to database (recommended)
        // Setting::updateOrCreate(
        //     ['key' => 'theme_images'],
        //     ['value' => json_encode($settings)]
        // );

        // Option 3: Save to JSON file (alternative for simple projects)
        $this->saveSettingsToFile($settings);
    }

    /**
     * Load settings from JSON file (example implementation).
     */
    private function loadSettingsFromFile()
    {
        $path = storage_path('app/theme-settings.json');

        if (file_exists($path)) {
            $content = file_get_contents($path);
            return json_decode($content, true) ?: [];
        }

        return [];
    }

    /**
     * Save settings to JSON file (example implementation).
     */
    private function saveSettingsToFile($settings)
    {
        $path = storage_path('app/theme-settings.json');
        file_put_contents($path, json_encode($settings, JSON_PRETTY_PRINT));
    }
}
