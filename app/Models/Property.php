<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
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
    ];

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }
}
