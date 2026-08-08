<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Socials; // اگر نام مدل در پروژه شما Socialss است، این را اصلاح کنید
use Illuminate\Support\Facades\Storage;

class SocialsController extends Controller
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

        Socials::create($validated_data);

        return response()->json([
            'success' => true,
            'message' => 'Socials link created successfully'
        ], 201);
    }

    public function edit(Request $request, $id)
    {
        $socials = Socials::findOrFail($id);

        $validated_data = $request->validate([
            'name'      => 'sometimes|string|max:100',
            'url'       => 'sometimes|url',
            'image_url' => 'sometimes|file|image|max:2048',
        ]);

        if ($request->hasFile('image_url')) {
            // حذف عکس قدیمی در صورت وجود
            if ($socials->image_url && Storage::disk('public')->exists($socials->image_url)) {
                Storage::disk('public')->delete($socials->image_url);
            }

            $validated_data['image_url'] = $request->file('image_url')->store('images', 'public');
        }

        $socials->update($validated_data);

        return response()->json([
            'success' => true,
            'message' => 'Socials link updated successfully'
        ], 200);
    }

    public function delete($id)
    {
        $socials = Socials::findOrFail($id);

        // پاک کردن فایل تصویر از دیسک
        if ($socials->image_url && Storage::disk('public')->exists($socials->image_url)) {
            Storage::disk('public')->delete($socials->image_url);
        }

        $socials->delete();

        return response()->json([
            'success' => true,
            'message' => 'Socials link deleted successfully'
        ], 200);
    }
}