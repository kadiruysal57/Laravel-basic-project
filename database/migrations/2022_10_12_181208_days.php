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
        Schema::create('days', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('days')->insert(
            array(
                'name' => 'mon',
            )
        );

        DB::table('days')->insert(
            array(
                'name' => 'tue',
            )
        );

        DB::table('days')->insert(
            array(
                'name' => 'wed',
            )
        );

        DB::table('days')->insert(
            array(
                'name' => 'thu',
            )
        );
        DB::table('days')->insert(
            array(
                'name' => 'fri',
            )
        );
        DB::table('days')->insert(
            array(
                'name' => 'sat',
            )
        );
        DB::table('days')->insert(
            array(
                'name' => 'sun',
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
