<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentBlokFiles extends Model
{
    use HasFactory;

    protected $fillable = [
        'main_blok_id',
        'group_id',
        'content_id',
        'blok_files_id',
        'blok_file_order',
        'html',
        'id_attr',
        'class_attr',
        'color_attr',
        'add_user',
        'update_user',
    ];
    protected $table = 'content_blok_files';

    public function file_name(){
        return $this->hasOne(BlokFiles::class,'id','blok_files_id');
    }

}
