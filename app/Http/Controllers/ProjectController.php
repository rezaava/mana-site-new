<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Projects;
use App\Models\Images;
use App\Models\Categories;
use App\Models\ProjectStat;
use App\Models\ProjectGallery;
use App\Models\ProjectService;
use App\Models\ProjectTechnology;
use App\Models\ProjectFeature;

class ProjectController extends Controller
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
            return response()->json([
                'errors'  => $validator->errors(),
                'success' => false
            ], 422);
        }
        $project = new Projects();
        $maxNumber = Projects::max('number');
        $project->title = $request->input('title');
        $project->subtitle = $request->input('subtitle');
        $project->brief = $request->input('brief');
        $project->desc = $request->input('desc');
        $project->challenge = $request->input('challenge');
        $project->solution = $request->input('solution');
        $project->cat_id = $request->input('cat_id');
        $project->image_url = $request->input('image_url');
        $project->client_name = $request->input('client_name');
        $project->launch_year = $request->input('launch_year');
        $project->duration = $request->input('duration');
        $project->project_link = $request->input('project_link');
        $project->number = ($maxNumber ?? 0) + 1;
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
            return response()->json([
                'errors'  => $validator->errors(),
                'success' => false
            ], 422);
        }
        $project = Projects::findOrFail($id);
        $project->title = $request->input('title');
        $project->subtitle = $request->input('subtitle');
        $project->brief = $request->input('brief');
        $project->desc = $request->input('desc');
        $project->challenge = $request->input('challenge');
        $project->solution = $request->input('solution');
        $project->cat_id = $request->input('cat_id');
        $project->image_url = $request->input('image_url');
        $project->client_name = $request->input('client_name');
        $project->launch_year = $request->input('launch_year');
        $project->duration = $request->input('duration');
        $project->project_link = $request->input('project_link');
        $project->save();
        return redirect()->back()->with('success', true);
    }

    public function returnAllProjects()
    {
        $projects = Projects::select(
            'id',
            'title',
            'brief',
            'cat_id',
            'image_url',
            'number',
            'challenge',
            'solution'
        )->get();
        return response()->json([
            'projects' => $projects,
            'success' => true
        ], 200);
    }

    public function returnProjectById($id)
    {
        $project = Projects::with([
            'stats',
            'galleries',
            'technologies',
            'services',
            'features'
        ])->findOrFail($id);
        $project_images = Images::where('type', 1)
            ->where('sub_id', $id)
            ->get();
        return response()->json([
            'project' => $project,
            'images' => $project_images,
            'success' => true
        ], 200);
    }

    public function addImageToProject(Request $request, $projectId)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'success' => false
            ], 422);
        }
        $image = new Images();
        $image->type = 1;
        $image->url = $request->input('url');
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

    public function changeNumberOfProject(Request $request, $projectId)
    {
        $validator = Validator::make($request->all(), [
            'number' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'success' => false
            ], 422);
        }
        $project = Projects::findOrFail($projectId);
        $project->number = $request->input('number');
        $project->save();
        return redirect()->back()->with('success', true);
    }

    public function index()
    {
        $projects = Projects::with([
            'stats',
            'technologies',
            'services',
            'features'
        ])->latest()->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $categories = Categories::all();
        $allTechnologies = $this->getTechnologiesList();
        return view('admin.projects.create', compact(
            'categories',
            'allTechnologies'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'brief' => 'nullable|string|max:500',
            'desc' => 'nullable|string',
            'project_goal' => 'nullable|string',
            'challenge' => 'nullable|string',
            'solution' => 'nullable|string',
            'cat_id' => 'nullable|integer',
            'client_name' => 'nullable|string|max:100',
            'client_role' => 'nullable|string|max:100',
            'launch_year' => 'nullable|string|max:50',
            'duration' => 'nullable|string|max:50',
            'project_link' => 'nullable|string|max:255',
            'testimonial' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'feature_title' => 'nullable|array',
            'feature_title.*' => 'nullable|string|max:255',
            'feature_text' => 'nullable|array',
            'feature_text.*' => 'nullable|string',
            'feature_icon' => 'nullable|array',
            'feature_icon.*' => 'nullable|string|max:255',
        ]);

        $uploadedFiles = [];

        try {
            DB::beginTransaction();

            $maxNumber = Projects::max('number');
            $number = ($maxNumber ?? 0) + 1;

            $project = new Projects();
            $project->title = $validated['title'];
            $project->subtitle = $validated['subtitle'] ?? null;
            $project->brief = $validated['brief'] ?? null;
            $project->desc = $validated['desc'] ?? null;
            $project->project_goal = $validated['project_goal'] ?? null;
            $project->challenge = $validated['challenge'] ?? null;
            $project->solution = $validated['solution'] ?? null;
            $project->cat_id = $validated['cat_id'] ?? null;
            $project->client_name = $validated['client_name'] ?? null;
            $project->client_role = $validated['client_role'] ?? null;
            $project->launch_year = $validated['launch_year'] ?? null;
            $project->duration = $validated['duration'] ?? null;
            $project->project_link = $validated['project_link'] ?? null;
            $project->testimonial = $validated['testimonial'] ?? null;
            $project->number = $number;

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('projects', 'public');
                $project->image_url = $imagePath;
                $uploadedFiles[] = $imagePath;
            } else {
                $project->image_url = 'default.jpg';
            }

            $project->save();

            $featureTitles = $request->input('feature_title', []);
            $featureTexts = $request->input('feature_text', []);
            $featureIcons = $request->input('feature_icon', []);

            foreach ($featureTitles as $index => $title) {
                $title = trim($title);
                $text = isset($featureTexts[$index]) ? trim($featureTexts[$index]) : '';
                $icon = isset($featureIcons[$index]) ? trim($featureIcons[$index]) : '';

                if ($title === '' && $text === '' && $icon === '') {
                    continue;
                }

                $feature = new ProjectFeature();
                $feature->project_id = $project->id;
                $feature->title = $title;
                $feature->text = $text;
                $feature->icon = $icon;
                $feature->save();
            }

            if ($request->has('stats_value') && is_array($request->stats_value)) {
                foreach ($request->stats_value as $index => $value) {
                    $value = trim($value);
                    $label = isset($request->stats_label[$index]) ? trim($request->stats_label[$index]) : '';

                    if ($value !== '' && $label !== '') {
                        $stat = new ProjectStat();
                        $stat->project_id = $project->id;
                        $stat->value = $value;
                        $stat->label = $label;
                        $stat->save();
                    }
                }
            }

            $selectedTechnologies = $request->input('technologies', []);
            $techIcons = $request->input('tech_icon', []);

            foreach ($selectedTechnologies as $techName) {
                $techName = trim($techName);

                if ($techName !== '') {
                    $icon = isset($techIcons[$techName]) ? $techIcons[$techName] : null;

                    $technology = new ProjectTechnology();
                    $technology->project_id = $project->id;
                    $technology->name = $techName;
                    $technology->icon = $icon;
                    $technology->order = 0;
                    $technology->save();
                }
            }

            if ($request->has('service_name') && is_array($request->service_name)) {
                foreach ($request->service_name as $index => $name) {
                    $name = trim($name);

                    if ($name !== '') {
                        $service = new ProjectService();
                        $service->project_id = $project->id;
                        $service->name = $name;
                        $service->order = $index;
                        $service->save();
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
                            $uploadedFiles[] = $path;

                            $gallery = new ProjectGallery();
                            $gallery->project_id = $project->id;
                            $gallery->category = $category;
                            $gallery->image_url = $path;
                            $gallery->save();
                        }
                    }
                }
            }

            DB::commit();

            return redirect()
                ->route('projects.index')
                ->with('success', 'پروژه با موفقیت ایجاد شد.');

        } catch (\Throwable $e) {
            DB::rollBack();

            foreach ($uploadedFiles as $file) {
                if (Storage::disk('public')->exists($file)) {
                    Storage::disk('public')->delete($file);
                }
            }

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'error' => 'خطا در ایجاد پروژه: ' . $e->getMessage()
                ]);
        }
    }

    public function edit($id)
    {
        $project = Projects::with([
            'stats',
            'technologies',
            'services',
            'galleries',
            'features'
        ])->findOrFail($id);
        $categories = Categories::all();
        $allTechnologies = $this->getTechnologiesList();
        $projectTechNames = $project->technologies->pluck('name')->toArray();
        return view('admin.projects.edit', compact(
            'project',
            'categories',
            'allTechnologies',
            'projectTechNames'
        ));
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
            'feature_title'   => 'nullable|array',
            'feature_title.*' => 'nullable|string|max:255',
            'feature_text'    => 'nullable|array',
            'feature_text.*'  => 'nullable|string',
            'feature_icon'    => 'nullable|array',
            'feature_icon.*'  => 'nullable|string|max:255',
        ]);
        $uploadedFiles = [];
        $oldImage = $project->image_url;
        try {
            DB::beginTransaction();
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('projects', 'public');
                $validated['image_url'] = $imagePath;
                $uploadedFiles[] = $imagePath;
            }
            $project->update($validated);
            $project->stats()->delete();
            $featureTitles = $request->input('feature_title', []);
            $featureTexts = $request->input('feature_text', []);
            $featureIcons = $request->input('feature_icon', []);
            ProjectFeature::where('project_id', $project->id)->delete();
            foreach ($featureTitles as $index => $title) {
                $title = trim($title);
                $text = isset($featureTexts[$index]) ? trim($featureTexts[$index]) : '';
                $icon = isset($featureIcons[$index]) ? trim($featureIcons[$index]) : '';
                if (empty($title) && empty($text) && empty($icon)) {
                    continue;
                }
                $feature = new ProjectFeature();
                $feature->project_id = $project->id;
                $feature->title = $title;
                $feature->text = $text;
                $feature->icon = $icon;
                $feature->save();
            }
            if ($request->has('stats_value') && is_array($request->stats_value)) {
                foreach ($request->stats_value as $index => $value) {
                    $value = trim($value);
                    $label = isset($request->stats_label[$index]) ? trim($request->stats_label[$index]) : '';
                    if (!empty($value) && !empty($label)) {
                        $stat = new ProjectStat();
                        $stat->project_id = $project->id;
                        $stat->value = $value;
                        $stat->label = $label;
                        $stat->save();
                    }
                }
            }
            $project->technologies()->delete();
            $selectedTechnologies = $request->input('technologies', []);
            $techIcons = $request->input('tech_icon', []);
            foreach ($selectedTechnologies as $techName) {
                $techName = trim($techName);
                if (!empty($techName)) {
                    $icon = isset($techIcons[$techName]) ? $techIcons[$techName] : null;
                    $technology = new ProjectTechnology();
                    $technology->project_id = $project->id;
                    $technology->name = $techName;
                    $technology->icon = $icon;
                    $technology->order = 0;
                    $technology->save();
                }
            }
            $project->services()->delete();
            if ($request->has('service_name') && is_array($request->service_name)) {
                foreach ($request->service_name as $index => $name) {
                    $name = trim($name);
                    if (!empty($name)) {
                        $service = new ProjectService();
                        $service->project_id = $project->id;
                        $service->name = $name;
                        $service->order = $index;
                        $service->save();
                    }
                }
            }
            $oldGalleries = $project->galleries()->get();
            foreach ($oldGalleries as $gallery) {
                if ($gallery->image_url && Storage::disk('public')->exists($gallery->image_url)) {
                    Storage::disk('public')->delete($gallery->image_url);
                }
            }
            $project->galleries()->delete();
            if ($request->hasFile('gallery_images')) {
                foreach ($request->file('gallery_images') as $category => $files) {
                    if (!is_array($files)) {
                        $files = [$files];
                    }
                    foreach ($files as $file) {
                        if ($file && $file->isValid()) {
                            $path = $file->store('project_galleries', 'public');
                            $uploadedFiles[] = $path;
                            $gallery = new ProjectGallery();
                            $gallery->project_id = $project->id;
                            $gallery->category = $category;
                            $gallery->image_url = $path;
                            $gallery->save();
                        }
                    }
                }
            }
            DB::commit();
            if ($request->hasFile('image') && $oldImage && $oldImage !== 'default.jpg' && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }
            return redirect()->route('projects.index')->with('success', 'پروژه با موفقیت بروزرسانی شد.');
        } catch (\Throwable $e) {
            DB::rollBack();
            foreach ($uploadedFiles as $file) {
                if (Storage::disk('public')->exists($file)) {
                    Storage::disk('public')->delete($file);
                }
            }
            return redirect()->back()->withInput()->withErrors([
                'error' => 'خطا در بروزرسانی پروژه: ' . $e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        $project = Projects::findOrFail($id);
        try {
            DB::beginTransaction();
            if ($project->image_url && $project->image_url !== 'default.jpg' && Storage::disk('public')->exists($project->image_url)) {
                Storage::disk('public')->delete($project->image_url);
            }
            $project->stats()->delete();
            $project->technologies()->delete();
            $project->services()->delete();
            ProjectFeature::where('project_id', $project->id)->delete();
            $galleries = $project->galleries()->get();
            foreach ($galleries as $gallery) {
                if ($gallery->image_url && Storage::disk('public')->exists($gallery->image_url)) {
                    Storage::disk('public')->delete($gallery->image_url);
                }
            }
            $project->galleries()->delete();
            $project->delete();
            DB::commit();
            return redirect()->route('projects.index')->with('success', 'پروژه با موفقیت حذف شد.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->back()->withErrors([
                'error' => 'خطا در حذف پروژه: ' . $e->getMessage()
            ]);
        }
    }

    public function show($id)
    {
        $project = Projects::with([
            'stats',
            'galleries',
            'features',
            'technologies',
            'services'
        ])->findOrFail($id);
        $relatedProjects = Projects::where('id', '!=', $id)
            ->orderBy('number', 'asc')
            ->limit(3)
            ->get();
        return view('projects.show', compact(
            'project',
            'relatedProjects'
        ));
    }

    public function addStatToProject(Request $request, $projectId)
    {
        $validator = Validator::make($request->all(), [
            'value' => 'required|string|max:50',
            'label' => 'required|string|max:100',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'success' => false
            ], 422);
        }
        ProjectStat::create([
            'project_id' => $projectId,
            'value' => $request->input('value'),
            'label' => $request->input('label'),
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
            'category' => 'required|in:desktop,mobile,key_pages',
            'image_url' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'success' => false
            ], 422);
        }
        ProjectGallery::create([
            'project_id' => $projectId,
            'category' => $request->input('category'),
            'image_url' => $request->input('image_url'),
        ]);
        return redirect()->back()->with('success', true);
    }

    public function deleteGalleryFromProject($galleryId)
    {
        $gallery = ProjectGallery::findOrFail($galleryId);
        if ($gallery->image_url && Storage::disk('public')->exists($gallery->image_url)) {
            Storage::disk('public')->delete($gallery->image_url);
        }
        $gallery->delete();
        return redirect()->back()->with('success', true);
    }

    private function getTechnologiesList()
    {
        return [
            ['name' => 'React', 'icon' => 'fa-fa-brands fa-react'],
            ['name' => 'Next.js', 'icon' => 'fa-fa-solid fa-n'],
            ['name' => 'Laravel', 'icon' => 'fa-fa-brands fa-laravel'],
            ['name' => 'MySQL', 'icon' => 'fa-fa-solid fa-database'],
            ['name' => 'Figma', 'icon' => 'fa-fa-brands fa-figma'],
            ['name' => 'Tailwind CSS', 'icon' => 'fa-fa-solid fa-wind'],
            ['name' => 'Docker', 'icon' => 'fa-fa-brands fa-docker'],
            ['name' => 'Redis', 'icon' => 'fa-fa-solid fa-bolt'],
            ['name' => 'Vue.js', 'icon' => 'fa-fa-brands fa-vuejs'],
            ['name' => 'Node.js', 'icon' => 'fa-fa-brands fa-node-js'],
            ['name' => 'Python', 'icon' => 'fa-fa-brands fa-python'],
            ['name' => 'Django', 'icon' => 'fa-fa-brands fa-python'],
        ];
    }
}