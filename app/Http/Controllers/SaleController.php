<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::latest()->paginate(10);
        return view('admin.sales.index', compact('sales'));
    }

    public function create()
    {
        return view('admin.sales.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'  => 'required|string|max:255',
            'text'   => 'nullable|string',
            'image'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'price'  => 'nullable|integer',
            'number' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_url'] = $request->file('image')->store('sales', 'public');
        }

        Sale::create($validated);

        return redirect()->route('admin.sales.index')->with('success', 'محصول با موفقیت ایجاد شد.');
    }

    public function edit($id)
    {
        $sale = Sale::findOrFail($id);
        return view('admin.sales.edit', compact('sale'));
    }

    public function update(Request $request, $id)
    {
        $sale = Sale::findOrFail($id);

        $validated = $request->validate([
            'title'  => 'required|string|max:255',
            'text'   => 'nullable|string',
            'image'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'price'  => 'nullable|integer',
            'number' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            if ($sale->image_url && Storage::disk('public')->exists($sale->image_url)) {
                Storage::disk('public')->delete($sale->image_url);
            }
            $validated['image_url'] = $request->file('image')->store('sales', 'public');
        }

        $sale->update($validated);

        return redirect()->route('admin.sales.index')->with('success', 'محصول با موفقیت بروزرسانی شد.');
    }

    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);

        if ($sale->image_url && Storage::disk('public')->exists($sale->image_url)) {
            Storage::disk('public')->delete($sale->image_url);
        }

        $sale->delete();

        return redirect()->route('admin.sales.index')->with('success', 'محصول با موفقیت حذف شد.');
    }
}
