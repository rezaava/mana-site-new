<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\BlogTag;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class BlogsController extends Controller
{
    public function singleBlog($slug)
    {
        $blog = Blogs::where('slug', $slug)
            ->with([
                'category',
                'tags'
            ])
            ->firstOrFail();

        return view('blog.singleblog', compact('blog'));
    }

    public function blog()
    {
        $blogs = Blogs::with([
            'category',
            'tags'
        ])
            ->latest()
            ->get();

        $popularTags = BlogTag::get();

        return view(
            'blog.all_blogs',
            compact('blogs', 'popularTags')
        );
    }

    public function index()
    {
        $blogs = Blogs::with('category')
            ->latest()
            ->paginate(10);

        return view(
            'admin.blogs.blogs',
            compact('blogs')
        );
    }

    public function create()
    {
        $categories = Categories::where('type', 2)->get();

        return view(
            'admin.blogs.create',
            compact('categories')
        );
    }

    public function store(Request $request)
    {
        $uploadedFiles = [];

        try {

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'text' => 'required|string',
                'cat_id' => 'required|integer|exists:categories,id',

                'meta' => 'nullable|string',
                'title_head' => 'nullable|string|max:255',

                'slug' => 'required|string|max:255|unique:blogs,slug',

                'image' => 'nullable',

                'reading-time' => 'nullable|integer|min:1',
                'number' => 'nullable|integer',

                'tags' => 'nullable|array',
                'tags.*' => 'nullable|string|max:255',
            ]);

            DB::beginTransaction();

            /*
            |--------------------------------------------------------------------------
            | آپلود تصویر
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('image')) {

                $file = $request->file('image');

                $fileName = time()
                    . '_'
                    . uniqid()
                    . '.'
                    . $file->getClientOriginalExtension();

                $file->move(
                    'blogs',
                    $fileName
                );

                $imagePath = 'blogs/' . $fileName;

                $validated['image_url'] = $imagePath;

                $uploadedFiles[] = $imagePath;
            }

            unset($validated['image']);
            unset($validated['tags']);

            $blog = Blogs::create($validated);

            /*
            |--------------------------------------------------------------------------
            | ثبت تگ‌ها
            |--------------------------------------------------------------------------
            */

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

        } catch (ValidationException $e) {

            Log::warning('BLOG VALIDATION ERROR', [
                'errors' => $e->errors(),

                'input' => $request->except([
                    '_token',
                    'image',
                ]),

                'user_id' => auth()->id(),
                'ip' => $request->ip(),
            ]);

            throw $e;

        } catch (\Throwable $e) {

            DB::rollBack();

            /*
            |--------------------------------------------------------------------------
            | حذف فایل آپلود شده در صورت خطا
            |--------------------------------------------------------------------------
            */

            foreach ($uploadedFiles as $file) {

                if (file_exists($file)) {
                    unlink($file);
                }
            }

            Log::error('BLOG STORE ERROR', [
                'message' => $e->getMessage(),
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),

                'input' => $request->except([
                    '_token',
                    'image',
                ]),

                'user_id' => auth()->id(),
                'ip' => $request->ip(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'error' => 'خطا در ثبت مقاله: ' . $e->getMessage(),
                ]);
        }
    }

    public function edit($id)
    {
        $blog = Blogs::with('tags')
            ->findOrFail($id);

        $blogTags = BlogTag::where(
            'blog_id',
            $blog->id
        )->get();

        $categories = Categories::where(
            'type',
            2
        )->get();

        return view(
            'admin.blogs.edit',
            compact(
                'blog',
                'categories',
                'blogTags'
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

            'meta' => 'nullable|string',
            'title_head' => 'nullable|string|max:255',

            'image' => 'nullable',

            'reading-time' => 'nullable|integer|min:1',
            'number' => 'nullable|integer',

            'tags' => 'nullable|array',
            'tags.*' => 'nullable|string|max:255',

            'slug' => 'required|string|max:255|unique:blogs,slug,' . $blog->id,
        ]);

        $oldImage = $blog->image_url;

        /*
        |--------------------------------------------------------------------------
        | اطلاعات مقاله
        |--------------------------------------------------------------------------
        */

        $blog->title = $validated['title'];
        $blog->text = $validated['text'];
        $blog->cat_id = $validated['cat_id'];

        $blog->{'reading-time'} =
            $validated['reading-time'] ?? null;

        $blog->number =
            $validated['number'] ?? null;

        $blog->slug = $validated['slug'];

        $blog->meta =
            $validated['meta'] ?? null;

        $blog->title_head =
            $validated['title_head'] ?? null;

        /*
        |--------------------------------------------------------------------------
        | آپلود تصویر جدید
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $fileName = time()
                . '_'
                . uniqid()
                . '.'
                . $file->getClientOriginalExtension();

            $file->move(
                'blogs',
                $fileName
            );

            $imagePath = 'blogs/' . $fileName;

            $blog->image_url = $imagePath;
        }

        $blog->save();

        /*
        |--------------------------------------------------------------------------
        | حذف تگ‌های قبلی
        |--------------------------------------------------------------------------
        */

        BlogTag::where(
            'blog_id',
            $blog->id
        )->delete();

        /*
        |--------------------------------------------------------------------------
        | ثبت تگ‌های جدید
        |--------------------------------------------------------------------------
        */

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

        /*
        |--------------------------------------------------------------------------
        | حذف تصویر قبلی
        |--------------------------------------------------------------------------
        */

        if (
            $request->hasFile('image') &&
            $oldImage
        ) {

            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
        }

        return redirect()
            ->route('blogs.index')
            ->with(
                'success',
                "مقاله «{$blog->title}» با موفقیت بروزرسانی شد."
            );
    }

    public function destroy($id)
    {
        $blog = Blogs::findOrFail($id);

        $title = $blog->title;
        $deletedId = $blog->id;

        try {

            DB::beginTransaction();

            /*
            |--------------------------------------------------------------------------
            | حذف تصویر مقاله
            |--------------------------------------------------------------------------
            */

            if (
                $blog->image_url &&
                file_exists($blog->image_url)
            ) {

                unlink($blog->image_url);
            }

            /*
            |--------------------------------------------------------------------------
            | حذف تگ‌ها
            |--------------------------------------------------------------------------
            */

            BlogTag::where(
                'blog_id',
                $blog->id
            )->delete();

            /*
            |--------------------------------------------------------------------------
            | حذف مقاله
            |--------------------------------------------------------------------------
            */

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
                    'error' =>
                        'خطا در حذف مقاله: '
                        . $e->getMessage()
                ]);
        }
    }
}