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
        Schema::create('themes_color', function (Blueprint $table) {
            $table->id();
            $table->string('color_name')->nullable();
            $table->string('color_folder_name')->nullable();
            $table->string('color_hex')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
        DB::table('themes_color')->insert(
            array(
                'color_name' => 'Kırmızı',
                'color_folder_name'=>'red',
                'color_hex'=>'Red',
                'status' => "1",
            )
        );
        DB::table('themes_color')->insert(
            array(
                'color_name' => 'Mavi',
                'color_folder_name'=>'blue',
                'color_hex'=>'Blue',
                'status' => "1",
            )
        );
        DB::table('themes_color')->insert(
            array(
                'color_name' => 'Yeşil',
                'color_folder_name'=>'green',
                'color_hex'=>'green',
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
