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
        $request->validate([
            'name'      => 'required|string|max:100',
            'title'     => 'required|string|max:100',
            'number'    => 'required|integer',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $member = new Team();
        $member->name = $request->name;
        $member->title = $request->title;
        $member->number = $request->number;

        if ($request->hasFile('image_url')) {
            $member->image_url = $request->file('image_url')->store('team', 'public');
        }

        $member->save();

        return redirect()->route('team.index')->with('success', 'عضو جدید با موفقیت اضافه شد.');
    }

    public function edit($id)
    {
        $team = Team::findOrFail($id);

        return view('admin.team.edit', compact('team'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'      => 'required|string|max:100',
            'title'     => 'required|string|max:100',
            'number'    => 'required|integer',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $member = Team::findOrFail($id);
        $member->name = $request->name;
        $member->title = $request->title;
        $member->number = $request->number;

        if ($request->hasFile('image_url')) {
            if ($member->image_url) {
                Storage::disk('public')->delete($member->image_url);
            }
            $member->image_url = $request->file('image_url')->store('team', 'public');
        }

        $member->save();

        return redirect()->route('team.index')->with('success', 'اطلاعات عضو با موفقیت آپدیت شد.');
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