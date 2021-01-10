<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('image')->nullable();
            $table->string('link')->nullable();
            $table->string('date')->nullable();
            $table->integer('main_news')->nullable();
            $table->string('home')->nullable();
            $table->string('publish')->nullable();
            $table->integer('feature')->nullable();
            $table->string('image_link')->nullable();
            $table->string('banner1')->nullable();
            $table->string('banner2')->nullable();
            $table->string('reporter')->nullable();
            $table->string('edited_by')->nullable();
            $table->unsignedBigInteger('tag_id')->nullable();
            
            $table->integer('view')->nullable();
            $table->index('created_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
