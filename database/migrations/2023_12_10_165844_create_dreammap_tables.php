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
        Schema::create('dreams_locations_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });
        Schema::create('dreams_locations', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->longText('description');
            $table->string('map_coords')->nullable();
            $table->string('map_shape')->nullable();
            $table->timestamps();
        });
        Schema::create('dreams_locations_dreams_locations_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('type_id');
        });
        Schema::table('dreams_locations_dreams_locations_types', function (Blueprint $table) {
            $table->foreign('location_id')
                ->references('id')->on('dreams_locations')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('type_id')
                ->references('id')->on('dreams_locations_types')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dreams_locations_dreams_locations_types');
        Schema::dropIfExists('dreams_locations');
        Schema::dropIfExists('dreammap_tables');
    }
};
