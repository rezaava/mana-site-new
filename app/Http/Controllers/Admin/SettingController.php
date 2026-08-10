<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'site_name'        => Setting::get('site_name', 'مانا'),
            'site_description' => Setting::get('site_description', ''),
            'site_keywords'    => Setting::get('site_keywords', ''),
            'contact_email'    => Setting::get('contact_email', ''),
            'contact_phone'    => Setting::get('contact_phone', ''),
            'address'          => Setting::get('address', ''),
            'telegram'         => Setting::get('telegram', ''),
            'instagram'        => Setting::get('instagram', ''),
            'twitter'          => Setting::get('twitter', ''),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name'        => 'required|string|max:255',
            'site_description' => 'nullable|string',
            'site_keywords'    => 'nullable|string',
            'contact_email'    => 'nullable|email',
            'contact_phone'    => 'nullable|string',
            'address'          => 'nullable|string',
            'telegram'         => 'nullable|url',
            'instagram'        => 'nullable|url',
            'twitter'          => 'nullable|url',
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->route('settings.index')->with('success', 'تنظیمات با موفقیت ذخیره شد.');
    }
}
