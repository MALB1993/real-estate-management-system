<?php

namespace Tests\Feature\Api\Property;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\PropertyType;

class PropertyStoreTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_property(): void
    {
        $propertyType = PropertyType::factory()->create();

        $propertyData = [
            'property_type_id'  => $propertyType->id,
            'title'             => 'Modern Apartment',
            'description'       => 'A beautiful modern apartment in the city center.',
            'price'             => 250000.00,
            'bedrooms'          => 2,
            'bathrooms'         => 1,
            'area'              => 85.5,
            'address'           => '123 Main St',
            'city'              => 'Metropolis',
            'state'             => 'available',
        ];
        $response = $this->postJson('/api/properties', $propertyData);
        $response->assertStatus(201); // Assert that the response status is 201 Created

        $this->assertDatabaseHas('properties', [
            'title' => 'Modern Apartment',
            'property_type_id' => $propertyType->id,
        ]);
    }

}
