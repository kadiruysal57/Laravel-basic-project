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
        Schema::create('social_media', function (Blueprint $table) {
            $table->id();
            $table->string('image')->default('/panel/assets/img/no-pictures.png')->nullable();
            $table->string('name')->nullable();
            $table->string('link')->nullable();
            $table->integer('link_target')->nullable();
            $table->unsignedBigInteger('sitesettings_id')->nullable();
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();
            $table->foreign('sitesettings_id')->references('id')->on('site_settings');

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
