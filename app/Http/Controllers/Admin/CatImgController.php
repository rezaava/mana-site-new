<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CatImg;
use Illuminate\Http\Request;

class CatImgController extends Controller
{
    /**
     * نمایش لیست دسته‌بندی‌های تصاویر
     */
    public function index()
    {
        $categories = CatImg::orderBy('number')
            ->orderBy('id')
            ->get();

        return view('admin.cat-imgs.index', compact('categories'));
    }

    /**
     * ایجاد دسته‌بندی جدید
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'number' => 'nullable|integer|min:0',
        ]);

        CatImg::create([
            'title' => $request->title,
            'number' => $request->number ?? 0,
        ]);

        return redirect()
            ->route('cat-imgs.index')
            ->with('success', 'دسته‌بندی عکس با موفقیت ایجاد شد.');
    }

    /**
     * ویرایش دسته‌بندی
     */
    public function update(Request $request, $id)
    {
        $category = CatImg::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:100',
            'number' => 'nullable|integer|min:0',
        ]);

        $category->update([
            'title' => $request->title,
            'number' => $request->number ?? 0,
        ]);

        return redirect()
            ->route('cat-imgs.index')
            ->with('success', 'دسته‌بندی عکس با موفقیت ویرایش شد.');
    }

    /**
     * حذف دسته‌بندی
     */
    public function destroy($id)
    {
        $category = CatImg::findOrFail($id);

        $category->delete();

        return redirect()
            ->route('cat-imgs.index')
            ->with('success', 'دسته‌بندی عکس با موفقیت حذف شد.');
    }
}