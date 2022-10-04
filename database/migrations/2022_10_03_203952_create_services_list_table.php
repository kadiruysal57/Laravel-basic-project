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
        Schema::create('services_list', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('services_id');
            $table->text('url')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('link')->nullable();
            $table->integer('status')->default(1);;
            $table->integer('list_order')->nullable();
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();
            $table->foreign('services_id')->references('id')->on('services');
        });
        DB::table('services_list')->insert([
            'services_id'=>1,
            'url'=>null,
            'title'=>'Why Choose Yummy2?',
            'description'=>'Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquipLorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit Asperiores dolores sed et. Tenetur quia eos. Autem tempore quibusdam vel necessitatibus optio ad corporis.',
            'link'=>'#',
            'list_order'=>1,
            'status'=>'1',
            'add_user'=>1,
        ]);
        DB::table('services_list')->insert([
            'services_id'=>1,
            'url'=>"/storage/photos/shares/2.png",
            'title'=>'Ullamco labori 123s ladore pan',
            'description'=>'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt',
            'link'=>null,
            'list_order'=>2,
            'status'=>'1',
            'add_user'=>1,
        ]);
        DB::table('services_list')->insert([
            'services_id'=>1,
            'url'=>"/storage/photos/shares/3.png",
            'title'=>'Labore consequatur incidid dolore',
            'description'=>'Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere',
            'link'=>null,
            'list_order'=>3,
            'status'=>'1',
            'add_user'=>1,
        ]);
        DB::table('services_list')->insert([
            'services_id'=>1,
            'url'=>"/storage/photos/shares/1.png",
            'title'=>'Corporis voluptates officia eiusmod',
            'description'=>'Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip',
            'link'=>null,
            'list_order'=>4,
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
        Schema::dropIfExists('services_list');
    }
};
