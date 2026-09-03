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
use App\Models\ProjectStat;
use App\Models\ProjectGallery;
use App\Models\ProjectService;
use App\Models\ProjectTechnology;

class projectController extends Controller
{
    public function createProject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'        => 'required|string|max:100',
            'subtitle'     => 'nullable|string|max:255',
            'brief'        => 'required|string|max:500',
            'desc'         => 'required|string',
            'challenge'    => 'nullable|string',
            'solution'     => 'nullable|string',
            'cat_id'       => 'required|integer',
            'image_url'    => 'nullable|string|max:255',
            'client_name'  => 'nullable|string|max:100',
            'launch_year'  => 'nullable|string|max:50',
            'duration'     => 'nullable|string|max:50',
            'project_link' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'success' => false], 422);
        }

        $project = new Projects();
        $maxNumber = Projects::max('number');

        $project->title        = $request->input('title');
        $project->subtitle     = $request->input('subtitle');
        $project->brief        = $request->input('brief');
        $project->desc         = $request->input('desc');
        $project->challenge    = $request->input('challenge');
        $project->solution     = $request->input('solution');
        $project->cat_id       = $request->input('cat_id');
        $project->image_url    = $request->input('image_url');
        $project->client_name  = $request->input('client_name');
        $project->launch_year  = $request->input('launch_year');
        $project->duration     = $request->input('duration');
        $project->project_link = $request->input('project_link');
        $project->number       = ($maxNumber ?? 0) + 1;

        $project->save();

        return redirect()->back()->with('success', true);
    }

    public function editeProject(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'        => 'required|string|max:100',
            'subtitle'     => 'nullable|string|max:255',
            'brief'        => 'required|string|max:500',
            'desc'         => 'required|string',
            'challenge'    => 'nullable|string',
            'solution'     => 'nullable|string',
            'cat_id'       => 'required|integer',
            'image_url'    => 'nullable|string|max:255',
            'client_name'  => 'nullable|string|max:100',
            'launch_year'  => 'nullable|string|max:50',
            'duration'     => 'nullable|string|max:50',
            'project_link' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'success' => false], 422);
        }

        $project = Projects::findOrFail($id);

        $project->title        = $request->input('title');
        $project->subtitle     = $request->input('subtitle');
        $project->brief        = $request->input('brief');
        $project->desc         = $request->input('desc');
        $project->challenge    = $request->input('challenge');
        $project->solution     = $request->input('solution');
        $project->cat_id       = $request->input('cat_id');
        $project->image_url    = $request->input('image_url');
        $project->client_name  = $request->input('client_name');
        $project->launch_year  = $request->input('launch_year');
        $project->duration     = $request->input('duration');
        $project->project_link = $request->input('project_link');

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
        $project = Projects::with(['stats', 'galleries'])->findOrFail($id);
        $project_images = Images::where('type', 1)->where('sub_id', $id)->get();

        return response()->json([
            'project' => $project,
            'images'  => $project_images,
            'success' => true
        ], 200);
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

    public function index()
    {
        $projects = Projects::with(['stats', 'technologies', 'services'])->latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $categories = Categories::all();
        $allTechnologies = $this->getTechnologiesList();
        return view('admin.projects.create', compact('categories', 'allTechnologies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'subtitle'     => 'nullable|string|max:255',
            'brief'        => 'nullable|string|max:500',
            'desc'         => 'nullable|string',
            'project_goal' => 'nullable|string',
            'challenge'    => 'nullable|string',
            'solution'     => 'nullable|string',
            'cat_id'       => 'nullable|integer',
            'client_name'  => 'nullable|string|max:100',
            'client_role'  => 'nullable|string|max:100',
            'launch_year'  => 'nullable|string|max:50',
            'duration'     => 'nullable|string|max:50',
            'project_link' => 'nullable|string|max:255',
            'testimonial'  => 'nullable|string',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $maxNumber = Projects::max('number');
        $validated['number'] = ($maxNumber ?? 0) + 1;

        if ($request->hasFile('image')) {
            $validated['image_url'] = $request->file('image')->store('projects', 'public');
        } else {
            $validated['image_url'] = 'default.jpg';
        }

        $project = Projects::create($validated);

        if ($request->has('stats_value') && is_array($request->stats_value)) {
            foreach ($request->stats_value as $index => $value) {
                $value = trim($value);
                $label = isset($request->stats_label[$index]) ? trim($request->stats_label[$index]) : '';
                if (!empty($value) && !empty($label)) {
                    ProjectStat::create([
                        'project_id' => $project->id,
                        'value'      => $value,
                        'label'      => $label,
                    ]);
                }
            }
        }

        $selectedTechnologies = $request->input('technologies', []);
        $techIcons = $request->input('tech_icon', []);
        foreach ($selectedTechnologies as $techName) {
            $techName = trim($techName);
            if (!empty($techName)) {
                $icon = isset($techIcons[$techName]) ? $techIcons[$techName] : null;
                ProjectTechnology::create([
                    'project_id' => $project->id,
                    'name'       => $techName,
                    'icon'       => $icon,
                    'order'      => 0,
                ]);
            }
        }

        if ($request->has('service_name') && is_array($request->service_name)) {
            foreach ($request->service_name as $index => $name) {
                $name = trim($name);
                if (!empty($name)) {
                    ProjectService::create([
                        'project_id' => $project->id,
                        'name'       => $name,
                        'order'      => $index,
                    ]);
                }
            }
        }

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $category => $files) {
                if (!is_array($files)) {
                    $files = [$files];
                }
                foreach ($files as $file) {
                    if ($file && $file->isValid()) {
                        $path = $file->store('project_galleries', 'public');
                        ProjectGallery::create([
                            'project_id' => $project->id,
                            'category'   => $category,
                            'image_url'  => $path,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('projects.index')->with('success', 'پروژه با موفقیت ایجاد شد.');
    }

    public function edit($id)
    {
        $project = Projects::with(['stats', 'technologies', 'services', 'galleries'])->findOrFail($id);
        $categories = Categories::all();
        $allTechnologies = $this->getTechnologiesList();
        $projectTechNames = $project->technologies->pluck('name')->toArray();

        return view('admin.projects.edit', compact('project', 'categories', 'allTechnologies', 'projectTechNames'));
    }

    public function update(Request $request, $id)
    {
        $project = Projects::findOrFail($id);

        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'subtitle'     => 'nullable|string|max:255',
            'brief'        => 'nullable|string|max:500',
            'desc'         => 'nullable|string',
            'project_goal' => 'nullable|string',
            'challenge'    => 'nullable|string',
            'solution'     => 'nullable|string',
            'cat_id'       => 'nullable|integer',
            'client_name'  => 'nullable|string|max:100',
            'client_role'  => 'nullable|string|max:100',
            'launch_year'  => 'nullable|string|max:50',
            'duration'     => 'nullable|string|max:50',
            'project_link' => 'nullable|string|max:255',
            'testimonial'  => 'nullable|string',
            'image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($project->image_url && Storage::disk('public')->exists($project->image_url) && $project->image_url !== 'default.jpg') {
                Storage::disk('public')->delete($project->image_url);
            }
            $validated['image_url'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($validated);

        $project->stats()->delete();
        $project->technologies()->delete();
        $project->services()->delete();
        $project->galleries()->delete();

        if ($request->has('stats_value') && is_array($request->stats_value)) {
            foreach ($request->stats_value as $index => $value) {
                $value = trim($value);
                $label = isset($request->stats_label[$index]) ? trim($request->stats_label[$index]) : '';
                if (!empty($value) && !empty($label)) {
                    ProjectStat::create([
                        'project_id' => $project->id,
                        'value'      => $value,
                        'label'      => $label,
                    ]);
                }
            }
        }

        $selectedTechnologies = $request->input('technologies', []);
        $techIcons = $request->input('tech_icon', []);
        foreach ($selectedTechnologies as $techName) {
            $techName = trim($techName);
            if (!empty($techName)) {
                $icon = isset($techIcons[$techName]) ? $techIcons[$techName] : null;
                ProjectTechnology::create([
                    'project_id' => $project->id,
                    'name'       => $techName,
                    'icon'       => $icon,
                    'order'      => 0,
                ]);
            }
        }

        if ($request->has('service_name') && is_array($request->service_name)) {
            foreach ($request->service_name as $index => $name) {
                $name = trim($name);
                if (!empty($name)) {
                    ProjectService::create([
                        'project_id' => $project->id,
                        'name'       => $name,
                        'order'      => $index,
                    ]);
                }
            }
        }

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $category => $files) {
                if (!is_array($files)) {
                    $files = [$files];
                }
                foreach ($files as $file) {
                    if ($file && $file->isValid()) {
                        $path = $file->store('project_galleries', 'public');
                        ProjectGallery::create([
                            'project_id' => $project->id,
                            'category'   => $category,
                            'image_url'  => $path,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('projects.index')->with('success', 'پروژه با موفقیت بروزرسانی شد.');
    }

    public function destroy($id)
    {
        $project = Projects::findOrFail($id);

        if ($project->image_url && Storage::disk('public')->exists($project->image_url) && $project->image_url !== 'default.jpg') {
            Storage::disk('public')->delete($project->image_url);
        }

        $project->stats()->delete();
        $project->technologies()->delete();
        $project->services()->delete();
        $project->galleries()->delete();

        $project->delete();

        return redirect()->route('projects.index')->with('success', 'پروژه با موفقیت حذف شد.');
    }

    public function show($id)
    {
        $project = Projects::with(['stats', 'galleries', 'technologies', 'features', 'services'])->findOrFail($id);
        $relatedProjects = Projects::where('id', '!=', $id)->take(3)->get();

        return view('projects.show', compact('project', 'relatedProjects'));
    }

    public function addStatToProject(Request $request, $projectId)
    {
        $validator = Validator::make($request->all(), [
            'value' => 'required|string|max:50',
            'label' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'success' => false], 422);
        }

        ProjectStat::create([
            'project_id' => $projectId,
            'value'      => $request->input('value'),
            'label'      => $request->input('label'),
        ]);

        return redirect()->back()->with('success', true);
    }

    public function deleteStatFromProject($statId)
    {
        $stat = ProjectStat::findOrFail($statId);
        $stat->delete();

        return redirect()->back()->with('success', true);
    }

    public function addGalleryToProject(Request $request, $projectId)
    {
        $validator = Validator::make($request->all(), [
            'category'  => 'required|in:desktop,mobile,key_pages',
            'image_url' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors(), 'success' => false], 422);
        }

        ProjectGallery::create([
            'project_id' => $projectId,
            'category'   => $request->input('category'),
            'image_url'  => $request->input('image_url'),
        ]);

        return redirect()->back()->with('success', true);
    }

    public function deleteGalleryFromProject($galleryId)
    {
        $gallery = ProjectGallery::findOrFail($galleryId);
        $gallery->delete();

        return redirect()->back()->with('success', true);
    }

    private function getTechnologiesList()
    {
        return [
            ['name' => 'React', 'icon' => 'fa-brands fa-react'],
            ['name' => 'Next.js', 'icon' => 'fa-solid fa-n'],
            ['name' => 'Laravel', 'icon' => 'fa-brands fa-laravel'],
            ['name' => 'MySQL', 'icon' => 'fa-solid fa-database'],
            ['name' => 'Figma', 'icon' => 'fa-brands fa-figma'],
            ['name' => 'Tailwind CSS', 'icon' => 'fa-solid fa-wind'],
            ['name' => 'Docker', 'icon' => 'fa-brands fa-docker'],
            ['name' => 'Redis', 'icon' => 'fa-solid fa-bolt'],
            ['name' => 'Vue.js', 'icon' => 'fa-brands fa-vuejs'],
            ['name' => 'Node.js', 'icon' => 'fa-brands fa-node-js'],
            ['name' => 'Python', 'icon' => 'fa-brands fa-python'],
            ['name' => 'Django', 'icon' => 'fa-brands fa-python'],
        ];
    }
}