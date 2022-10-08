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
        Schema::create('gallery_image', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gallery_id');
            $table->string('url')->nullable();
            $table->integer('image_order')->nullable();
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();
            $table->foreign('gallery_id')->references('id')->on('gallery');

        });
        DB::table('gallery_image')->insert(
            array(
                'gallery_id' => 1,
                'url' => "/storage/photos/shares/gallery-1.jpg",
                'image_order' => 1,
                'add_user'=>1,
            )
        );
        DB::table('gallery_image')->insert(
            array(
                'gallery_id' => 1,
                'url' => "/storage/photos/shares/gallery-2.jpg",
                'image_order' => 2,
                'add_user'=>1,
            )
        );
        DB::table('gallery_image')->insert(
            array(
                'gallery_id' => 1,
                'url' => "/storage/photos/shares/gallery-3.jpg",
                'image_order' => 3,
                'add_user'=>1,
            )
        );
        DB::table('gallery_image')->insert(
            array(
                'gallery_id' => 1,
                'url' => "/storage/photos/shares/gallery-4.jpg",
                'image_order' => 4,
                'add_user'=>1,
            )
        );
        DB::table('gallery_image')->insert(
            array(
                'gallery_id' => 1,
                'url' => "/storage/photos/shares/gallery-5.jpg",
                'image_order' => 5,
                'add_user'=>1,
            )
        );
        DB::table('gallery_image')->insert(
            array(
                'gallery_id' => 1,
                'url' => "/storage/photos/shares/gallery-6.jpg",
                'image_order' =>6,
                'add_user'=>1,
            )
        );
        DB::table('gallery_image')->insert(
            array(
                'gallery_id' => 1,
                'url' => "/storage/photos/shares/gallery-7.jpg",
                'image_order' =>7,
                'add_user'=>1,
            )
        );
        DB::table('gallery_image')->insert(
            array(
                'gallery_id' => 1,
                'url' => "/storage/photos/shares/gallery-8.jpg",
                'image_order' =>8,
                'add_user'=>1,
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
        //
    }
};
