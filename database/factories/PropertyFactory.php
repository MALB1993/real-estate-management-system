<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PropertyType;

/**
 * @extends Factory<Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // returning an array of fake data for the Property model
        return [
            'property_type_id'  => PropertyType::factory(),
            'title'             => fake()->sentence(3),
            'description'       => fake()->paragraph(),
            'price'             => fake()->randomFloat(2, 50000, 1000000),
            'area'              => fake()->randomFloat(2, 50, 500),
            'bedrooms'          => fake()->numberBetween(1, 3),
            'bathrooms'         => fake()->numberBetween(1, 3),
            'address'           => fake()->address(),
            'city'              => fake()->city(),
            // 'state' field is randomly assigned one of the three possible values: 'available', 'sold', or 'reserved'
            'state'             => fake()->randomElement(['available', 'sold', 'reserved']),
        ];
    }
}
