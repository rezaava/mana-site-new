<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Services;
use App\Models\Images;

class ServiceController extends Controller
{
    public function createService(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'text' => 'nullable|string',
            'image_url' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $service = Services::create($request->only(['title', 'text', 'image_url']));

        return response()->json(['message' => 'Service created successfully', 'success' => true], 201);
    }
    
    public function updateService(Request $request, $id)
    {
        $service = Services::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'string|max:100',
            'text' => 'nullable|string',
            'image_url' => 'nullable|url',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $service->update($request->only(['title', 'text', 'image_url']));

        return response()->json(['message' => 'Service updated successfully', 'success' => true], 200);
    }

    public function deleteService($id)
    {
        $service = Services::findOrFail($id);

        if (!$service) {
            return response()->json(['message' => 'Service not found', 'success' => false], 404);
        }

        $service->delete();

        return response()->json(['message' => 'Service deleted successfully', 'success' => true], 200);
    }

    public function getAllServices()
    {
        $services = Services::all();

        return response()->json(['services' => $services, 'success' => true], 200);
    }

    public function changeNumber(Request $request, $id)
    {
        $service = Services::findOrFail($id);

        if (!$service) {
            return response()->json(['message' => 'Service not found', 'success' => false], 404);
        }

        $validatedData = $request->validate([
            'number' => 'required|integer',
        ]);

        $service->number = $validatedData['number'];
        $service->save();

        return response()->json(['message' => 'Service number updated successfully', 'success' => true], 200);
    }

    public function changeImage(Request $request, $id)
    {
        $service = Services::findOrFail($id);

        if (!$service) {
            return response()->json(['message' => 'Service not found', 'success' => false], 404);
        }

        $validatedData = $request->validate([
            'image_url' => 'required|url',
        ]);

        $service->image_url = $validatedData['image_url'];
        $service->save();

        return response()->json(['message' => 'Service image updated successfully', 'success' => true], 200);
    }
}
