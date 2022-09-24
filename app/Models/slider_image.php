<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class slider_image extends Model
{
    use HasFactory;

    protected $fillable = [

        'slider_id',
        'title',
        'description',
        'text',
        'button_text',
        'button_colour',
        'url',
        'order_input',
        'status',
        'add_user',
        'update_user'
    ];

    protected $table = 'slider_image';

}
