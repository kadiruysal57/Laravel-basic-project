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
            $table->string('title',255)->nullable();
            $table->string('short_desc',255)->nullable();
            $table->unsignedBigInteger('language_id')->default(1);
            $table->text('description')->nullable();
            $table->string('main_photo',255)->nullable();
            $table->string('preview_photo',255)->nullable();
            $table->text('css_iframe')->nullable();
            $table->text('js_iframe')->nullable();
            $table->string('seo_title',255)->nullable();
            $table->text('keywords')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('focus_keywords',255)->nullable();
            $table->string('seo_url',255)->nullable();
            $table->integer('lock_page')->default(2);
            $table->integer('status')->default(1);
            $table->integer('left_blok_active')->default(1);
            $table->integer('right_blok_active')->default(1);
            $table->unsignedBigInteger('default_blok_id')->nullable();
            $table->unsignedBigInteger('slider_id')->nullable();
            $table->unsignedBigInteger('gallery_id')->nullable();
            $table->unsignedBigInteger('form_id')->nullable();
            $table->unsignedBigInteger('faq_id')->nullable();
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->foreign('default_blok_id')->references('id')->on('default_blok');
            $table->foreign('language_id')->references('id')->on('language');
            $table->foreign('gallery_id')->references('id')->on('gallery');
            $table->foreign('slider_id')->references('id')->on('slider');
            $table->foreign('form_id')->references('id')->on('form');
            $table->foreign('faq_id')->references('id')->on('faq_category');
            $table->timestamps();
        });
        DB::table('contents')->insert(
            array(
                'name' => 'Anasayfa',
                'title' => 'Biz Kimiz?',
                'short_desc' => "Daha Fazla Bilgi İçin",
                'language_id' => "1",
                'description' => '<div class="content ps-0 ps-lg-5">
                                <p><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</em></p>

                                <ul>
                                    <li><em>Ullamco laboris nisi ut aliquip ex ea commodo consequat.</em></li>
                                    <li><em>Duis aute irure dolor in reprehenderit in voluptate velit.</em></li>
                                    <li><em>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</em></li>
                                </ul>

                                <p><em>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident</em></p>

                                <div class="mt-4 position-relative"><em><img alt="" class="img-fluid" src="assets/img/about-2.jpg" /></em></div>
                                </div>',
                'seo_url'=>'/',
                'lock_page'=>2,
                'status'=>1,
                'left_blok_active'=>2,
                'right_blok_active'=>2,
                'default_blok_id'=>null,
                'slider_id'=>1,
                'add_user'=>1
            )
        );

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
