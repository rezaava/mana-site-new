<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function index()
    {
        $members = Team::all();

        return view('admin.team.team', compact('members'));
    }

    public function create()
    {
        return view('admin.team.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'title'     => 'nullable|string|max:255',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'instagram' => 'nullable|url',
            'twitter'   => 'nullable|url',
            'github'    => 'nullable|url',
            'telegram'  => 'nullable|url',
            'whatsapp'  => 'nullable|url',
            'linkedin'  => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            $validated['image_url'] = $request->file('image')->store('team', 'public');
        }

        Team::create($validated);

        return redirect()->route('team.index')->with('success', 'عضو تیم اضافه شد.');
    }

    public function edit($id)
    {
        $team = Team::findOrFail($id);

        return view('admin.team.edit', compact('team'));
    }

    public function update(Request $request, $id)
    {
        $team = Team::findOrFail($id);

        $validated = $request->validate([
            'name'      => 'required|string|max:255',
            'title'     => 'nullable|string|max:255',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'instagram' => 'nullable|url',
            'twitter'   => 'nullable|url',
            'github'    => 'nullable|url',
            'telegram'  => 'nullable|url',
            'whatsapp'  => 'nullable|url',
            'linkedin'  => 'nullable|url',
        ]);

        if ($request->hasFile('image')) {
            if ($team->image_url && Storage::disk('public')->exists($team->image_url)) {
                Storage::disk('public')->delete($team->image_url);
            }
            $validated['image_url'] = $request->file('image')->store('team', 'public');
        }

        $team->update($validated);

        return redirect()->route('team.index')->with('success', 'عضو تیم بروزرسانی شد.');
    }

    public function destroy($id)
    {
        $member = Team::findOrFail($id);

        if ($member->image_url) {
            Storage::disk('public')->delete($member->image_url);
        }

        $member->delete();

        return redirect()->route('team.index')->with('success', 'عضو مورد نظر حذف شد.');
    }
}
