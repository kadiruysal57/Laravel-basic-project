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
        Schema::create('content_blok_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('main_blok_id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('content_id');
            $table->unsignedBigInteger('blok_files_id');
            $table->integer('blok_file_order')->default(0);
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();
            $table->foreign('main_blok_id')->references('id')->on('main_blok');
            $table->foreign('group_id')->references('id')->on('blok_groups');
            $table->foreign('content_id')->references('id')->on('contents');
            $table->foreign('blok_files_id')->references('id')->on('blok_files');

        });
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
