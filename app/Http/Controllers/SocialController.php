<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Images;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Storage;

class socialController extends Controller
{
    public function create(Request $request){
        $validated_data = $request->validate([
            'name'=> 'required|string',
            'image_url'=> 'string',
            'url'=> 'required|string',
        ]);


        if( Images::where('image_url', $request->image_url)->exists() ){
            Images::where('image_url', $request->image_url)->delete();
        }

        if($request->hasFile('image_url')){
            if($request->file('image_url')->isValid()
                   && $request->image_url && Storage::disk('public')->exists($request->image_url))
             {
                Storage::disk('public')->delete($request->image_url);
             }

             $path = $request->file('image_url')->store('images','public');
        }
        
        $validated_data['image_url'] = $path ?? null;
        Images::create($validated_data);

        return response()->json(['success'=>true, 'message'=>'Social created successfully'], 201);
    }
}
