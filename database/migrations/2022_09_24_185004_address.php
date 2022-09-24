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
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('site_settings_id');
            $table->string('name')->nullable();
            $table->text('address')->nullable();
            $table->text('gsm')->nullable();
            $table->string('email')->nullable();
            $table->text('maps')->nullable();
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();

            $table->foreign('site_id')->references('id')->on('site_settings');
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
