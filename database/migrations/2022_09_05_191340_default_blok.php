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

        Schema::create('default_blok', function (Blueprint $table) {
            $table->id();
            $table->string('default_blok_name');
            $table->integer('left_blok_active')->default(1);
            $table->integer('right_blok_active')->default(1);
            $table->integer('status')->default(1);
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();


        });
        DB::table('default_blok')->insert(
            array(
                'default_blok_name' => "Standart Sayfa",
                'left_blok_active' => "2",
                'right_blok_active' => "2",
                'status'=>1,
                'add_user'=>1,
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
        //
    }
};
