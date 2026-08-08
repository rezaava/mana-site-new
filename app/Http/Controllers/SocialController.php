<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Social; // اگر نام مدل در پروژه شما Socials است، این را اصلاح کنید
use Illuminate\Support\Facades\Storage;

class SocialController extends Controller
{
    public function create(Request $request)
    {
        $validated_data = $request->validate([
            'name'      => 'required|string|max:100',
            'url'       => 'required|url',
            'image_url' => 'required|file|image|max:2048',
        ]);

        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('images', 'public');
            $validated_data['image_url'] = $path;
        }

        Social::create($validated_data);

        return response()->json([
            'success' => true,
            'message' => 'Social link created successfully'
        ], 201);
    }

    public function edit(Request $request, $id)
    {
        $social = Social::findOrFail($id);

        $validated_data = $request->validate([
            'name'      => 'sometimes|string|max:100',
            'url'       => 'sometimes|url',
            'image_url' => 'sometimes|file|image|max:2048',
        ]);

        if ($request->hasFile('image_url')) {
            // حذف عکس قدیمی در صورت وجود
            if ($social->image_url && Storage::disk('public')->exists($social->image_url)) {
                Storage::disk('public')->delete($social->image_url);
            }

            $validated_data['image_url'] = $request->file('image_url')->store('images', 'public');
        }

        $social->update($validated_data);

        return response()->json([
            'success' => true,
            'message' => 'Social link updated successfully'
        ], 200);
    }

    public function delete($id)
    {
        $social = Social::findOrFail($id);

        // پاک کردن فایل تصویر از دیسک
        if ($social->image_url && Storage::disk('public')->exists($social->image_url)) {
            Storage::disk('public')->delete($social->image_url);
        }

        $social->delete();

        return response()->json([
            'success' => true,
            'message' => 'Social link deleted successfully'
        ], 200);
    }
}