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
            $table->integer('lang');
            $table->text('description');
            $table->string('main_photo',255);
            $table->string('preview_photo',255);
            $table->text('css_iframe');
            $table->text('js_iframe');
            $table->string('seo_title',255);
            $table->text('keywords');
            $table->text('seo_description');
            $table->string('focus_keywords',255);
            $table->string('seo_url',255);
            $table->integer('lock_page')->default(2);
            $table->integer('status')->default(1);
            $table->integer('add_user');
            $table->integer('update_user')->nullable();

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
