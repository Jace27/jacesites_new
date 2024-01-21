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
        Schema::create('dreamdiary_tag_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('dreamdiary_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('group_id')->nullable();
            $table->timestamps();
        });
        Schema::table('dreamdiary_tags', function (Blueprint $table) {
            $table->foreign('group_id')
                ->references('id')->on('dreamdiary_tag_groups')
                ->onUpdate('restrict')->onDelete('restrict');
        });

        Schema::create('dreamdiary_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->date('date')->nullable();
            $table->string('title');
            $table->longText('description')->nullable(false);
            $table->boolean('hidden')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('dreamdiary_records', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('restrict')->onDelete('restrict');
        });

        Schema::create('dreamdiary_record_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('record_id');
            $table->string('filename');
            $table->timestamps();
        });
        Schema::table('dreamdiary_record_images', function (Blueprint $table) {
            $table->foreign('record_id')
                ->references('id')->on('dreamdiary_records')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('dreamdiary_records_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('record_id');
            $table->unsignedBigInteger('tag_id');
        });
        Schema::table('dreamdiary_records_tags', function (Blueprint $table) {
            $table->foreign('record_id')
                ->references('id')->on('dreamdiary_records')
                ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('dreamdiary_records_tags');
        Schema::dropIfExists('dreamdiary_record_images');
        Schema::dropIfExists('dreamdiary_records');
        Schema::dropIfExists('dreamdiary_tags');
        Schema::dropIfExists('dreamdiary_tag_groups');
    }
};
