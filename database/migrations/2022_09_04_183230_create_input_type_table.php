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
        Schema::create('input_type', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('status');
            $table->integer('loop');
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();
        });
        DB::table('input_type')->insert(
            array(
                'name' => 'Text',
                'status' => 1,
                'loop' =>0,
                'add_user' => 1,
                'update_user' => 1,
            )
        );

        DB::table('input_type')->insert(
            array(
                'name' => 'Number',
                'status' => 1,
                'loop' =>0,
                'add_user' => 1,
                'update_user' => 1,
            )
        );

        DB::table('input_type')->insert(
            array(
                'name' => 'Selectbox',
                'status' => 1,
                'loop' =>1,
                'add_user' => 1,
                'update_user' => 1,
            )
        );
        DB::table('input_type')->insert(
            array(
                'name' => 'Email',
                'status' => 1,
                'loop' =>0,
                'add_user' => 1,
                'update_user' => 1,
            )
        );
        DB::table('input_type')->insert(
            array(
                'name' => 'Textarea',
                'status' => 1,
                'loop' =>0,
                'add_user' => 1,
                'update_user' => 1,
            )
        );
        DB::table('input_type')->insert(
            array(
                'name' => 'Checkbox',
                'status' => 1,
                'loop' =>1,
                'add_user' => 1,
                'update_user' => 1,
            )
        );
        DB::table('input_type')->insert(
            array(
                'name' => 'Date',
                'status' => 1,
                'loop' =>0,
                'add_user' => 1,
                'update_user' => 1,
            )
        );
        DB::table('input_type')->insert(
            array(
                'name' => 'Time',
                'status' => 1,
                'loop' =>0,
                'add_user' => 1,
                'update_user' => 1,
            )
        );
        DB::table('input_type')->insert(
            array(
                'name' => 'File',
                'status' => 1,
                'loop' =>0,
                'add_user' => 1,
                'update_user' => 1,
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
        Schema::dropIfExists('input_type');
    }
};
