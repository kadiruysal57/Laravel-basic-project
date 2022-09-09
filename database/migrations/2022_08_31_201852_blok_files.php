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
        Schema::create('blok_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id');
            $table->string('name');
            $table->integer('status');
            $table->timestamps();
            $table->foreign('group_id')->references('id')->on('blok_groups');

        });
        DB::table('blok_files')->insert(
            array(
                'group_id' => '1',
                'name' => "top_menu",
                'status' => "1",
            )
        );
        DB::table('blok_files')->insert(
            array(
                'group_id' => '1',
                'name' => "slider",
                'status' => "1",
            )
        );
        DB::table('blok_files')->insert(
            array(
                'group_id' => '1',
                'name' => "footer_default1",
                'status' => "1",
            )
        );
        DB::table('blok_files')->insert(
            array(
                'group_id' => '1',
                'name' => "footer_default2",
                'status' => "1",
            )
        );
        DB::table('blok_files')->insert(
            array(
                'group_id' => '2',
                'name' => "filtre",
                'status' => "1",
            )
        );
        DB::table('blok_files')->insert(
            array(
                'group_id' => '2',
                'name' => "sample_page",
                'status' => "1",
            )
        );

        DB::table('blok_files')->insert(
            array(
                'group_id' => '3',
                'name' => "default_page1",
                'status' => "1",
            )
        );
        DB::table('blok_files')->insert(
            array(
                'group_id' => '3',
                'name' => "default_page2",
                'status' => "1",
            )
        );
        DB::table('blok_files')->insert(
            array(
                'group_id' => '3',
                'name' => "forms",
                'status' => "1",
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