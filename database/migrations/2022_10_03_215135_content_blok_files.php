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
        Schema::create('content_blok_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('main_blok_id');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('content_id');
            $table->unsignedBigInteger('blok_files_id');
            $table->integer('blok_file_order')->default(0);
            $table->text('html')->nullable();
            $table->string('class_attr')->nullable();
            $table->string('id_attr')->nullable();
            $table->string('color_attr')->nullable();
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();
            $table->foreign('main_blok_id')->references('id')->on('main_blok');
            $table->foreign('group_id')->references('id')->on('blok_groups');
            $table->foreign('content_id')->references('id')->on('contents');
            $table->foreign('blok_files_id')->references('id')->on('blok_files');
        });
        DB::table('content_blok_files')->insert(
            array(
                'main_blok_id' => '1',
                'group_id' => '1',
                'content_id' => "1",
                'blok_files_id'=>"1",
                'blok_file_order' => "1",
                'html'=>"",
                'add_user'=>"1"
            )
        );
        DB::table('content_blok_files')->insert(
            array(
                'main_blok_id' => '1',
                'group_id' => '1',
                'content_id' => "1",
                'blok_files_id' => "2",
                'blok_file_order' => "2",
                'html'=>"",
                'id_attr'=>'home-page',
                'add_user'=>"1"
            )
        );
        DB::table('content_blok_files')->insert(
            array(
                'main_blok_id' => '3',
                'group_id' => '3',
                'content_id' => "1",
                'blok_files_id' => "4",
                'blok_file_order' => "1",
                'html'=>"",
                'id_attr'=>'about-us',
                'add_user'=>"1"
            )
        );
        DB::table('content_blok_files')->insert(
            array(
                'main_blok_id' => '3',
                'group_id' => '3',
                'content_id' => "1",
                'blok_files_id' => "5",
                'blok_file_order' => "2",
                'html'=>"",
                'id_attr'=>'my-services',
                'color_attr'=>'#eeeeee',
                'add_user'=>"1"
            )
        );
        DB::table('content_blok_files')->insert(
            array(
                'main_blok_id' => '3',
                'group_id' => '3',
                'content_id' => "1",
                'blok_files_id' => "6",
                'blok_file_order' => "3",
                'html'=>"",
                'id_attr'=>'portfolio',
                'add_user'=>"1"
            )
        );
        DB::table('content_blok_files')->insert(
            array(
                'main_blok_id' => '3',
                'group_id' => '3',
                'content_id' => "1",
                'blok_files_id' => "7",
                'blok_file_order' => "4",
                'html'=>"",
                'id_attr'=>'comments',
                'color_attr'=>'#eeeeee',
                'add_user'=>"1"
            )
        );
        DB::table('content_blok_files')->insert(
            array(
                'main_blok_id' => '3',
                'group_id' => '3',
                'content_id' => "1",
                'blok_files_id' => "8",
                'blok_file_order' => "5",
                'html'=>"",
                'id_attr'=>'staff',
                'add_user'=>"1"
            )
        );
        DB::table('content_blok_files')->insert(
            array(
                'main_blok_id' => '3',
                'group_id' => '3',
                'content_id' => "1",
                'blok_files_id' => "9",
                'blok_file_order' => "6",
                'html'=>"",
                'id_attr'=>'contact-us',
                'color_attr'=>'#eeeeee',
                'add_user'=>"1"
            )
        );
        DB::table('content_blok_files')->insert(
            array(
                'main_blok_id' => '3',
                'group_id' => '3',
                'content_id' => "1",
                'blok_files_id' => "10",
                'blok_file_order' => "7",
                'html'=>"",
                'id_attr'=>'gallery',
                'color_attr'=>'#eeeeee',
                'add_user'=>"1"
            )
        );
        DB::table('content_blok_files')->insert(
            array(
                'main_blok_id' => '5',
                'group_id' => '1',
                'content_id' => "1",
                'blok_files_id' => "11",
                'blok_file_order' => "1",
                'html'=>"",
                'add_user'=>"1"
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
