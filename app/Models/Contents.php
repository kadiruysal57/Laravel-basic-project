<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contents extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'title',
        'short_desc',
        'lang',
        'description',
        'main_photo',
        'preview_photo',
        'css_iframe',
        'js_iframe',
        'seo_title',
        'keywords',
        'seo_description',
        'focus_keywords',
        'seo_url',
        'lock_page',
        'status',
        'add_user',
        'update_user',
    ];
    protected $table = 'contents';
}
