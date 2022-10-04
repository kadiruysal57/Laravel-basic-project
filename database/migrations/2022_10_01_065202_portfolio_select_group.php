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
        Schema::create('portfolio_select_group', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('portfolio_group_id');
            $table->unsignedBigInteger('portfolio_id');
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();

            $table->foreign('portfolio_group_id')->references('id')->on('portfolio_group');
            $table->foreign('portfolio_id')->references('id')->on('portfolio');

        });

        DB::table('portfolio_select_group')->insert([
            'portfolio_group_id'=>1,
            'portfolio_id'=>1,
            'add_user'=>1,
        ]);
        DB::table('portfolio_select_group')->insert([
            'portfolio_group_id'=>2,
            'portfolio_id'=>1,
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
