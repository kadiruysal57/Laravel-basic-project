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
        Schema::create('menu_item', function (Blueprint $table) {
            $table->id();
            $table->string('tableId'); // 1 ise post 99 ise custom
            $table->string('menu_name')->nullable(); // custom link ise name tablodan geliyorsa tablodaki idsi
            $table->text('real_link')->nullable(); // eğer custom ise gelen link buraya geliyor
            $table->integer('top_category')->nullable(); // üst kategorinin bu tablodaki idsi
            $table->integer('menu_order')->nullable(); // sırası
            $table->integer('menu_id'); // footer mı top menu mu olduğu
            $table->integer('target')->default(1); // _blank _self ayarı
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();
        });
        DB::table('menu_item')->insert(
            array(
                'tableId' => '99',
                'menu_name' => 'Anasayfa',
                'real_link' => 'http://127.0.0.1:8000/#home-page',
                'menu_order'=>1,
                'menu_id'=>1,
                'target'=>1,
            )
        );
        DB::table('menu_item')->insert(
            array(
                'tableId' => '99',
                'menu_name' => 'Hakkımızda',
                'real_link' => 'http://127.0.0.1:8000/#about-us',
                'menu_order'=>2,
                'menu_id'=>1,
                'target'=>1,
            )
        );
        DB::table('menu_item')->insert(
            array(
                'tableId' => '99',
                'menu_name' => 'Menu',
                'real_link' => 'http://127.0.0.1:8000/#portfolio',
                'menu_order'=>3,
                'menu_id'=>1,
                'target'=>1,
            )
        );
        DB::table('menu_item')->insert(
            array(
                'tableId' => '99',
                'menu_name' => 'Şefler',
                'real_link' => 'http://127.0.0.1:8000/#staff',
                'menu_order'=>5,
                'menu_id'=>1,
                'target'=>1,
            )
        );

        DB::table('menu_item')->insert(
            array(
                'tableId' => '99',
                'menu_name' => 'Galeri',
                'real_link' => 'http://127.0.0.1:8000/#gallery',
                'menu_order'=>6,
                'menu_id'=>1,
                'target'=>1,
            )
        );
        DB::table('menu_item')->insert(
            array(
                'tableId' =>1,
                'menu_name' => 2,
                'real_link' => '',
                'menu_order'=>6,
                'menu_id'=>1,
                'target'=>1,
            )
        );


        DB::table('menu_item')->insert(
            array(
                'tableId' =>1,
                'menu_name' => 1,
                'real_link' => '',
                'menu_order'=>1,
                'menu_id'=>2,
                'target'=>1,
            )
        );

        DB::table('menu_item')->insert(
            array(
                'tableId' =>1,
                'menu_name' => 2,
                'real_link' => '',
                'menu_order'=>2,
                'menu_id'=>2,
                'target'=>1,
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
