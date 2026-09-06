<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\BlogTag;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BlogsController extends Controller
{
    public function singleBlog($id)
    {
        $blog = Blogs::with([
            'category',
            'tags'
        ])->findOrFail($id);

        return view('blog.singleblog', compact('blog'));
    }

    public function blog()
    {
        $blogs = Blogs::with(['category','tags'])->latest()->get();

        return view('blog.all_blogs', compact('blogs'));
    }

    public function index()
    {
        $blogs = Blogs::with('category')
            ->latest()
            ->paginate(10);

        return view('admin.blogs.blogs', compact('blogs'));
    }

    public function create()
    {
        $categories = Categories::all();

        return view(
            'admin.blogs.create',
            compact('categories')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'cat_id' => 'required|integer|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'reading-time' => 'nullable|integer|min:1',
            'number' => 'nullable|integer',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|string|max:255',
        ]);

        $uploadedFiles = [];

        try {
            DB::beginTransaction();

            if ($request->hasFile('image')) {
                $imagePath = $request
                    ->file('image')
                    ->store('blogs', 'public');

                $validated['image_url'] = $imagePath;

                $uploadedFiles[] = $imagePath;
            }

            unset($validated['image']);
            unset($validated['tags']);

            $blog = Blogs::create($validated);

            if ($request->has('tags') && is_array($request->tags)) {
                foreach ($request->tags as $tag) {
                    $tag = trim($tag);

                    if (!empty($tag)) {
                        BlogTag::create([
                            'blog_id' => $blog->id,
                            'text' => $tag,
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()
                ->route('blogs.index')
                ->with(
                    'success',
                    "مقاله «{$blog->title}» با موفقیت ثبت شد."
                );
        } catch (\Throwable $e) {
            DB::rollBack();

            foreach ($uploadedFiles as $file) {
                if (Storage::disk('public')->exists($file)) {
                    Storage::disk('public')->delete($file);
                }
            }

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'error' => 'خطا در ثبت مقاله: ' . $e->getMessage()
                ]);
        }
    }

    public function edit($id)
    {
        $blog = Blogs::with('tags')
            ->findOrFail($id);

        $categories = Categories::all();

        return view(
            'admin.blogs.edit',
            compact(
                'blog',
                'categories'
            )
        );
    }

    public function update(Request $request, $id)
    {
        $blog = Blogs::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'text' => 'required|string',
            'cat_id' => 'required|integer|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'reading-time' => 'nullable|integer|min:1',
            'number' => 'nullable|integer',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|string|max:255',
        ]);

        $uploadedFiles = [];
        $oldImage = $blog->image_url;

        try {
            DB::beginTransaction();

            if ($request->hasFile('image')) {
                $imagePath = $request
                    ->file('image')
                    ->store('blogs', 'public');

                $validated['image_url'] = $imagePath;

                $uploadedFiles[] = $imagePath;
            }

            unset($validated['image']);
            unset($validated['tags']);

            $blog->update($validated);

            BlogTag::where(
                'blog_id',
                $blog->id
            )->delete();

            if ($request->has('tags') && is_array($request->tags)) {
                foreach ($request->tags as $tag) {
                    $tag = trim($tag);

                    if (!empty($tag)) {
                        BlogTag::create([
                            'blog_id' => $blog->id,
                            'text' => $tag,
                        ]);
                    }
                }
            }

            DB::commit();

            if (
                $request->hasFile('image') &&
                $oldImage &&
                Storage::disk('public')->exists($oldImage)
            ) {
                Storage::disk('public')->delete($oldImage);
            }

            return redirect()
                ->route('blogs.index')
                ->with(
                    'success',
                    "مقاله «{$blog->title}» با موفقیت بروزرسانی شد."
                );
        } catch (\Throwable $e) {
            DB::rollBack();

            foreach ($uploadedFiles as $file) {
                if (Storage::disk('public')->exists($file)) {
                    Storage::disk('public')->delete($file);
                }
            }

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'error' => 'خطا در بروزرسانی مقاله: ' . $e->getMessage()
                ]);
        }
    }

    public function destroy($id)
    {
        $blog = Blogs::findOrFail($id);

        $title = $blog->title;
        $deletedId = $blog->id;

        try {
            DB::beginTransaction();

            if (
                $blog->image_url &&
                Storage::disk('public')->exists($blog->image_url)
            ) {
                Storage::disk('public')->delete($blog->image_url);
            }

            BlogTag::where(
                'blog_id',
                $blog->id
            )->delete();

            $blog->delete();

            DB::commit();

            return redirect()
                ->route('blogs.index')
                ->with(
                    'success',
                    "مقاله «{$title}» (شناسه: {$deletedId}) با موفقیت حذف شد."
                );
        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withErrors([
                    'error' => 'خطا در حذف مقاله: ' . $e->getMessage()
                ]);
        }
    }
}