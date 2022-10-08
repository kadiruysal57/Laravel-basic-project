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
        Schema::create('default_blok_file', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('main_blok_id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('default_blok_id');
            $table->unsignedBigInteger('blok_files_id');
            $table->integer('blok_file_order')->default(0);
            $table->text('html')->nullable();
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();
            $table->foreign('main_blok_id')->references('id')->on('main_blok');
            $table->foreign('group_id')->references('id')->on('blok_groups');
            $table->foreign('default_blok_id')->references('id')->on('default_blok');
            $table->foreign('blok_files_id')->references('id')->on('blok_files');

        });

        DB::table('default_blok_file')->insert(
            array(
                'main_blok_id' => 1,
                'group_id' => 1,
                'default_blok_id' => 1,
                'blok_files_id'=>1,
                'blok_file_order'=>1,
                'add_user'=>1,
            )
        );
        DB::table('default_blok_file')->insert(
            array(
                'main_blok_id' => 5,
                'group_id' => 1,
                'default_blok_id' => 1,
                'blok_files_id'=>11,
                'blok_file_order'=>1,
                'add_user'=>1,
            )
        );
        DB::table('default_blok_file')->insert(
            array(
                'main_blok_id' => 3,
                'group_id' => 3,
                'default_blok_id' => 1,
                'blok_files_id'=>9,
                'blok_file_order'=>2,
                'add_user'=>1,
            )
        );
        DB::table('default_blok_file')->insert(
            array(
                'main_blok_id' => 3,
                'group_id' => 3,
                'default_blok_id' => 1,
                'blok_files_id'=>15,
                'blok_file_order'=>1,
                'add_user'=>1,
            )
        );
        DB::table('default_blok_file')->insert(
            array(
                'main_blok_id' => 1,
                'group_id' => 1,
                'default_blok_id' => 1,
                'blok_files_id'=>16,
                'blok_file_order'=>2,
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
