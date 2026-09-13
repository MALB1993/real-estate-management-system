<?php

namespace Tests\Feature\Api\Property;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Property;


class PropertyIndexTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_properties(): void
    {
        Property::factory()->count(3)->create();
        $response = $this->getJson('/api/properties');
        $response->assertStatus(200); // Assert that the response status is 200 OK
        $response->assertJsonCount(3,'data'); // Assert that the response contains 3 properties
    }

}
