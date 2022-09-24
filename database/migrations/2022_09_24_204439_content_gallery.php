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
        Schema::create('content_gallery', function (Blueprint $table) {
            $table->id();
                $table->unsignedBigInteger('content_id');
            $table->string('image_url')->nullable();
            $table->text('image_order')->nullable();
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();

            $table->foreign('content_id')->references('id')->on('contents');
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
