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
        Schema::create('kk_notes', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->longText('content');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
        Schema::create('kk_notes_redirects', function (Blueprint $table) {
            $table->id();
            $table->string('old_link');
            $table->string('new_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kk_notes_redirects');
        Schema::dropIfExists('kk_notes');
    }
};
