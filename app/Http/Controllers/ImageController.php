<?php

namespace App\Http\Controllers;

use App\Models\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store_image(Request $request)
    {
        $validated = $request->validate([
            'type'    => 'required|integer',
            'sub-id'  => 'required|integer',
            'image'   => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', // فعلا برای حداکثر اندازه ی فایل، 2 مگابایت تعیین کردم
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            
            // ذخیره اطلاعات در دیتابیس
            Images::create([
                'type'   => $validated['type'],
                'sub-id' => $validated['sub-id'],
                'url'    => $path, //مسیر فایل ذخیره شده
            ]);

            return response()->json(['success'=>true, 'message' => 'Image stored succesfully'], 201);
        }

        return response()->json(['error' => 'Failed to store the image', 'success'=>false], 400);
    }

    
    public function edit_image(Request $request, $id)
    {
        
        $image = Images::findOrFail($id);

  
        $validated = $request->validate([
            'type'    => 'integer',
            'sub-id'  => 'integer',
            'image'   => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        // اگر کاربر عکس جدیی فرستاده بود، قبلی پاک شود و جدید اضافه شود
        if ($request->hasFile('image')) {
            if ($image->url && Storage::disk('public')->exists($image->url)) {
                Storage::disk('public')->delete($image->url);
            }

            // آپلود فایل جدید
            $path = $request->file('image')->store('images', 'public');
            $validated['url'] = $path;
        }

        // آپدیت کردن اطلاعات دیتابیس
        $image->update($validated);

        return response()->json(['success'=>true, 'message' => 'Image edited successfully', 'data' => $image], 200);
    }

    
    public function delete_image($id)
    {
        $image = Images::findOrFail($id);

        if ($image->url && Storage::disk('public')->exists($image->url)) {
            Storage::disk('public')->delete($image->url);
        }

        $image->delete();

        return response()->json(['success'=>true, 'message'=> 'Image deleted successfully'], 200);
    }


}