<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whatsapp extends Model
{
    use HasFactory;

    protected $fillable = [
        'lang_id',
        'image',
        'phone',
        'wp_text',
        'default_text',
        'button_position',
        'status',
        'add_user',
        'update_user',
    ];
    protected $table = 'whatsapp_icon';

}
