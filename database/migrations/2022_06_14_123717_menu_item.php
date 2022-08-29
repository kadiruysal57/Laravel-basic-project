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
