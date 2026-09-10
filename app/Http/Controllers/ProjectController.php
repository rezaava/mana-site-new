<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Projects;
use App\Models\Images;
use App\Models\Categories;
use App\Models\CatImg;
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
            'galleries.category',
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

        $galleryCategories = CatImg::orderBy('number')
            ->orderBy('id')
            ->get();

        return view('admin.projects.create', compact(
            'categories',
            'galleryCategories'
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

            'technology_name' => 'nullable|array',
            'technology_name.*' => 'nullable|string|max:255',

            'technology_icon' => 'nullable|array',
            'technology_icon.*' => 'nullable|string|max:255',

            'technology_order' => 'nullable|array',
            'technology_order.*' => 'nullable|integer|min:0',

            'stats_value' => 'nullable|array',
            'stats_value.*' => 'nullable|string|max:50',

            'stats_label' => 'nullable|array',
            'stats_label.*' => 'nullable|string|max:100',

            'service_name' => 'nullable|array',
            'service_name.*' => 'nullable|string|max:255',

            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'nullable|array',
            'gallery_images.*.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',

            'slug' => 'required|string|max:255',
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
            $project->slug = $validated['slug'];

            /*
             * ==========================
             * MAIN IMAGE
             * ==========================
             */

            if ($request->hasFile('image')) {
                $file = $request->file('image');

                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                $file->move(
                    public_path('projects'),
                    $fileName
                );

                $imagePath = 'projects/' . $fileName;

                $project->image_url = $imagePath;

                $uploadedFiles[] = $imagePath;
            } else {
                $project->image_url = 'default.jpg';
            }

            $project->save();

            /*
             * ==========================
             * FEATURES
             * ==========================
             */

            $featureTitles = $request->input('feature_title', []);
            $featureTexts = $request->input('feature_text', []);
            $featureIcons = $request->input('feature_icon', []);

            foreach ($featureTitles as $index => $title) {
                $title = trim($title);

                $text = isset($featureTexts[$index])
                    ? trim($featureTexts[$index])
                    : '';

                $icon = isset($featureIcons[$index])
                    ? trim($featureIcons[$index])
                    : '';

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

            /*
             * ==========================
             * STATS
             * ==========================
             */

            $statsValues = $request->input('stats_value', []);
            $statsLabels = $request->input('stats_label', []);

            foreach ($statsValues as $index => $value) {
                $value = trim($value);

                $label = isset($statsLabels[$index])
                    ? trim($statsLabels[$index])
                    : '';

                if ($value === '' || $label === '') {
                    continue;
                }

                $stat = new ProjectStat();

                $stat->project_id = $project->id;
                $stat->value = $value;
                $stat->label = $label;

                $stat->save();
            }

            /*
             * ==========================
             * TECHNOLOGIES
             * ==========================
             */

            $technologyNames = $request->input('technology_name', []);
            $technologyIcons = $request->input('technology_icon', []);
            $technologyOrders = $request->input('technology_order', []);

            foreach ($technologyNames as $index => $name) {
                $name = trim($name);

                $icon = isset($technologyIcons[$index])
                    ? trim($technologyIcons[$index])
                    : '';

                $order = isset($technologyOrders[$index])
                    ? (int) $technologyOrders[$index]
                    : 0;

                if ($name === '') {
                    continue;
                }

                $technology = new ProjectTechnology();

                $technology->project_id = $project->id;
                $technology->name = $name;
                $technology->icon = $icon !== '' ? $icon : null;
                $technology->order = $order;

                $technology->save();
            }

            /*
             * ==========================
             * SERVICES
             * ==========================
             */

            $serviceNames = $request->input('service_name', []);

            foreach ($serviceNames as $index => $name) {
                $name = trim($name);

                if ($name === '') {
                    continue;
                }

                $service = new ProjectService();

                $service->project_id = $project->id;
                $service->name = $name;
                $service->order = $index;

                $service->save();
            }

            /*
             * ==========================
             * GALLERY
             * ==========================
             */

            $galleryImages = $request->file('gallery_images', []);

            foreach ($galleryImages as $catImgId => $files) {
                if (!is_array($files)) {
                    $files = [$files];
                }

                $category = CatImg::find($catImgId);

                if (!$category) {
                    continue;
                }

                foreach ($files as $file) {
                    if (!$file || !$file->isValid()) {
                        continue;
                    }

                    $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                    $file->move(
                        public_path('projects'),
                        $fileName
                    );

                    $path = 'projects/' . $fileName;

                    $uploadedFiles[] = $path;

                    $gallery = new ProjectGallery();

                    $gallery->project_id = $project->id;
                    $gallery->cat_img_id = $category->id;
                    $gallery->image_url = $path;

                    $gallery->save();
                }
            }

            DB::commit();

            return redirect()
                ->route('projects.index')
                ->with('success', 'پروژه با موفقیت ایجاد شد.');

        } catch (\Throwable $e) {
            DB::rollBack();

            foreach ($uploadedFiles as $file) {
                $fullPath = public_path($file);

                if (file_exists($fullPath)) {
                    @unlink($fullPath);
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

        $galleryCategories = CatImg::orderBy('number')
            ->orderBy('id')
            ->get();

        return view('admin.projects.edit', compact(
            'project',
            'categories',
            'galleryCategories'
        ));
    }

    public function update(Request $request, $id)
    {
        $project = Projects::findOrFail($id);

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

            'technology_name' => 'nullable|array',
            'technology_name.*' => 'nullable|string|max:255',

            'technology_icon' => 'nullable|array',
            'technology_icon.*' => 'nullable|string|max:255',

            'technology_order' => 'nullable|array',
            'technology_order.*' => 'nullable|integer|min:0',

            'stats_value' => 'nullable|array',
            'stats_value.*' => 'nullable|string|max:50',

            'stats_label' => 'nullable|array',
            'stats_label.*' => 'nullable|string|max:100',

            'service_name' => 'nullable|array',
            'service_name.*' => 'nullable|string|max:255',

            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'nullable|array',
            'gallery_images.*.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',

            'slug' => 'required|string|max:255',
        ]);

        $uploadedFiles = [];

        $oldImage = $project->image_url;

        try {
            DB::beginTransaction();

            /*
             * ==========================
             * MAIN IMAGE
             * ==========================
             */

            if ($request->hasFile('image')) {
                $file = $request->file('image');

                $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                $file->move(
                    public_path('projects'),
                    $fileName
                );

                $imagePath = 'projects/' . $fileName;

                $validated['image_url'] = $imagePath;

                $uploadedFiles[] = $imagePath;
            }

            $project->update($validated);

            /*
             * ==========================
             * FEATURES
             * ==========================
             */

            ProjectFeature::where(
                'project_id',
                $project->id
            )->delete();

            $featureTitles = $request->input('feature_title', []);
            $featureTexts = $request->input('feature_text', []);
            $featureIcons = $request->input('feature_icon', []);

            foreach ($featureTitles as $index => $title) {
                $title = trim($title);

                $text = isset($featureTexts[$index])
                    ? trim($featureTexts[$index])
                    : '';

                $icon = isset($featureIcons[$index])
                    ? trim($featureIcons[$index])
                    : '';

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

            /*
             * ==========================
             * STATS
             * ==========================
             */

            $project->stats()->delete();

            $statsValues = $request->input('stats_value', []);
            $statsLabels = $request->input('stats_label', []);

            foreach ($statsValues as $index => $value) {
                $value = trim($value);

                $label = isset($statsLabels[$index])
                    ? trim($statsLabels[$index])
                    : '';

                if ($value === '' || $label === '') {
                    continue;
                }

                $stat = new ProjectStat();

                $stat->project_id = $project->id;
                $stat->value = $value;
                $stat->label = $label;

                $stat->save();
            }

            /*
             * ==========================
             * TECHNOLOGIES
             * ==========================
             */

            $project->technologies()->delete();

            $technologyNames = $request->input(
                'technology_name',
                []
            );

            $technologyIcons = $request->input(
                'technology_icon',
                []
            );

            $technologyOrders = $request->input(
                'technology_order',
                []
            );

            foreach ($technologyNames as $index => $name) {
                $name = trim($name);

                $icon = isset($technologyIcons[$index])
                    ? trim($technologyIcons[$index])
                    : '';

                $order = isset($technologyOrders[$index])
                    ? (int) $technologyOrders[$index]
                    : 0;

                if ($name === '') {
                    continue;
                }

                $technology = new ProjectTechnology();

                $technology->project_id = $project->id;
                $technology->name = $name;
                $technology->icon = $icon !== ''
                    ? $icon
                    : null;
                $technology->order = $order;

                $technology->save();
            }

            /*
             * ==========================
             * SERVICES
             * ==========================
             */

            $project->services()->delete();

            $serviceNames = $request->input(
                'service_name',
                []
            );

            foreach ($serviceNames as $index => $name) {
                $name = trim($name);

                if ($name === '') {
                    continue;
                }

                $service = new ProjectService();

                $service->project_id = $project->id;
                $service->name = $name;
                $service->order = $index;

                $service->save();
            }

            /*
             * ==========================
             * GALLERY
             * ==========================
             *
             * اگر برای یک دسته تصویر جدید آپلود شود،
             * تصاویر قبلی همان دسته حذف و تصاویر جدید جایگزین می‌شوند.
             *
             * اگر برای یک دسته هیچ تصویر جدیدی انتخاب نشود،
             * تصاویر قبلی آن دسته باقی می‌مانند.
             */

            $galleryImages = $request->file('gallery_images', []);

            foreach ($galleryImages as $catImgId => $files) {
                if (!is_array($files)) {
                    $files = [$files];
                }

                $category = CatImg::find($catImgId);

                if (!$category) {
                    continue;
                }

                $validFiles = [];

                foreach ($files as $file) {
                    if ($file && $file->isValid()) {
                        $validFiles[] = $file;
                    }
                }

                if (count($validFiles) === 0) {
                    continue;
                }

                /*
                 * حذف تصاویر قبلی همین دسته
                 */

                $oldGalleries = ProjectGallery::where(
                    'project_id',
                    $project->id
                )
                    ->where(
                        'cat_img_id',
                        $category->id
                    )
                    ->get();

                foreach ($oldGalleries as $oldGallery) {
                    if ($oldGallery->image_url) {
                        $oldPath = public_path(
                            $oldGallery->image_url
                        );

                        if (file_exists($oldPath)) {
                            @unlink($oldPath);
                        }
                    }

                    $oldGallery->delete();
                }

                /*
                 * ذخیره تصاویر جدید
                 */

                foreach ($validFiles as $file) {
                    $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                    $file->move(
                        public_path('projects'),
                        $fileName
                    );

                    $path = 'projects/' . $fileName;

                    $uploadedFiles[] = $path;

                    $gallery = new ProjectGallery();

                    $gallery->project_id = $project->id;
                    $gallery->cat_img_id = $category->id;
                    $gallery->image_url = $path;

                    $gallery->save();
                }
            }

            DB::commit();

            /*
             * حذف تصویر شاخص قبلی بعد از موفقیت
             */

            if (
                $request->hasFile('image') &&
                $oldImage &&
                $oldImage !== 'default.jpg'
            ) {
                $oldImagePath = public_path($oldImage);

                if (file_exists($oldImagePath)) {
                    @unlink($oldImagePath);
                }
            }

            return redirect()
                ->route('projects.index')
                ->with(
                    'success',
                    'پروژه با موفقیت بروزرسانی شد.'
                );

        } catch (\Throwable $e) {
            DB::rollBack();

            foreach ($uploadedFiles as $file) {
                $fullPath = public_path($file);

                if (file_exists($fullPath)) {
                    @unlink($fullPath);
                }
            }

            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'error' =>
                        'خطا در بروزرسانی پروژه: ' .
                        $e->getMessage()
                ]);
        }
    }

    public function destroy($id)
    {
        $project = Projects::findOrFail($id);

        try {
            DB::beginTransaction();

            /*
             * ==========================
             * MAIN IMAGE
             * ==========================
             */

            if (
                $project->image_url &&
                $project->image_url !== 'default.jpg'
            ) {
                $imagePath = public_path(
                    $project->image_url
                );

                if (file_exists($imagePath)) {
                    @unlink($imagePath);
                }
            }

            /*
             * ==========================
             * STATS
             * ==========================
             */

            $project->stats()->delete();

            /*
             * ==========================
             * TECHNOLOGIES
             * ==========================
             */

            $project->technologies()->delete();

            /*
             * ==========================
             * SERVICES
             * ==========================
             */

            $project->services()->delete();

            /*
             * ==========================
             * FEATURES
             * ==========================
             */

            ProjectFeature::where(
                'project_id',
                $project->id
            )->delete();

            /*
             * ==========================
             * GALLERY
             * ==========================
             */

            $galleries = $project->galleries()->get();

            foreach ($galleries as $gallery) {
                if ($gallery->image_url) {
                    $galleryPath = public_path(
                        $gallery->image_url
                    );

                    if (file_exists($galleryPath)) {
                        @unlink($galleryPath);
                    }
                }
            }

            $project->galleries()->delete();

            /*
             * ==========================
             * PROJECT
             * ==========================
             */

            $project->delete();

            DB::commit();

            return redirect()
                ->route('projects.index')
                ->with(
                    'success',
                    'پروژه با موفقیت حذف شد.'
                );

        } catch (\Throwable $e) {
            DB::rollBack();

            return redirect()
                ->back()
                ->withErrors([
                    'error' =>
                        'خطا در حذف پروژه: ' .
                        $e->getMessage()
                ]);
        }
    }

    public function show($slug)
    {
        $project = Projects::where('slug', $slug)
            ->with([
                'stats',
                'galleries.category',
                'features',
                'technologies',
                'services'
            ])
            ->firstOrFail();

        $imageCategories = CatImg::orderBy('number')
            ->orderBy('id')
            ->with([
                'galleries' => function ($query) use ($project) {
                    $query->where(
                        'project_id',
                        $project->id
                    );
                }
            ])
            ->get()
            ->filter(function ($category) {
                return $category->galleries->isNotEmpty();
            })
            ->values();

        $relatedProjects = Projects::where(
            'id',
            '!=',
            $project->id
        )
            ->orderBy('number', 'asc')
            ->limit(3)
            ->get();

        return view(
            'projects.show',
            compact(
                'project',
                'relatedProjects',
                'imageCategories'
            )
        );
    }

    public function addStatToProject(
        Request $request,
        $projectId
    ) {
        $validator = Validator::make(
            $request->all(),
            [
                'value' => 'required|string|max:50',
                'label' => 'required|string|max:100',
            ]
        );

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

        return redirect()
            ->back()
            ->with('success', true);
    }

    public function deleteStatFromProject($statId)
    {
        $stat = ProjectStat::findOrFail($statId);

        $stat->delete();

        return redirect()
            ->back()
            ->with('success', true);
    }

    public function addGalleryToProject(
        Request $request,
        $projectId
    ) {
        $validator = Validator::make(
            $request->all(),
            [
                'cat_img_id' => 'required|exists:cat_imgs,id',
                'image_url' => 'required|string|max:255',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'success' => false
            ], 422);
        }

        ProjectGallery::create([
            'project_id' => $projectId,
            'cat_img_id' => $request->input('cat_img_id'),
            'image_url' => $request->input('image_url'),
        ]);

        return redirect()
            ->back()
            ->with('success', true);
    }

    public function deleteGalleryFromProject($galleryId)
    {
        $gallery = ProjectGallery::findOrFail($galleryId);

        if ($gallery->image_url) {
            $galleryPath = public_path(
                $gallery->image_url
            );

            if (file_exists($galleryPath)) {
                @unlink($galleryPath);
            }
        }

        $gallery->delete();

        return redirect()
            ->back()
            ->with('success', true);
    }
}