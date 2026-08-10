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
            $validated['image_url'] = $request
                ->file('image')
                ->store('blogs', 'public');
        }

        $blog = Blogs::create($validated);

        // Redirect to index instead of back()
        return redirect()->route('blogs.index')
            ->with('success', "مقاله «{$blog->title}» با موفقیت ثبت شد.");
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
            if (
                $blog->image_url &&
                Storage::disk('public')->exists($blog->image_url)
            ) {
                Storage::disk('public')->delete($blog->image_url);
            }

            $validated['image_url'] = $request
                ->file('image')
                ->store('blogs', 'public');
        }

        $blog->update($validated);

        return redirect()->route('blogs.index')
            ->with('success', "مقاله «{$blog->title}» با موفقیت بروزرسانی شد.");
    }

    public function destroy($id)
    {
        $blog = Blogs::findOrFail($id);

        // Save info before delete
        $title = $blog->title;
        $deletedId = $blog->id;

        if (
            $blog->image_url &&
            Storage::disk('public')->exists($blog->image_url)
        ) {
            Storage::disk('public')->delete($blog->image_url);
        }

        $blog->delete();

        return redirect()->route('blogs.index')
            ->with('success', "مقاله «{$title}» (شناسه: {$deletedId}) با موفقیت حذف شد.");
    }
}