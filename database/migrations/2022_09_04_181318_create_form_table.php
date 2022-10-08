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
                'name' => 'Rezervasyon Formu',
                'title' => 'Konaklamanızı Bizimle Ayırın',
                'to' => 'admin@admin.com',
                'from' => 'admin@admin.com',
                'subject' => 'rezervasyon formu',
                'file_attachment' => 'test',
                'additional_headers' => 'test',
                'message_body' => 'test',
                'form_type' => 2,
                'form_url' => '',
                'form_title' => 'Başarılı',
                'form_desc' => 'Mesajınızı aldık sizi arayacağız',
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
