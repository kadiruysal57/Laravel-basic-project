<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemesColor extends Model
{
    use HasFactory;
    protected $fillable = [
        'color_name',
        'color_folder_name',
        'color_hex',
        'status'
    ];
    protected $table = 'themes_color';
}
