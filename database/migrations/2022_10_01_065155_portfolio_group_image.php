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
        Schema::create('portfolio_group_image', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('portfolio_group_id');
            $table->string('image_url')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->integer('image_order')->nullable();
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();

            $table->foreign('portfolio_group_id')->references('id')->on('portfolio_group');

        });

        DB::table('portfolio_group_image')->insert([
            'portfolio_group_id'=>1,
            'image_url'=>'/storage/photos/shares/menu-item-1.png',
            'title'=>'Magnam Tiste',
            'description' => 'Lorem, deren, trataro, filede, nerada',
            'image_order'=>1,

            'add_user'=>1,
        ]);
        DB::table('portfolio_group_image')->insert([
            'portfolio_group_id'=>1,
            'image_url'=>'/storage/photos/shares/menu-item-2.png',
            'title'=>'Magnam Tiste',
            'description' => 'Lorem, deren, trataro, filede, nerada',
            'image_order'=>2,

            'add_user'=>1,
        ]);
        DB::table('portfolio_group_image')->insert([
            'portfolio_group_id'=>1,
            'image_url'=>'/storage/photos/shares/menu-item-3.png',
            'title'=>'Magnam Tiste',
            'description' => 'Lorem, deren, trataro, filede, nerada',
            'image_order'=>3,

            'add_user'=>1,
        ]);
        DB::table('portfolio_group_image')->insert([
            'portfolio_group_id'=>1,
            'image_url'=>'/storage/photos/shares/menu-item-4.png',
            'title'=>'Magnam Tiste',
            'description' => 'Lorem, deren, trataro, filede, nerada',
            'image_order'=>4,

            'add_user'=>1,
        ]);
        DB::table('portfolio_group_image')->insert([
            'portfolio_group_id'=>1,
            'image_url'=>'/storage/photos/shares/menu-item-5.png',
            'title'=>'Magnam Tiste',
            'description' => 'Lorem, deren, trataro, filede, nerada',
            'image_order'=>5,

            'add_user'=>1,
        ]);
        DB::table('portfolio_group_image')->insert([
            'portfolio_group_id'=>1,
            'image_url'=>'/storage/photos/shares/menu-item-6.png',
            'title'=>'Magnam Tiste',
            'description' => 'Lorem, deren, trataro, filede, nerada',
            'image_order'=>6,

            'add_user'=>1,
        ]);
        DB::table('portfolio_group_image')->insert([
            'portfolio_group_id'=>2,
            'image_url'=>'/storage/photos/shares/menu-item-1.png',
            'title'=>'Magnam Tiste',
            'description' => 'Lorem, deren, trataro, filede, nerada',
            'image_order'=>1,

            'add_user'=>1,
        ]);
        DB::table('portfolio_group_image')->insert([
            'portfolio_group_id'=>2,
            'image_url'=>'/storage/photos/shares/menu-item-2.png',
            'title'=>'Magnam Tiste',
            'description' => 'Lorem, deren, trataro, filede, nerada',
            'image_order'=>2,

            'add_user'=>1,
        ]);
        DB::table('portfolio_group_image')->insert([
            'portfolio_group_id'=>2,
            'image_url'=>'/storage/photos/shares/menu-item-3.png',
            'title'=>'Magnam Tiste',
            'description' => 'Lorem, deren, trataro, filede, nerada',
            'image_order'=>3,

            'add_user'=>1,
        ]);
        DB::table('portfolio_group_image')->insert([
            'portfolio_group_id'=>2,
            'image_url'=>'/storage/photos/shares/menu-item-4.png',
            'title'=>'Magnam Tiste',
            'description' => 'Lorem, deren, trataro, filede, nerada',
            'image_order'=>4,

            'add_user'=>1,
        ]);
        DB::table('portfolio_group_image')->insert([
            'portfolio_group_id'=>2,
            'image_url'=>'/storage/photos/shares/menu-item-5.png',
            'title'=>'Magnam Tiste',
            'description' => 'Lorem, deren, trataro, filede, nerada',
            'image_order'=>5,

            'add_user'=>1,
        ]);
        DB::table('portfolio_group_image')->insert([
            'portfolio_group_id'=>2,
            'image_url'=>'/storage/photos/shares/menu-item-6.png',
            'title'=>'Magnam Tiste',
            'description' => 'Lorem, deren, trataro, filede, nerada',
            'image_order'=>6,

            'add_user'=>1,
        ]);
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
