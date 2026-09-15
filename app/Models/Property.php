<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
