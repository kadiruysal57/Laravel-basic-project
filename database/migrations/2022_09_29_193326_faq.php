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
        Schema::create('faq', function (Blueprint $table) {
            $table->id();
            $table->string('question')->nullable();
            $table->text('answer')->nullable();
            $table->unsignedBigInteger('faq_category_id')->nullable();
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();
            $table->foreign('faq_category_id')->references('id')->on('faq_category');
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
