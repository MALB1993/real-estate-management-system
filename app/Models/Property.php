<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_type_id',
        'title',
        'description',
        'price',
        'area',
        'bedrooms',
        'bathrooms',
        'address',
        'city',
        'state',
        'user_id'
    ];

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function images(): HasMany
    {
        return $this->hasMany(PropertyImage::class);
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query
            ->when($filters['search'] ?? null, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($filters['price_min'] ?? null, function ($query, $priceMin) {
                $query->where('price', '>=', $priceMin);
            })
            ->when($filters['price_max'] ?? null, function ($query, $priceMax) {
                $query->where('price', '<=', $priceMax);
            })
            ->when($filters['property_type_id'] ?? null, function ($query, $typeId) {
                $query->where('property_type_id', $typeId);
            })
            ->when($filters['city'] ?? null, function ($query, $city) {
                $query->where('city', $city);
            });
    }

    public function favoriteProperties()
    {
        return $this->belongsToMany(User::class, 'property_user')->withTimestamps();
    }
}
