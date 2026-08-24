<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Services::orderBy('number', 'asc')->paginate(10);
        return view('admin.pages.index', compact('services'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'  => 'required|string|max:255',
            'text'   => 'nullable|string',
            'image'  => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'icon'   => 'nullable|string|max:50',
            'number' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_url'] = $request->file('image')->store('services', 'public');
        }

        Services::create($validated);

        return redirect()->route('pages.index')->with('success', 'خدمت با موفقیت ایجاد شد.');
    }

    public function edit($id)
    {
        $service = Services::findOrFail($id);
        return view('admin.pages.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = Services::findOrFail($id);

        $validated = $request->validate([
            'title'  => 'required|string|max:255',
            'text'   => 'nullable|string',
            'image'  => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'icon'   => 'nullable|string|max:50',
            'number' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            if ($service->image_url && Storage::disk('public')->exists($service->image_url)) {
                Storage::disk('public')->delete($service->image_url);
            }
            $validated['image_url'] = $request->file('image')->store('services', 'public');
        }

        $service->update($validated);

        return redirect()->route('pages.index')->with('success', 'خدمت با موفقیت بروزرسانی شد.');
    }

    public function destroy($id)
    {
        $service = Services::findOrFail($id);

        if ($service->image_url && Storage::disk('public')->exists($service->image_url)) {
            Storage::disk('public')->delete($service->image_url);
        }

        $service->delete();

        return redirect()->route('pages.index')->with('success', 'خدمت با موفقیت حذف شد.');
    }
}
