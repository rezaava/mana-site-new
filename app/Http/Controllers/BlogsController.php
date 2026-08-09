<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogsController extends Controller
{
    public function index()
    {
        $blogs = Blogs::latest()->paginate(10);
        return view('admin.blogs.blogs', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'text'         => 'required|string',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'reading-time' => 'nullable|integer|min:1',
            'number'       => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_url'] = $request->file('image')->store('blogs', 'public');
        }

        if ($request->filled('reading-time')) {
            $validated['reading-time'] = $request->input('reading-time');
        }

        Blogs::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Blog created successfully.'
        ]);
    }

    public function edit($id)
    {
        $blog = Blogs::findOrFail($id);
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blogs::findOrFail($id);

        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'text'         => 'required|string',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'reading-time' => 'nullable|integer|min:1',
            'number'       => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            if ($blog->image_url && Storage::disk('public')->exists($blog->image_url)) {
                Storage::disk('public')->delete($blog->image_url);
            }
            $validated['image_url'] = $request->file('image')->store('blogs', 'public');
        }

        if ($request->filled('reading-time')) {
            $validated['reading-time'] = $request->input('reading-time');
        }

        $blog->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Blog updated successfully.'
        ]);
    }

    public function destroy($id)
    {
        $blog = Blogs::findOrFail($id);

        if ($blog->image_url && Storage::disk('public')->exists($blog->image_url)) {
            Storage::disk('public')->delete($blog->image_url);
        }

        $blog->delete();

        return response()->json([
            'success' => true,
            'message' => 'Blog deleted successfully.'
        ]);
    }
}