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
        Schema::create('services_list', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('services_id');
            $table->text('url')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('link');
            $table->integer('status');
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();
            $table->foreign('services_id')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services_list');
    }
};
