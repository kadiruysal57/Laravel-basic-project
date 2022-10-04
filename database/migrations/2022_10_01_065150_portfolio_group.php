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
        Schema::create('portfolio_group', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->integer('status');
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();
        });

        DB::table('portfolio_group')->insert([
            'title'=>"Başlangıc",
            'status'=>'1',
            'add_user'=>1,
        ]);
        DB::table('portfolio_group')->insert([
            'title'=>"Ara Sıcaklar",
            'status'=>'1',
            'add_user'=>1,
        ]);
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
