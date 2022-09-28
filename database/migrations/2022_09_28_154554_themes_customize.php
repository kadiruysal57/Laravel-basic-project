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
        Schema::create('themes_customize', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('themes_id');
            $table->unsignedBigInteger('themes_color_id');
            $table->text('special_css')->nullable();
            $table->text('special_jss')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();
            $table->foreign('themes_id')->references('id')->on('themes');
            $table->foreign('themes_color_id')->references('id')->on('themes_color');
        });
        DB::table('themes_color')->insert(
            array(
                'themes_id' => '1',
                'themes_color_id'=>'1',
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
