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
        Schema::create('menu', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('status')->default(1);
            $table->string('type')->default(1);
            $table->unsignedBigInteger('language_id');
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();
        });

        DB::table('menu')->insert(
            array(
                'name' => 'Top menu',
                'status' => '1',
                'type' => '1',
                'language_id' => '1',
            )
        );
        DB::table('menu')->insert(
            array(
                'name' => 'Footer menu',
                'status' => '1',
                'type' => '2',
                'language_id' => '1',
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
        Schema::dropIfExists('language');
    }
};
