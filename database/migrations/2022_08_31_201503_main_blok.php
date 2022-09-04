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
        Schema::create('main_blok', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('group_id');
            $table->timestamps();
            $table->foreign('group_id')->references('id')->on('blok_groups');

        });
        DB::table('main_blok')->insert(
            array(
                'name' => 'Top',
                'group_id' => "1",
            )
        );
        DB::table('main_blok')->insert(
            array(
                'name' => 'Left',
                'group_id' => "2",
            )
        );
        DB::table('main_blok')->insert(
            array(
                'name' => 'Mid',
                'group_id' => "3",
            )
        );
        DB::table('main_blok')->insert(
            array(
                'name' => 'Right',
                'group_id' => "2",
            )
        );
        DB::table('main_blok')->insert(
            array(
                'name' => 'Footer',
                'group_id' => "1",
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
