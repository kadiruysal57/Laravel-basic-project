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
        Schema::create('form_input_value', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_input_id');
            $table->string('default_value')->nullable();
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();
            $table->foreign('form_input_id')->references('id')->on('form_input');
        });

        DB::table('form_input_value')->insert(
            array(
                'form_input_id'=> 1,
                'default_value' => "deneme1",
                'add_user' => 1,
                'update_user' => 1
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
        Schema::dropIfExists('form_input_value');
    }
};
