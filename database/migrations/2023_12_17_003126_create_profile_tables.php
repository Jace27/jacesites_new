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
        Schema::create('option_pages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });

        Schema::create('options', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('input_attrs')->default('type="text"');
            $table->unsignedBigInteger('type');
            $table->unsignedBigInteger('page_id');
            $table->timestamps();
        });
        Schema::table('options', function (Blueprint $table) {
            $table->foreign('page_id')
                ->references('id')->on('option_pages')
                ->onUpdate('restrict')->onDelete('restrict');
        });

        Schema::create('options_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('option_id');
            $table->longText('value');
            $table->boolean('hidden')->default(false);
            $table->timestamps();
        });
        Schema::table('options_values', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('option_id')
                ->references('id')->on('options')
                ->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('options_values');
        Schema::dropIfExists('options');
        Schema::dropIfExists('option_pages');
        Schema::dropIfExists('option_types');
    }
};
