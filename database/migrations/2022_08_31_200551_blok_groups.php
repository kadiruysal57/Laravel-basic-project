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
        Schema::create('blok_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('status')->default(1);
            $table->string('file_url')->nullable();
            $table->timestamps();

        });
        DB::table('blok_groups')->insert(
            array(
                'name' => 'top_footer_blok',
                'status' => "1",
            )
        );
        DB::table('blok_groups')->insert(
            array(
                'name' => 'right_left_blok',
                'status' => "1",
            )
        );
        DB::table('blok_groups')->insert(
            array(
                'name' => 'mid_blok',
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
