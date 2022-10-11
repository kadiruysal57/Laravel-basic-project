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
            $table->string('name')->nullable();
            $table->integer('required')->nullable();
            $table->integer('placeholder_use')->nullable();
            $table->string('id_attr')->nullable();
            $table->string('class_attr')->nullable();
            $table->string('placeholder')->nullable();
            $table->integer('status')->nullable();
            $table->integer('active_passive')->nullable();
            $table->integer('order_input')->nullable();
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
                'name' => 'name_surname',
                'required' => 1,
                'placeholder_use' => 2,
                'id_attr' => 'name_surname',
                'class_attr' => '',
                'placeholder'=>'Adınız',
                'status' => 1,
                'active_passive' => 1,
                'order_input' => 1,
                'add_user' => 1,
                'update_user' => 1
            )
        );

        DB::table('form_input')->insert(
            array(
                'input_id' => 4,
                'form_id' => 1,
                'name' => 'email',
                'required' => 1,
                'placeholder_use' => 2,
                'id_attr' => 'email',
                'class_attr' => '',
                'placeholder'=>'Email',
                'status' => 1,
                'active_passive' => 1,
                'order_input' => 2,
                'add_user' => 1,
                'update_user' => 1
            )
        );

        DB::table('form_input')->insert(
            array(
                'input_id' => 2,
                'form_id' => 1,
                'name' => 'phone',
                'required' => 1,
                'placeholder_use' => 2,
                'id_attr' => 'number',
                'class_attr' => '',
                'placeholder'=>'Telefonunuz',
                'status' => 1,
                'active_passive' => 1,
                'order_input' => 3,
                'add_user' => 1,
                'update_user' => 1
            )
        );
        DB::table('form_input')->insert(
            array(
                'input_id' => 7,
                'form_id' => 1,
                'name' => 'date',
                'required' => 1,
                'placeholder_use' => 2,
                'id_attr' => 'date',
                'class_attr' => 'col-lg-6',
                'placeholder'=>'Tarih',
                'status' => 1,
                'active_passive' => 1,
                'order_input' => 4,
                'add_user' => 1,
                'update_user' => 1
            )
        );
        DB::table('form_input')->insert(
            array(
                'input_id' => 5,
                'form_id' => 1,
                'name' => 'message',
                'required' => 1,
                'placeholder_use' => 2,
                'id_attr' => 'message',
                'class_attr' => 'col-lg-12',
                'placeholder'=>'Mesajınız',
                'status' => 1,
                'active_passive' => 1,
                'order_input' => 6,
                'add_user' => 1,
                'update_user' => 1
            )
        );
        DB::table('form_input')->insert(
            array(
                'input_id' => 8,
                'form_id' => 1,
                'name' => 'time',
                'required' => 1,
                'placeholder_use' => 2,
                'id_attr' => 'time',
                'class_attr' => 'col-lg-6',
                'placeholder'=>'Saat',
                'status' => 1,
                'active_passive' => 1,
                'order_input' => 5,
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
