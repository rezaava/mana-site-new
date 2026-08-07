<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teams;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    public function create(Request $request)
    {
        $validated_data = $request->validate([
            'name' => 'required|string|max:100',
            'title' => 'required|string|max:100',
            'number' => 'required|integer',
            'image_url' => 'required|file|image',
        ]);

        if ($request->hasFile('image_url')) {

            $path = $request->file('image_url')->store('images', 'public');

            $validated_data['image_url'] = $path;
        }

        Teams::create($validated_data);

        return response()->json([
            'success' => true,
            'message' => 'Team member created successfully'
        ], 201);
    }

    public function edit(Request $request, $id)
    {
        $team = Teams::findOrFail($id);

        $validated_data = $request->validate([
            'name' => 'sometimes|string|max:100',
            'title' => 'sometimes|string|max:100',
            'number' => 'sometimes|integer',
            'image_url' => 'sometimes|file|image',
        ]);

        if ($request->hasFile('image_url')) {

            if ($team->image_url && Storage::disk('public')->exists($team->image_url)) {
                Storage::disk('public')->delete($team->image_url);
            }

            $validated_data['image_url'] = $request->file('image_url')->store('images', 'public');
        }

        $team->update($validated_data);

        return response()->json([
            'success' => true,
            'message' => 'Team member updated successfully'
        ], 200);
    }

    public function delete($id)
    {
        $team = Teams::findOrFail($id);

        if ($team->image_url && Storage::disk('public')->exists($team->image_url)) {
            Storage::disk('public')->delete($team->image_url);
        }

        $team->delete();

        return response()->json([
            'success' => true,
            'message' => 'Team member deleted successfully'
        ], 200);
    }
}