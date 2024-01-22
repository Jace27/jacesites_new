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
        Schema::create('map_locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('image_id');
            $table->double('x');
            $table->double('y');
            $table->double('w');
            $table->double('h');
            $table->integer('r');
            $table->integer('z');
            $table->timestamps();
        });
        Schema::table('map_locations', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('image_id')->references('id')->on('dreamdiary_record_images');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('map_locations', function (Blueprint $table) {
            $table->dropForeign('map_locations_user_id_foreign');
            $table->dropForeign('map_locations_image_id_foreign');
        });
        Schema::dropIfExists('map_locations');
    }
};
