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
        Schema::create('open_hourse', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('site_setting_id');
            $table->unsignedBigInteger('start_day');
            $table->unsignedBigInteger('finish_day');
            $table->unsignedBigInteger('office_id');
            $table->time('start_time');
            $table->time('finish_time');
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();
            $table->foreign('start_day')->references('id')->on('days');
            $table->foreign('finish_day')->references('id')->on('days');
            $table->foreign('office_id')->references('id')->on('address');
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
