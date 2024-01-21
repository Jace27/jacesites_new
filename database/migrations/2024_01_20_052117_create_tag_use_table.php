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
        Schema::create('dreamdiary_tag_use', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tag_id');
            $table->unsignedBigInteger('uses')->default(0);
            $table->timestamps();
        });
        Schema::table('dreamdiary_tag_use', function (Blueprint $table) {
            $table->foreign('tag_id')
                ->references('id')->on('dreamdiary_tags')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dreamdiary_tag_use');
    }
};
