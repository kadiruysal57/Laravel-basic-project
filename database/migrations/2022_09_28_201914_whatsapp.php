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
        Schema::create('whatsapp_icon', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lang_id');
            $table->text('image')->default("panel/assets/img/no-pictures.png");
            $table->string('phone')->nullable();
            $table->string('wp_text')->nullable();
            $table->string('default_text')->nullable();
            $table->integer('button_position')->default(4);
            // 1-)sol orta 2-)sol asağı
            // 3-)sağ orta 4-)sağ asağı
            $table->integer('status')->default(1);
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();
            $table->foreign('lang_id')->references('id')->on('language');
        });
        DB::table('whatsapp_icon')->insert(
            array(
                'lang_id' => '1',
                'phone'=>"+905495555555",
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
