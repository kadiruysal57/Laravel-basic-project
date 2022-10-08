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
        Schema::create('staff_list', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id');
            $table->string('name')->nullable();
            $table->string('staff_title')->nullable();
            $table->text('description')->nullable();
            $table->text('url');
            $table->integer('status')->default(1);
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();
            $table->foreign('staff_id')->references('id')->on('staff');
        });

        DB::table('staff_list')->insert(
            array(
                'staff_id' => '1',
                'name'=>'Walter White',
                'staff_title'=>'Master Chef',
                'description'=>'Velit aut quia fugit et et. Dolorum ea voluptate vel tempore tenetur ipsa quae aut. Ipsum exercitationem iure minima enim corporis et voluptate.',
                'url'=>'/storage/photos/shares/chefs-1.jpg',
                'status'=>1
            )
        );
        DB::table('staff_list')->insert(
            array(
                'staff_id' => '1',
                'name'=>'Sarah Jhonson',
                'staff_title'=>'Patissier',
                'description'=>'Quo esse repellendus quia id. Est eum et accusantium pariatur fugit nihil minima suscipit corporis. Voluptate sed quas reiciendis animi neque sapiente.',
                'url'=>'/storage/photos/shares/chefs-2.jpg',
                'status'=>1
            )
        );
        DB::table('staff_list')->insert(
            array(
                'staff_id' => '1',
                'name'=>'William Anderson',
                'staff_title'=>'Cook',
                'description'=>'Vero omnis enim consequatur. Voluptas consectetur unde qui molestiae deserunt. Voluptates enim aut architecto porro aspernatur molestiae modi.',
                'url'=>'/storage/photos/shares/chefs-3.jpg',
                'status'=>1
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
        Schema::dropIfExists('staff_list');
    }
};
