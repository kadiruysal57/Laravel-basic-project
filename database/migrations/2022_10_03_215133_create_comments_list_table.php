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
        Schema::create('comments_list', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comments_id');
            $table->text('name')->nullable();
            $table->string('job_title')->nullable();
            $table->text('comments')->nullable();
            $table->string('url');
            $table->string('rate');
            $table->integer('status')->default(1);
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();
            $table->foreign('comments_id')->references('id')->on('comments');
        });

        DB::table('comments_list')->insert(
            array(
                'comments_id' => '1',
                'name' => 'Saul Goodman',
                'job_title' => "Ceo Founder",
                'comments' => "Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.",
                'url'=>'/storage/photos/shares/testimonials-1.jpg',
                'rate'=>'5',
                'status'=>'1'
            )
        );
        DB::table('comments_list')->insert(
            array(
                'comments_id' => '1',
                'name' => 'Sara Wilsson',
                'job_title' => "Designer",
                'comments' => "Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.",
                'url'=>'/storage/photos/shares/testimonials-2.jpg',
                'rate'=>'4.5',
                'status'=>'1'
            )
        );
        DB::table('comments_list')->insert(
            array(
                'comments_id' => '1',
                'name' => 'Jena Karlis',
                'job_title' => "Store Owner",
                'comments' => "Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.",
                'url'=>'/storage/photos/shares/testimonials-3.jpg',
                'rate'=>'4',
                'status'=>'1'
            )
        );
        DB::table('comments_list')->insert(
            array(
                'comments_id' => '1',
                'name' => 'John Larson',
                'job_title' => "Entrepreneur",
                'comments' => "Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.",
                'url'=>'/storage/photos/shares/testimonials-4.jpg',
                'rate'=>'3.5',
                'status'=>'1'
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
        Schema::dropIfExists('comments_list');
    }
};
