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
        Schema::create('fixed_word', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lang_id');
            $table->string('code_name')->nullable();
            $table->string('word')->nullable();
            $table->integer('lock')->default(2);
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();
            $table->foreign('lang_id')->references('id')->on('language');
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
