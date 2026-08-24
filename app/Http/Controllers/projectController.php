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
            'title' => 'required|string|max:100',
            'brief' => 'required|string|max:500',
            'desc' => 'required|string',
            'cat-id' => 'required|integer',
            'image_url' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'success' => false],  422);
        }

        $project = new Projects();
        $maxNumber = Projects::max('number');

        $project->title = $request->input('title');
        $project->brief = $request->input('brief');
        $project->desc = $request->input('desc');
        $project->cat_id = $request->input('cat-id');
        $project->image_url = $request->input('image_url');
        $project->number = $maxNumber + 1;

        $project->save();

        return redirect()->back()->with('success', true);
    }

    public function deleteProject($id)
    {
        $project = Projects::findOrFail($id);

        if (!$project) {
            return response()->json(['error' => 'Project not found', 'success' => false], 404);
        }

        $project->delete();

        return redirect()->back()->with('success', true);
    }

    public function editeProject(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'brief' => 'required|string|max:500',
            'desc' => 'required|string',
            'cat-id' => 'required|integer',
            'image_url' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'success' => false],  422);
        }

        $project = Projects::findOrFail($id);

        if (!$project) {
            return response()->json(['error' => 'Project not found', 'success' => false], 404);
        }

        $project->title = $request->input('title');
        $project->brief = $request->input('brief');
        $project->desc = $request->input('desc');
        $project->cat_id = $request->input('cat-id');
        $project->image_url = $request->input('image_url');

        $project->save();

        return redirect()->back()->with('success', true);
    }

    public function returnAllProjects()
    {
        $projects = Projects::all();$projects = Projects::select('id', 'title', 'brief',
                    'cat-id','image_url','number')->get();

        return response()->json(['projects' => $projects, 'success' => true], 200);
    }

    public function returnProjectById($id)
    {
        $project = Projects::findOrFail($id);

        if (!$project) {
            return response()->json(['error' => 'Project not found', 'success' => false], 404);
        }

        $project_images = Images::Where('type', 1)->where('sub-id', $id)->get();

        return response()->json(['project' => $project, 'images' => $project_images, 'success' => true], 200);
    }

    public function addImageToProject(Request $request,$projectId)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'success' => false],  422);
        }



        $image = new Images();

        $image->type = 1; //فرضذ تایپ 1 برای پروژه ها هست
        $image->url = $request->input('url');
        $image->sub_id = $projectId;

        $image->save();

        return redirect()->back()->with('success', true);
    }

    public function deleteImageFromProject($imageId)
    {
        $image = Images::findOrFail($imageId);

        if (!$image) {
            return response()->json(['error' => 'Image not found', 'success' => false], 404);
        }

        $image->delete();

        return redirect()->back()->with('success', true);
    }

    public function addFeatureToProject(Request $request, $projectId)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required|string|max:255',
            'image_url' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'success' => false],  422);
        }

        $feature = new Features();

        $feature->text = $request->input('text');
        $feature->image_url = $request->input('image_url');
        $feature->type = 1; //فرضذ تایپ 1 برای پروژه ها هست
        $feature->sub_id = $projectId;

        $feature->save();

        return redirect()->back()->with('success', true);
    }

    public function deleteFeatureFromProject($featureId)
    {
        $feature = Features::findOrFail($featureId);

        if (!$feature) {
            return response()->json(['error' => 'Feature not found', 'success' => false], 404);
        }

        $feature->delete();

        return redirect()->back()->with('success', true);
    }

    public function changeNumberOfProject(Request $request, $projectId)
    {
        $validator = Validator::make($request->all(), [
            'number' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(),'success' => false],  422);
        }

        $project = Projects::findOrFail($projectId);

        if (!$project) {
            return response()->json(['error' => 'Project not found', 'success' => false], 404);
        }

        $project->number = $request->input('number');
        $project->save();

        return redirect()->back()->with('success', true);
    }



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
            'title'   => 'required|string|max:255',
            'brief'   => 'nullable|string|max:500',
            'desc'    => 'nullable|string',
            'cat-id'  => 'nullable|integer',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $maxNumber = Projects::max('number');
        $validated['number'] = $maxNumber + 1;

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
            'title'   => 'required|string|max:255',
            'brief'   => 'nullable|string|max:500',
            'desc'    => 'nullable|string',
            'cat-id'  => 'nullable|integer',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
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

}
