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
        Schema::create('social_media', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->nullable();
            $table->string('name')->nullable();
            $table->string('link')->nullable();
            $table->integer('link_target')->nullable();
            $table->unsignedBigInteger('sitesettings_id')->nullable();
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();
            $table->foreign('sitesettings_id')->references('id')->on('site_settings');

        });
        DB::table('social_media')->insert(
            array(
                'sitesettings_id'=>1,
                'icon'=>"bi-twitter",
                'name'=>"Twitter",
                'link'=>'#',
                'link_target'=>'2',
                'add_user'=>'1'
            )
        );
        DB::table('social_media')->insert(
            array(
                'sitesettings_id'=>1,
                'icon'=>"bi-facebook",
                'name'=>"Facebook",
                'link'=>'#',
                'link_target'=>'2',
                'add_user'=>'1'
            )
        );
        DB::table('social_media')->insert(
            array(
                'sitesettings_id'=>1,
                'icon'=>"bi-instagram",
                'name'=>"Instagram",
                'link'=>'#',
                'link_target'=>'2',
                'add_user'=>'1'
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
