<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultBlokFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'main_blok_id',
        'group_id',
        'blok_files_id',
        'blok_file_order',
        'html',
        'add_user',
        'update_user',
    ];
    protected $table = 'default_blok_file';

    public function file_name(){
        return $this->hasOne(BlokFiles::class,'id','blok_files_id');
    }
}
