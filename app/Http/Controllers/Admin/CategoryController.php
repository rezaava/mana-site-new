<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Categories::latest()->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:1,2',
        ]);

        $category = new Categories();
        $category->name = $request->name;
        $category->type = $request->type;
        $category->save();

        return redirect()
            ->route('categories.index')
            ->with('success', 'دسته‌بندی اضافه شد.');
    }

    public function edit($id)
    {
        $category = Categories::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Categories::findOrFail($id);
        $category->name = $request->name;
        $category->type = $request->type;
        $category->save();
        return redirect()->route('categories.index')->with('success', 'دسته‌بندی بروزرسانی شد.');
    }

    public function destroy($id)
    {
        $category = Categories::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'دسته‌بندی حذف شد.');
    }
}
