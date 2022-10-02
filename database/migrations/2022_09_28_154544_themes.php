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
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('themes_name')->nullable();
            $table->string('themes_folder_name')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
        DB::table('themes')->insert(
            array(
                'themes_name' => 'Themes Food',
                'themes_folder_name' => 'food',
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
