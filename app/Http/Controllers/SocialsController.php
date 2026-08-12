<?php

namespace App\Http\Controllers;

use App\Models\Socials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SocialsController extends Controller
{
    public function index()
    {   
        $socials = Socials::latest()->paginate(10);
        return view('admin.socials.socials', compact('socials'));
    }

    public function create()
    {
        return view('admin.socials.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:100',
            'url'       => 'required|url',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($request->hasFile('image_url')) {
            $validated['image_url'] = $request->file('image_url')->store('socials', 'public');
        }

        Socials::create($validated);

        return redirect()->route('socials.index')->with('success', 'شبکه اجتماعی با موفقیت اضافه شد.');
    }

    public function edit($id)
    {
        $social = Socials::findOrFail($id);
        return view('admin.socials.edit', compact('social'));
    }

    public function update(Request $request, $id)
    {
        $social = Socials::findOrFail($id);

        $validated = $request->validate([
            'name'      => 'required|string|max:100',
            'url'       => 'required|url',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($request->hasFile('image_url')) {
            if ($social->image_url && Storage::disk('public')->exists($social->image_url)) {
                Storage::disk('public')->delete($social->image_url);
            }
            $validated['image_url'] = $request->file('image_url')->store('socials', 'public');
        }

        $social->update($validated);

        return redirect()->route('socials.index')->with('success', 'شبکه اجتماعی با موفقیت بروزرسانی شد.');
    }

    public function destroy($id)
    {
        $social = Socials::findOrFail($id);

        if ($social->image_url && Storage::disk('public')->exists($social->image_url)) {
            Storage::disk('public')->delete($social->image_url);
        }

        $social->delete();

        return redirect()->route('socials.index')->with('success', 'شبکه اجتماعی با موفقیت حذف شد.');
    }
}