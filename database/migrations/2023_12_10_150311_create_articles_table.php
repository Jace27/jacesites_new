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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('author')->nullable();
            $table->string('title');
            $table->longText('content');
            $table->unsignedBigInteger('available_after')->nullable();
            $table->integer('ord')->default(500);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('articles_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
        Schema::table('articles_users', function (Blueprint $table) {
            $table->foreign('article_id')
                ->references('id')->on('articles')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles_users');
        Schema::dropIfExists('articles');
    }
};
