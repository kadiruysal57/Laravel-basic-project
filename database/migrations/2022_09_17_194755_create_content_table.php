<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->string('title',255);
            $table->string('short_desc',255);
            $table->unsignedBigInteger('language_id')->default(1);
            $table->text('description')->nullable();
            $table->string('main_photo',255)->nullable();
            $table->string('preview_photo',255)->nullable();
            $table->text('css_iframe')->nullable();
            $table->text('js_iframe')->nullable();
            $table->string('seo_title',255);
            $table->text('keywords');
            $table->text('seo_description');
            $table->string('focus_keywords',255);
            $table->string('seo_url',255);
            $table->integer('lock_page')->default(2);
            $table->integer('status')->default(1);
            $table->integer('left_blok_active')->default(1);
            $table->integer('right_blok_active')->default(1);
            $table->unsignedBigInteger('default_blok_id')->nullable();
            $table->unsignedBigInteger('slider_id')->nullable();
            $table->unsignedBigInteger('gallery_id')->nullable();
            $table->unsignedBigInteger('form_id')->nullable();
            $table->integer('add_user');
            $table->integer('update_user')->nullable();
            $table->foreign('default_blok_id')->references('id')->on('default_blok');
            $table->foreign('language_id')->references('id')->on('language');
            $table->foreign('gallery_id')->references('id')->on('gallery');
            $table->foreign('slider_id')->references('id')->on('slider');
            $table->foreign('form_id')->references('id')->on('form');
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
        Schema::dropIfExists('content');
    }
};
