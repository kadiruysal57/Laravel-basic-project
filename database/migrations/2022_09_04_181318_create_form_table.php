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
        Schema::create('form', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title')->nullable();
            $table->string('to');
            $table->string('from');
            $table->string('subject');
            $table->string('file_attachment');
            $table->string('additional_headers');
            $table->string('message_body');
            $table->integer('form_type')->nullable();
            $table->string('form_url')->nullable();
            $table->string('form_title')->nullable();
            $table->text('form_desc')->nullable();
            $table->integer('status');
            $table->integer('add_user')->nullable();
            $table->integer('update_user')->nullable();
            $table->timestamps();
        });
        DB::table('form')->insert(
            array(
                'name' => 'denememesaj',
                'title' => 'denememtitle',
                'to' => 'denememesajto',
                'from' => 'denememesajfrom',
                'subject' => 'denememesajsubject',
                'file_attachment' => 'denememesajfile',
                'additional_headers' => 'denememesahead',
                'message_body' => 'denememesajbody',
                'form_type' => 1,
                'form_url' => 'form_url',
                'form_title' => 'form_title',
                'form_desc' => 'form_desc',
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
        Schema::dropIfExists('form');
    }
};
