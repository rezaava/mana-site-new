<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blogs;
use Illuminate\Support\Facades\Storage;

class BlogsController extends Controller
{
    public function create(Request $request)
    {
        $validated_data = $request->validate([
            'title'      => 'required|string|max:200',
            'text'   => 'required|string',
            'image_url'    => 'required|file|image|max:2048',
            'reading-time'  => 'nullable|integer',
            'number'       => 'required|integer',
        ]);

        if ($request->hasFile('image_url')){
            $path = $request->file('image_url')->store('images', 'public');
            $validated_data['image_url'] = $path;
        }

        Blogs::create($validated_data);

        return response()->json([
            'success' => true,
            'message' => 'Blog created successfully'
        ], 201);
    }


    public function edit(Request $request, $id)
    {
        $blog = Blogs::findOrFail($id);

        $validated_data = $request->validate([
            'title'      => 'sometimes|string|max:200',
            'text'   => 'sometimes|string',
            'image_url'    => 'sometimes|file|image|max:2048',
            'reading-time'  => 'sometimes|nullable|integer',
            'number'       => 'sometimes|integer',
        ]);

        if ($request->hasFile('image_url')) {
            // حذف عکس قدیمی در صورت وجود
            if(
                $blog->image_url &&
                Storage::disk('public')->exists($blog->image_url)
            ){
                Storage::disk('public')->delete($blog->image_url);
            }
            $validated_data['image_url'] =
                $request->file('image_url')->store('images', 'public');
        }

        $blog->update($validated_data);

        return response()->json([
            'success' => true,
            'message' => 'Blog updated successfully'
        ], 200);
    }


    public function delete($id)
    {
        $blog = Blogs::findOrFail($id);

        if (
            $blog->image_url &&
            Storage::disk('public')->exists($blog->image_url)
        ) {
            Storage::disk('public')->delete($blog->image_url);
        }

        $blog->delete();

        return response()->json([
            'success' => true,
            'message' => 'Blog deleted successfully'
        ], 200);
    }
}

