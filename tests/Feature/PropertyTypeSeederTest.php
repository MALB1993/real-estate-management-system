<?php
namespace Tests\Feature;
use Tests\TestCase;
use App\Models\PropertyType;
use Database\Seeders\PropertyTypeSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PropertyTypeSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_property_type_seeder_creates_property_types()
    {
        // Run the PropertyTypeSeeder
        $this->seed(PropertyTypeSeeder::class);
        // Assert that the property types were created in the database
        $this->assertDatabaseHas('property_types', ['name' => 'Apartment']);
        $this->assertDatabaseHas('property_types', ['name' => 'House']);
        $this->assertDatabaseHas('property_types', ['name' => 'Condo']);
        $this->assertDatabaseHas('property_types', ['name' => 'Townhouse']);
        $this->assertDatabaseHas('property_types', ['name' => 'Villa']);
        $this->assertDatabaseHas('property_types', ['name' => 'Studio']);
        $this->assertDatabaseHas('property_types', ['name' => 'Loft']);
        $this->assertDatabaseHas('property_types', ['name' => 'Duplex']);
        $this->assertDatabaseHas('property_types', ['name' => 'Penthouse']);
        $this->assertDatabaseHas('property_types', ['name' => 'Cottage']);
    }
}
