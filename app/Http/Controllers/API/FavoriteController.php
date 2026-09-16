<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        $favorites = $request->user()
            ->favoriteProperties()
            ->with(['user', 'images'])
            ->latest('property_user.created_at')
            ->paginate(10);
        
        return response()->json([
            'success' => true,
            'data'  =>  $favorites
        ]);
    }


    public function toggle(Property $property, Request $request)
    {
        $result = $request->user()->favoriteProperties()->toggle($property->id);

        $isFavorited = count($result['attached']) > 0;

        return response()->json([
            'success' => true,
            'message' => $isFavorited ? 'Property added to favorites.' : 'Property removed from favorites.',
            'is_favorited' => $isFavorited
        ]);
        
    }
}
