<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Projects;
use App\Models\Images;
use App\Models\Features;
use Illuminate\Support\Facades\Storage;
use App\Models\Categories;

class projectController extends Controller
{
    public function createProject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'     => 'required|string|max:100',
            'brief'     => 'required|string|max:500',
            'desc'      => 'required|string',
            'challenge' => 'nullable|string',
            'solution'  => 'nullable|string',
            'cat_id'    => 'required|integer',
            'image_url' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'success' => false], 422);
        }

        $project = new Projects();
        $maxNumber = Projects::max('number');

        $project->title     = $request->input('title');
        $project->brief     = $request->input('brief');
        $project->desc      = $request->input('desc');
        $project->challenge = $request->input('challenge');
        $project->solution  = $request->input('solution');
        $project->cat_id    = $request->input('cat_id');
        $project->image_url = $request->input('image_url');
        $project->number    = ($maxNumber ?? 0) + 1;

        $project->save();

        return redirect()->back()->with('success', true);
    }

    public function deleteProject($id)
    {
        $project = Projects::findOrFail($id);
        $project->delete();

        return redirect()->back()->with('success', true);
    }

    public function editeProject(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'     => 'required|string|max:100',
            'brief'     => 'required|string|max:500',
            'desc'      => 'required|string',
            'challenge' => 'nullable|string',
            'solution'  => 'nullable|string',
            'cat_id'    => 'required|integer',
            'image_url' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'success' => false], 422);
        }

        $project = Projects::findOrFail($id);

        $project->title     = $request->input('title');
        $project->brief     = $request->input('brief');
        $project->desc      = $request->input('desc');
        $project->challenge = $request->input('challenge');
        $project->solution  = $request->input('solution');
        $project->cat_id    = $request->input('cat_id');
        $project->image_url = $request->input('image_url');

        $project->save();

        return redirect()->back()->with('success', true);
    }

    public function returnAllProjects()
    {
        $projects = Projects::select('id', 'title', 'brief', 'cat_id', 'image_url', 'number', 'challenge', 'solution')->get();

        return response()->json(['projects' => $projects, 'success' => true], 200);
    }

    public function returnProjectById($id)
    {
        $project = Projects::findOrFail($id);
        $project_images = Images::where('type', 1)->where('sub_id', $id)->get();

        return response()->json(['project' => $project, 'images' => $project_images, 'success' => true], 200);
    }

    public function addImageToProject(Request $request, $projectId)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'success' => false], 422);
        }

        $image = new Images();
        $image->type   = 1;
        $image->url    = $request->input('url');
        $image->sub_id = $projectId;
        $image->save();

        return redirect()->back()->with('success', true);
    }

    public function deleteImageFromProject($imageId)
    {
        $image = Images::findOrFail($imageId);
        $image->delete();

        return redirect()->back()->with('success', true);
    }

    public function addFeatureToProject(Request $request, $projectId)
    {
        $validator = Validator::make($request->all(), [
            'text'      => 'required|string|max:255',
            'image_url' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'success' => false], 422);
        }

        $feature = new Features();
        $feature->text      = $request->input('text');
        $feature->image_url = $request->input('image_url');
        $feature->type      = 1;
        $feature->sub_id    = $projectId;
        $feature->save();

        return redirect()->back()->with('success', true);
    }

    public function deleteFeatureFromProject($featureId)
    {
        $feature = Features::findOrFail($featureId);
        $feature->delete();

        return redirect()->back()->with('success', true);
    }

    public function changeNumberOfProject(Request $request, $projectId)
    {
        $validator = Validator::make($request->all(), [
            'number' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'success' => false], 422);
        }

        $project = Projects::findOrFail($projectId);
        $project->number = $request->input('number');
        $project->save();

        return redirect()->back()->with('success', true);
    }

    // Web Routes for Admin Area
    public function index()
    {
        $projects = Projects::latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $categories = Categories::all();
        return view('admin.projects.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'brief'     => 'nullable|string|max:500',
            'desc'      => 'nullable|string',
            'challenge' => 'nullable|string',
            'solution'  => 'nullable|string',
            'cat_id'    => 'nullable|integer',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $maxNumber = Projects::max('number');
        $validated['number'] = ($maxNumber ?? 0) + 1;

        if ($request->hasFile('image')) {
            $validated['image_url'] = $request->file('image')->store('projects', 'public');
        }

        Projects::create($validated);

        return redirect()->route('projects.index')->with('success', 'پروژه با موفقیت ایجاد شد.');
    }

    public function edit($id)
    {
        $project = Projects::findOrFail($id);
        $categories = Categories::all();
        return view('admin.projects.edit', compact('project', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $project = Projects::findOrFail($id);

        $validated = $request->validate([
            'title'     => 'required|string|max:255',
            'brief'     => 'nullable|string|max:500',
            'desc'      => 'nullable|string',
            'challenge' => 'nullable|string',
            'solution'  => 'nullable|string',
            'cat_id'    => 'nullable|integer',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($project->image_url && Storage::disk('public')->exists($project->image_url)) {
                Storage::disk('public')->delete($project->image_url);
            }
            $validated['image_url'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($validated);

        return redirect()->route('projects.index')->with('success', 'پروژه با موفقیت بروزرسانی شد.');
    }

    public function destroy($id)
    {
        $project = Projects::findOrFail($id);

        if ($project->image_url && Storage::disk('public')->exists($project->image_url)) {
            Storage::disk('public')->delete($project->image_url);
        }

        $project->delete();

        return redirect()->route('projects.index')->with('success', 'پروژه با موفقیت حذف شد.');
    }

    public function show($id)
    {
        $project = Projects::findOrFail($id);
        $relatedProjects = Projects::where('id', '!=', $id)->take(3)->get();

        return view('projects.show', compact('project', 'relatedProjects'));
    }
}