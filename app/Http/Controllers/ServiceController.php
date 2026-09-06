<?php

namespace App\Http\Controllers;

use App\Models\Services;
use App\Models\ServiceState;
use App\Models\ServiceWhatReceive;
use App\Models\ServiceTech;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $services = Services::orderBy('number', 'asc')
            ->paginate(10);

        return view('admin.pages.index', compact('services'));
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view('admin.pages.create');
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([

            /*
            |--------------------------------------------------------------------------
            | Service
            |--------------------------------------------------------------------------
            */

            'title' => 'required|string|max:255',
            'text' => 'nullable|string',
            'description' => 'nullable|string',

            'delivery_time' => 'nullable|string|max:255',
            'price_text' => 'nullable|string|max:255',
            'support' => 'nullable|string|max:255',

            'suitable_for' => 'nullable|string',
            'contract' => 'nullable|string',

            /*
            | فقط یک فیلد برای معرفی
            */

            'overview' => 'nullable|string',

            'challenge_title' => 'nullable|string|max:255',
            'challenge_text' => 'nullable|string',

            'solution_title' => 'nullable|string|max:255',
            'solution_text' => 'nullable|string',

            'quote_text' => 'nullable|string',
            'quote_person' => 'nullable|string|max:255',
            'quote_role' => 'nullable|string|max:255',

            'cta_title' => 'nullable|string|max:255',
            'cta_text' => 'nullable|string',

            /*
            |--------------------------------------------------------------------------
            | Image / Icon
            |--------------------------------------------------------------------------
            */

            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'icon' => 'nullable|string|max:100',
            'number' => 'nullable|integer',

            /*
            |--------------------------------------------------------------------------
            | State
            |--------------------------------------------------------------------------
            */

            'state_text_1' => 'nullable|string|max:255',
            'state_value_1' => 'nullable|string|max:255',

            'state_text_2' => 'nullable|string|max:255',
            'state_value_2' => 'nullable|string|max:255',

            'state_text_3' => 'nullable|string|max:255',
            'state_value_3' => 'nullable|string|max:255',

            'state_text_4' => 'nullable|string|max:255',
            'state_value_4' => 'nullable|string|max:255',

            /*
            |--------------------------------------------------------------------------
            | What Receive
            |--------------------------------------------------------------------------
            */

            'what_receive' => 'nullable|array',

            'what_receive.*.title' => 'nullable|string|max:255',
            'what_receive.*.text' => 'nullable|string',
            'what_receive.*.icon' => 'nullable|string|max:100',
            'what_receive.*.number' => 'nullable|integer',

            /*
            |--------------------------------------------------------------------------
            | Technologies
            |--------------------------------------------------------------------------
            */

            'techs' => 'nullable|array',

            'techs.*.text' => 'nullable|string|max:255',
            'techs.*.icon' => 'nullable|string|max:100',
            'techs.*.number' => 'nullable|integer',
        ]);


        DB::beginTransaction();

        try {

            /*
            |--------------------------------------------------------------------------
            | Image
            |--------------------------------------------------------------------------
            */

            $imageUrl = null;

            if ($request->hasFile('image')) {

                $imageUrl = $request
                    ->file('image')
                    ->store('services', 'public');
            }


            /*
            |--------------------------------------------------------------------------
            | Service
            |--------------------------------------------------------------------------
            */

            $service = new Services();

            $service->title = $validated['title'];
            $service->text = $validated['text'] ?? null;
            $service->description = $validated['description'] ?? null;

            $service->delivery_time = $validated['delivery_time'] ?? null;
            $service->price_text = $validated['price_text'] ?? null;
            $service->support = $validated['support'] ?? null;

            $service->suitable_for = $validated['suitable_for'] ?? null;
            $service->contract = $validated['contract'] ?? null;

            /*
            | معرفی خدمت
            */

            $service->overview = $validated['overview'] ?? null;

            /*
            | Challenge
            */

            $service->challenge_title = $validated['challenge_title'] ?? null;
            $service->challenge_text = $validated['challenge_text'] ?? null;

            /*
            | Solution
            */

            $service->solution_title = $validated['solution_title'] ?? null;
            $service->solution_text = $validated['solution_text'] ?? null;

            /*
            | Quote
            */

            $service->quote_text = $validated['quote_text'] ?? null;
            $service->quote_person = $validated['quote_person'] ?? null;
            $service->quote_role = $validated['quote_role'] ?? null;

            /*
            | CTA
            */

            $service->cta_title = $validated['cta_title'] ?? null;
            $service->cta_text = $validated['cta_text'] ?? null;

            /*
            | Image / Icon
            */

            $service->image_url = $imageUrl;
            $service->icon = $validated['icon'] ?? null;
            $service->number = $validated['number'] ?? 0;

            /*
            | اگر تصویر وجود دارد، آیکون ذخیره نشود
            */

            if ($imageUrl) {
                $service->icon = null;
            }

            $service->save();


            /*
            |--------------------------------------------------------------------------
            | State
            |--------------------------------------------------------------------------
            */

            $hasState =
                !empty($validated['state_text_1']) ||
                !empty($validated['state_value_1']) ||
                !empty($validated['state_text_2']) ||
                !empty($validated['state_value_2']) ||
                !empty($validated['state_text_3']) ||
                !empty($validated['state_value_3']) ||
                !empty($validated['state_text_4']) ||
                !empty($validated['state_value_4']);


            if ($hasState) {

                $state = new ServiceState();

                $state->service_id = $service->id;

                $state->text_1 = $validated['state_text_1'] ?? null;
                $state->value_1 = $validated['state_value_1'] ?? null;

                $state->text_2 = $validated['state_text_2'] ?? null;
                $state->value_2 = $validated['state_value_2'] ?? null;

                $state->text_3 = $validated['state_text_3'] ?? null;
                $state->value_3 = $validated['state_value_3'] ?? null;

                $state->text_4 = $validated['state_text_4'] ?? null;
                $state->value_4 = $validated['state_value_4'] ?? null;

                $state->save();
            }


            /*
            |--------------------------------------------------------------------------
            | What Receive
            |--------------------------------------------------------------------------
            */

            if (!empty($validated['what_receive'])) {

                foreach ($validated['what_receive'] as $index => $item) {

                    if (
                        empty($item['title']) &&
                        empty($item['text']) &&
                        empty($item['icon'])
                    ) {
                        continue;
                    }

                    $whatReceive = new ServiceWhatReceive();

                    $whatReceive->service_id = $service->id;
                    $whatReceive->title = $item['title'] ?? null;
                    $whatReceive->text = $item['text'] ?? null;
                    $whatReceive->icon = $item['icon'] ?? null;
                    $whatReceive->number = $item['number'] ?? $index;

                    $whatReceive->save();
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Technologies
            |--------------------------------------------------------------------------
            */

            if (!empty($validated['techs'])) {

                foreach ($validated['techs'] as $index => $item) {

                    if (
                        empty($item['text']) &&
                        empty($item['icon'])
                    ) {
                        continue;
                    }

                    $serviceTech = new ServiceTech();

                    $serviceTech->service_id = $service->id;
                    $serviceTech->text = $item['text'] ?? null;
                    $serviceTech->icon = $item['icon'] ?? null;
                    $serviceTech->number = $item['number'] ?? $index;

                    $serviceTech->save();
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Commit
            |--------------------------------------------------------------------------
            */

            DB::commit();

            return redirect()
                ->route('pages.index')
                ->with('success', 'خدمت با موفقیت ایجاد شد.');

        } catch (\Throwable $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors([
                    'error' => $e->getMessage()
                ]);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $service = Services::findOrFail($id);

        $state = ServiceState::where('service_id', $service->id)
            ->first();

        $whatReceives = ServiceWhatReceive::where(
                'service_id',
                $service->id
            )
            ->orderBy('number', 'asc')
            ->get();

        $techs = ServiceTech::where(
                'service_id',
                $service->id
            )
            ->orderBy('number', 'asc')
            ->get();

        return view('admin.pages.edit', compact(
            'service',
            'state',
            'whatReceives',
            'techs'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $validated = $request->validate([

            /*
            |--------------------------------------------------------------------------
            | Service
            |--------------------------------------------------------------------------
            */

            'title' => 'required|string|max:255',
            'text' => 'nullable|string',
            'description' => 'nullable|string',

            'delivery_time' => 'nullable|string|max:255',
            'price_text' => 'nullable|string|max:255',
            'support' => 'nullable|string|max:255',

            'suitable_for' => 'nullable|string',
            'contract' => 'nullable|string',

            /*
            | فقط overview
            */

            'overview' => 'nullable|string',

            'challenge_title' => 'nullable|string|max:255',
            'challenge_text' => 'nullable|string',

            'solution_title' => 'nullable|string|max:255',
            'solution_text' => 'nullable|string',

            'quote_text' => 'nullable|string',
            'quote_person' => 'nullable|string|max:255',
            'quote_role' => 'nullable|string|max:255',

            'cta_title' => 'nullable|string|max:255',
            'cta_text' => 'nullable|string',

            /*
            |--------------------------------------------------------------------------
            | Image / Icon
            |--------------------------------------------------------------------------
            */

            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:2048',
            'icon' => 'nullable|string|max:100',
            'number' => 'nullable|integer',

            /*
            |--------------------------------------------------------------------------
            | State
            |--------------------------------------------------------------------------
            */

            'state_text_1' => 'nullable|string|max:255',
            'state_value_1' => 'nullable|string|max:255',

            'state_text_2' => 'nullable|string|max:255',
            'state_value_2' => 'nullable|string|max:255',

            'state_text_3' => 'nullable|string|max:255',
            'state_value_3' => 'nullable|string|max:255',

            'state_text_4' => 'nullable|string|max:255',
            'state_value_4' => 'nullable|string|max:255',

            /*
            |--------------------------------------------------------------------------
            | What Receive
            |--------------------------------------------------------------------------
            */

            'what_receive' => 'nullable|array',

            'what_receive.*.title' => 'nullable|string|max:255',
            'what_receive.*.text' => 'nullable|string',
            'what_receive.*.icon' => 'nullable|string|max:100',
            'what_receive.*.number' => 'nullable|integer',

            /*
            |--------------------------------------------------------------------------
            | Technologies
            |--------------------------------------------------------------------------
            */

            'techs' => 'nullable|array',

            'techs.*.text' => 'nullable|string|max:255',
            'techs.*.icon' => 'nullable|string|max:100',
            'techs.*.number' => 'nullable|integer',
        ]);


        DB::beginTransaction();

        try {

            $service = Services::findOrFail($id);


            /*
            |--------------------------------------------------------------------------
            | Image / Icon
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('image')) {

                if (
                    $service->image_url &&
                    Storage::disk('public')->exists($service->image_url)
                ) {
                    Storage::disk('public')->delete(
                        $service->image_url
                    );
                }

                $service->image_url = $request
                    ->file('image')
                    ->store('services', 'public');

                $service->icon = null;

            } elseif (!empty($validated['icon'])) {

                if (
                    $service->image_url &&
                    Storage::disk('public')->exists($service->image_url)
                ) {
                    Storage::disk('public')->delete(
                        $service->image_url
                    );
                }

                $service->image_url = null;
                $service->icon = $validated['icon'];

            }


            /*
            |--------------------------------------------------------------------------
            | Service
            |--------------------------------------------------------------------------
            */

            $service->title = $validated['title'];
            $service->text = $validated['text'] ?? null;
            $service->description = $validated['description'] ?? null;

            $service->delivery_time =
                $validated['delivery_time'] ?? null;

            $service->price_text =
                $validated['price_text'] ?? null;

            $service->support =
                $validated['support'] ?? null;

            $service->suitable_for =
                $validated['suitable_for'] ?? null;

            $service->contract =
                $validated['contract'] ?? null;


            /*
            |--------------------------------------------------------------------------
            | Overview
            |--------------------------------------------------------------------------
            */

            $service->overview =
                $validated['overview'] ?? null;


            /*
            |--------------------------------------------------------------------------
            | Challenge
            |--------------------------------------------------------------------------
            */

            $service->challenge_title =
                $validated['challenge_title'] ?? null;

            $service->challenge_text =
                $validated['challenge_text'] ?? null;


            /*
            |--------------------------------------------------------------------------
            | Solution
            |--------------------------------------------------------------------------
            */

            $service->solution_title =
                $validated['solution_title'] ?? null;

            $service->solution_text =
                $validated['solution_text'] ?? null;


            /*
            |--------------------------------------------------------------------------
            | Quote
            |--------------------------------------------------------------------------
            */

            $service->quote_text =
                $validated['quote_text'] ?? null;

            $service->quote_person =
                $validated['quote_person'] ?? null;

            $service->quote_role =
                $validated['quote_role'] ?? null;


            /*
            |--------------------------------------------------------------------------
            | CTA
            |--------------------------------------------------------------------------
            */

            $service->cta_title =
                $validated['cta_title'] ?? null;

            $service->cta_text =
                $validated['cta_text'] ?? null;


            $service->number =
                $validated['number'] ?? 0;


            $service->save();


            /*
            |--------------------------------------------------------------------------
            | State
            |--------------------------------------------------------------------------
            */

            $hasState =
                !empty($validated['state_text_1']) ||
                !empty($validated['state_value_1']) ||
                !empty($validated['state_text_2']) ||
                !empty($validated['state_value_2']) ||
                !empty($validated['state_text_3']) ||
                !empty($validated['state_value_3']) ||
                !empty($validated['state_text_4']) ||
                !empty($validated['state_value_4']);


            $state = ServiceState::where(
                'service_id',
                $service->id
            )->first();


            if ($hasState) {

                if (!$state) {

                    $state = new ServiceState();

                    $state->service_id = $service->id;
                }

                $state->text_1 =
                    $validated['state_text_1'] ?? null;

                $state->value_1 =
                    $validated['state_value_1'] ?? null;

                $state->text_2 =
                    $validated['state_text_2'] ?? null;

                $state->value_2 =
                    $validated['state_value_2'] ?? null;

                $state->text_3 =
                    $validated['state_text_3'] ?? null;

                $state->value_3 =
                    $validated['state_value_3'] ?? null;

                $state->text_4 =
                    $validated['state_text_4'] ?? null;

                $state->value_4 =
                    $validated['state_value_4'] ?? null;

                $state->save();

            } elseif ($state) {

                $state->delete();
            }


            /*
            |--------------------------------------------------------------------------
            | What Receive
            |--------------------------------------------------------------------------
            */

            ServiceWhatReceive::where(
                'service_id',
                $service->id
            )->delete();


            if (!empty($validated['what_receive'])) {

                foreach (
                    $validated['what_receive']
                    as $index => $item
                ) {

                    if (
                        empty($item['title']) &&
                        empty($item['text']) &&
                        empty($item['icon'])
                    ) {
                        continue;
                    }

                    $whatReceive = new ServiceWhatReceive();

                    $whatReceive->service_id =
                        $service->id;

                    $whatReceive->title =
                        $item['title'] ?? null;

                    $whatReceive->text =
                        $item['text'] ?? null;

                    $whatReceive->icon =
                        $item['icon'] ?? null;

                    $whatReceive->number =
                        $item['number'] ?? $index;

                    $whatReceive->save();
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Technologies
            |--------------------------------------------------------------------------
            */

            ServiceTech::where(
                'service_id',
                $service->id
            )->delete();


            if (!empty($validated['techs'])) {

                foreach (
                    $validated['techs']
                    as $index => $item
                ) {

                    if (
                        empty($item['text']) &&
                        empty($item['icon'])
                    ) {
                        continue;
                    }

                    $serviceTech = new ServiceTech();

                    $serviceTech->service_id =
                        $service->id;

                    $serviceTech->text =
                        $item['text'] ?? null;

                    $serviceTech->icon =
                        $item['icon'] ?? null;

                    $serviceTech->number =
                        $item['number'] ?? $index;

                    $serviceTech->save();
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Commit
            |--------------------------------------------------------------------------
            */

            DB::commit();

            return redirect()
                ->route('pages.index')
                ->with(
                    'success',
                    'خدمت با موفقیت بروزرسانی شد.'
                );

        } catch (\Throwable $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors([
                    'error' => $e->getMessage()
                ]);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $service = Services::findOrFail($id);


        if (
            $service->image_url &&
            Storage::disk('public')->exists(
                $service->image_url
            )
        ) {
            Storage::disk('public')->delete(
                $service->image_url
            );
        }


        /*
        |--------------------------------------------------------------------------
        | حذف اطلاعات وابسته
        |--------------------------------------------------------------------------
        */

        ServiceState::where(
            'service_id',
            $service->id
        )->delete();

        ServiceWhatReceive::where(
            'service_id',
            $service->id
        )->delete();

        ServiceTech::where(
            'service_id',
            $service->id
        )->delete();


        $service->delete();


        return redirect()
            ->route('pages.index')
            ->with(
                'success',
                'خدمت با موفقیت حذف شد.'
            );
    }
}