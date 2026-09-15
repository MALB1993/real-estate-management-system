<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();

            $table->foreignId('property_type_id')
                ->constrained('property_types')
                ->onDelete('cascade');

            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('title');
            $table->text('description');

            $table->decimal('price', 15, 2);
            $table->decimal('area', 10, 2);

            $table->unsignedInteger('bedrooms');
            $table->unsignedInteger('bathrooms');

            $table->text('address');
            $table->string('city');

            $table->string('state');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
