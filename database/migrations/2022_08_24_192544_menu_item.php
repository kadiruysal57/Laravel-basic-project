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
                'real_link' => '#hero',
                'menu_order'=>1,
                'menu_id'=>1,
                'target'=>1,
            )
        );
        DB::table('menu_item')->insert(
            array(
                'tableId' => '99',
                'menu_name' => 'Hakkımızda',
                'real_link' => '#about',
                'menu_order'=>2,
                'menu_id'=>1,
                'target'=>1,
            )
        );
        DB::table('menu_item')->insert(
            array(
                'tableId' => '99',
                'menu_name' => 'Menu',
                'real_link' => '#menu',
                'menu_order'=>3,
                'menu_id'=>1,
                'target'=>1,
            )
        );
        DB::table('menu_item')->insert(
            array(
                'tableId' => '99',
                'menu_name' => 'Events',
                'real_link' => '#events',
                'menu_order'=>4,
                'menu_id'=>1,
                'target'=>1,
            )
        );
        DB::table('menu_item')->insert(
            array(
                'tableId' => '99',
                'menu_name' => 'Şefler',
                'real_link' => '#chefs',
                'menu_order'=>5,
                'menu_id'=>1,
                'target'=>1,
            )
        );

        DB::table('menu_item')->insert(
            array(
                'tableId' => '99',
                'menu_name' => 'Galeri',
                'real_link' => '#gallery',
                'menu_order'=>6,
                'menu_id'=>1,
                'target'=>1,
            )
        );
        DB::table('menu_item')->insert(
            array(
                'tableId' => '99',
                'menu_name' => 'Bize Ulaşın',
                'real_link' => '#contact',
                'menu_order'=>8,
                'menu_id'=>1,
                'target'=>1,
            )
        );
        DB::table('menu_item')->insert(
            array(
                'tableId' => '99',
                'menu_name' => 'Açılır Menu',
                'real_link' => '#',
                'menu_order'=>7,
                'menu_id'=>1,
                'target'=>1,
            )
        );
        DB::table('menu_item')->insert(
            array(
                'tableId' => '1',
                'menu_name' => '1',
                'real_link' => '/',
                'top_category'=>8,
                'menu_order'=>1,
                'menu_id'=>1,
                'target'=>1,
            )
        );
        DB::table('menu_item')->insert(
            array(
                'tableId' => '99',
                'menu_name' => 'Açılır Menu 3',
                'real_link' => '#',
                'top_category'=>9,
                'menu_order'=>1,
                'menu_id'=>1,
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
