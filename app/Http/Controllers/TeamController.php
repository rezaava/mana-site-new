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
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'instagram' => 'nullable',
            'twitter' => 'nullable',
            'github' => 'nullable',
            'telegram' => 'nullable',
            'whatsapp' => 'nullable',
            'linkedin' => 'nullable',
            'website' => 'nullable',
            'number' => 'required|integer|min:0',
        ]);

        $team = new Team();

        $team->name = $validated['name'];
        $team->title = $validated['title'];

        if ($request->hasFile('image_url')) {
            $imagePath = $request->file('image_url')->store('team', 'public');
            $team->image_url = $imagePath;
        }

        $team->instagram = $validated['instagram'] ?? null;
        $team->twitter = $validated['twitter'] ?? null;
        $team->github = $validated['github'] ?? null;
        $team->telegram = $validated['telegram'] ?? null;
        $team->whatsapp = $validated['whatsapp'] ?? null;
        $team->linkedin = $validated['linkedin'] ?? null;
        $team->website = $validated['website'] ?? null;
        $team->number = $validated['number'];
        $team->save();


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
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'instagram' => 'nullable',
            'twitter' => 'nullable',
            'github' => 'nullable',
            'telegram' => 'nullable',
            'whatsapp' => 'nullable',
            'linkedin' => 'nullable',
            'website' => 'nullable',
            'number' => 'required|integer|min:0',
        ]);

        $team->name = $validated['name'];
        $team->title = $validated['title'];


        if ($request->hasFile('image_url')) {

            if ($team->image_url && Storage::disk('public')->exists($team->image_url)) {
                Storage::disk('public')->delete($team->image_url);
            }

            $team->image_url = $request->file('image_url')->store('team', 'public');
        }

        $team->instagram = $validated['instagram'] ?? null;
        $team->twitter = $validated['twitter'] ?? null;
        $team->github = $validated['github'] ?? null;
        $team->telegram = $validated['telegram'] ?? null;
        $team->whatsapp = $validated['whatsapp'] ?? null;
        $team->linkedin = $validated['linkedin'] ?? null;
        $team->website = $validated['website'] ?? null;
        $team->number = $validated['number'];

        $team->save();

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
