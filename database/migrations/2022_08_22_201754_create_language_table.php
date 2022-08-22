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
        Schema::create('language', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('short_name',20);
            $table->string('slug',50);
            $table->integer('status')->default(1);
            $table->integer('main_language')->default(2);
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();
        });

        DB::table('language')->insert(
            array(
                'name' => 'English',
                'short_name' => "EN",
                'slug' => 'en',
                'main_language'=>'1',
                'add_user' => '1',
                'update_user' => '1',
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
        Schema::dropIfExists('language');
    }
};
