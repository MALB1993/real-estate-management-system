<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // retrieving all properties from the database
        $properties = Property::with('user')->get();
        // returning a JSON response with the list of properties
        return response()->json([
            'data' => $properties
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyRequest $request)
    {
        $property = $request->user()->properties()->create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Property Created successfully',
            'data' => $property,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        return response()->json([
            'success' => true,
            'data' => $property->load('user:id, name, email'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyRequest $request, Property $property)
    {
        
        Gate::authorize('update', $property);

        $property->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Property updated successfully.',
            'data' => $property->fresh(),
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Property $property)
    {
        Gate::authorize('delete', $property);  

        $property->delete();

        return response()->json([
            'success' => true,
            'message' => 'Property deleted successfully.',
        ], 200);
    }
}
