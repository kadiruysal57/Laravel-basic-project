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
            $table->integer('type')->default(1); //1 ise normal dosya 2 ise html_blok
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->foreign('group_id')->references('id')->on('blok_groups');

        });
        DB::table('blok_files')->insert(
            array(
                'group_id' => '1',
                'type'=>"1",
                'name' => "top_menu",
                'status' => "1",
            )
        );
        DB::table('blok_files')->insert(
            array(
                'group_id' => '1',
                'type'=>"1",
                'name' => "slider",
                'status' => "1",
            )
        );
        DB::table('blok_files')->insert(
            array(
                'group_id' => '1',
                'type'=>"2",
                'name' => "html_blok",
                'status' => "1",
            )
        );
        DB::table('blok_files')->insert(
            array(
                'group_id' => '3',
                'type'=>"1",
                'name' => "default_page1",
                'status' => "1",
            )
        );
        DB::table('blok_files')->insert(
            array(
                'group_id' => '3',
                'type'=>"1",
                'name' => "services",
                'status' => "1",
            )
        );
        DB::table('blok_files')->insert(
            array(
                'group_id' => '3',
                'type'=>"1",
                'name' => "portfolio",
                'status' => "1",
            )
        );
        DB::table('blok_files')->insert(
            array(
                'group_id' => '3',
                'type'=>"1",
                'name' => "testimonials",
                'status' => "1",
            )
        );
        DB::table('blok_files')->insert(
            array(
                'group_id' => '3',
                'type'=>"1",
                'name' => "staff",
                'status' => "1",
            )
        );
        DB::table('blok_files')->insert(
            array(
                'group_id' => '3',
                'type'=>"1",
                'name' => "form",
                'status' => "1",
            )
        );
        DB::table('blok_files')->insert(
            array(
                'group_id' => '3',
                'type'=>"1",
                'name' => "gallery",
                'status' => "1",
            )
        );
        DB::table('blok_files')->insert(
            array(
                'group_id' => '1',
                'type'=>"1",
                'name' => "footer",
                'status' => "1",
            )
        );

        DB::table('blok_files')->insert(
            array(
                'group_id' => '2',
                'type'=>"2",
                'name' => "html_blok",
                'status' => "1",
            )
        );

        DB::table('blok_files')->insert(
            array(
                'group_id' => '3',
                'type'=>"2",
                'name' => "html_blok",
                'status' => "1",
            )
        );

        DB::table('blok_files')->insert(
            array(
                'group_id' => '3',
                'type'=>"1",
                'name' => "default_page2",
                'status' => "1",
            )
        );
        DB::table('blok_files')->insert(
            array(
                'group_id' => '3',
                'type'=>"1",
                'name' => "contact_us",
                'status' => "1",
            )
        );
        DB::table('blok_files')->insert(
            array(
                'group_id' => '1',
                'type'=>"1",
                'name' => "breadcrumbs",
                'status' => "1",
            )
        );
        DB::table('blok_files')->insert(
            array(
                'group_id' => '3',
                'type'=>"1",
                'name' => "faq",
                'status' => "1",
            )
        );
        DB::table('blok_files')->insert(
            array(
                'group_id' => '3',
                'type'=>"1",
                'name' => "category_list",
                'status' => "1",
            )
        );
        DB::table('blok_files')->insert(
            array(
                'group_id' => '3',
                'type'=>"1",
                'name' => "page_details",
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
