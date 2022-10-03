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

        Schema::create('slider_image', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('slider_id');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->text('text')->nullable();
            $table->string('button_text')->nullable();
            $table->string('button_colour')->nullable();
            $table->string('button_href')->nullable();
            $table->string('url')->nullable();
            $table->integer('order_input');
            $table->integer('status');
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();
            $table->foreign('slider_id')->references('id')->on('slider');
        });
        DB::table('slider_image')->insert(
            array(
                'slider_id' => 1,
                'title' => 'Enjoy Your Healthy Delicious Food',
                'description' => 'Sed autem laudantium dolores. Voluptatem itaque ea consequatur eveniet. Eum quas beatae cumque eum quaerat.',
                'text'=>'',
                'button_text'=>'',
                'button_colour'=>'',
                'button_href'=>'',
                'url'=>'/storage/photos/shares/hero-img.png',
                'order_input'=>1,
                'status' => 1,
                'add_user' => 1,
                'update_user' => 1,
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
        Schema::dropIfExists('slider_image');
    }
};
