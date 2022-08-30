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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable();
            $table->string('site_slogan')->nullable();
            $table->string('logo')->nullable();
            $table->string('fav_icon')->nullable();
            $table->unsignedBigInteger('language_id')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->foreign('language_id')->references('id')->on('language');

        });
        DB::table('site_settings')->insert(
            array(
                'site_name' => 'Kpanel',
                'site_slogan' => 'Biz varsak herşeye çözüm var',
                'logo' => '',
                'fav_icon'=>'',
                'language_id'=>'1',
                'status'=>'1',
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
