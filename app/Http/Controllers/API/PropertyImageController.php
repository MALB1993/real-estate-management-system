<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoragePropertyRequest;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\API\PropertyImageResource;

class PropertyImageController extends Controller
{
    public function store(StoragePropertyRequest $request, Property $property)
    {
        Gate::authorize('update', $property);

        $uploadedImages = [];

        foreach ($request->file('images') as $imageFile) {
            $path = $imageFile->store('properties', 'public');

            $uploadedImages[] = $property->images()->create([
                'image_path' => $path
            ]);
        }

        return response()->json([
            'success'   =>  true,
            'message'   =>  'Images uploaded successfully.',
            'data' => PropertyImageResource::collection($uploadedImages),
        ], 201);
    }

    public function destroy(Property $property, PropertyImage $image)
    {
        Gate::authorize('update', $property);

        if ($image->property_id !== $property->id) {
            return response()->json([
                'success' => false,
                'message' => 'Image does not belong to this property.',
            ], 400);
        }

        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return response()->json([
            'success' => true,
            'message' => 'Image deleted successfully.',
        ]);
    }
}
