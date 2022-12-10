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
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('site_settings_id');
            $table->string('name')->nullable();
            $table->text('address')->nullable();
            $table->text('gsm')->nullable();
            $table->text('gsm2')->nullable();
            $table->string('email')->nullable();
            $table->text('maps')->nullable();
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();

            $table->foreign('site_settings_id')->references('id')->on('site_settings');
        });
        DB::table('address')->insert(
            array(
                'site_settings_id'=>1,
                'name'=>"Anaofis",
                'address'=>"A108 Adam Street New York, NY 535022",
                'gsm'=>'+1 5589 55488 55',
                'email'=>'info@example.com',
                'maps'=>'https://www.google.com/maps/d/embed?mid=1aMpvkK38vJFhnLpdgavnXIgLQc0&hl=en_US&ehbc=2E312F',
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
