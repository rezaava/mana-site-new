<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SettingController extends Controller
{
    /**
     * کلیدهای مجاز تنظیمات
     */
    protected array $allowedKeys = [
        'site_name',
        'contact_email',
        'contact_phone',
        'address',
        'site_description',
        'site_keywords',
        'telegram',
        'instagram',
        'twitter',
    ];

    /**
     * مقادیر پیش‌فرض
     */
    protected array $defaults = [
        'site_name' => 'مانا',
        'contact_email' => '',
        'contact_phone' => '',
        'address' => '',
        'site_description' => '',
        'site_keywords' => '',
        'telegram' => '',
        'instagram' => '',
        'twitter' => '',
    ];

    /**
     * نمایش فرم تنظیمات
     */
    public function index()
    {
        // خواندن همه تنظیمات به‌صورت آرایه key => value
        $rawSettings = Setting::pluck('value', 'key')->toArray();

        // ادغام با مقادیر پیش‌فرض (اگر کلیدی وجود نداشت، مقدار پیش‌فرض بیاید)
        $settings = array_merge($this->defaults, $rawSettings);

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * ذخیره تغییرات تنظیمات
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:500',
            'site_description' => 'nullable|string|max:1000',
            'site_keywords' => 'nullable|string|max:500',
            'telegram' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
        ]);

        try {
            // ذخیره هر کلید به‌صورت جداگانه (updateOrCreate)
            foreach ($this->allowedKeys as $key) {
                $value = $validated[$key] ?? null;

                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => $value]
                );
            }

            return redirect()
                ->route('settings.index')
                ->with('success', 'تنظیمات سایت با موفقیت ذخیره شد.');
        } catch (\Throwable $e) {
            Log::error('SETTINGS UPDATE ERROR', [
                'message' => $e->getMessage(),
                'input' => $request->except('_token'),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['error' => 'خطا در ذخیره تنظیمات: ' . $e->getMessage()]);
        }
    }
}