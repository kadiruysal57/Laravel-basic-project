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
        Schema::create('slider', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->integer('status');
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();


        });

        DB::table('slider')->insert(
            array(
                'name' => 'Anasayfa Slider',
                'title' => 'Anasayfa Slider',
                'description' => 'Anasayfa Slider',
                'status' => 1,
                'add_user' => 1,
                'update_user' => 1,
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
        Schema::dropIfExists('slider');
    }
};
