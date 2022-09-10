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
        Schema::create('form_input', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('input_id');
            $table->unsignedBigInteger('form_id');
            $table->string('name');
            $table->integer('required')->nullable();
            $table->integer('placeholder_use')->nullable();
            $table->string('id_attr');
            $table->string('class_attr')->nullable();
            $table->string('placeholder')->nullable();
            $table->integer('status');
            $table->integer('active_passive');
            $table->integer('order_input');
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->foreign('input_id')->references('id')->on('input_type');
            $table->foreign('form_id')->references('id')->on('form');
            $table->timestamps();
        });

        DB::table('form_input')->insert(
            array(
                'input_id' => 1,
                'form_id' => 1,
                'name' => 'deneme1',
                'required' => 1,
                'placeholder_use' => 1,
                'id_attr' => 'deneme1',
                'class_attr' => 'deneme1',
                'placeholder'=>'deneme123',
                'status' => 1,
                'active_passive' => 1,
                'order_input' => 1,
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
        Schema::dropIfExists('form_input');
    }
};
