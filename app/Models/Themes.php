<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Themes extends Model
{
    use HasFactory;
    protected $fillable = [
        'themes_name',
        'themes_folder_name',
        'status',
    ];
    protected $table = 'themes';
}
