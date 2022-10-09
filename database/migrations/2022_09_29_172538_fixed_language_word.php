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
        Schema::create('fixed_word', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lang_id');
            $table->string('code_name')->nullable();
            $table->string('word')->nullable();
            $table->integer('lock')->default(2);
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();
            $table->foreign('lang_id')->references('id')->on('language');
        });

        DB::table('fixed_word')->insert(
            array(
                'lang_id' => '1',
                'code_name'=>"send_button",
                'word' => "Gönder",
                'lock' => "1",
                'add_user' => "1",
            )
        );

        DB::table('fixed_word')->insert(
            array(
                'lang_id' => '1',
                'code_name'=>"follow_us",
                'word' => "Takip Et",
                'lock' => "1",
                'add_user' => "1",
            )
        );

        DB::table('fixed_word')->insert(
            array(
                'lang_id' => '1',
                'code_name'=>"address",
                'word' => "Adres",
                'lock' => "1",
                'add_user' => "1",
            )
        );

        DB::table('fixed_word')->insert(
            array(
                'lang_id' => '1',
                'code_name'=>"reservations",
                'word' => "Rezervasyon",
                'lock' => "1",
                'add_user' => "1",
            )
        );

        DB::table('fixed_word')->insert(
            array(
                'lang_id' => '1',
                'code_name'=>"opening_hours",
                'word' => "Çalışma Saatleri",
                'lock' => "1",
                'add_user' => "1",
            )
        );

        DB::table('fixed_word')->insert(
            array(
                'lang_id' => '1',
                'code_name'=>"phone",
                'word' => "Telefon",
                'lock' => "1",
                'add_user' => "1",
            )
        );

        DB::table('fixed_word')->insert(
            array(
                'lang_id' => '1',
                'code_name'=>"email",
                'word' => "Email",
                'lock' => "1",
                'add_user' => "1",
            )
        );
        DB::table('fixed_word')->insert(
            array(
                'lang_id' => '1',
                'code_name'=>"call_us",
                'word' => "Bizi Arayın",
                'lock' => "1",
                'add_user' => "1",
            )
        );
        DB::table('fixed_word')->insert(
            array(
                'lang_id' => '1',
                'code_name'=>"home",
                'word' => "Anasayfa",
                'lock' => "1",
                'add_user' => "1",
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
