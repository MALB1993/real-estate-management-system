<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PropertyType;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // define property types
        $propertyTypes = [
            ['name' => 'Apartment'],
            ['name' => 'House'],
            ['name' => 'Condo'],
            ['name' => 'Townhouse'],
            ['name' => 'Villa'],
            ['name' => 'Studio'],
            ['name' => 'Loft'],
            ['name' => 'Duplex'],
            ['name' => 'Penthouse'],
            ['name' => 'Cottage'],
        ];

        // insert property types into the database
        foreach ($propertyTypes as $propertyType) {
            PropertyType::create($propertyType);
        }
    }
}
