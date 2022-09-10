<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class form_input_value extends Model
{
    use HasFactory;
    protected $fillable = [
        'form_input_id',
        'default_value',
        'add_user',
        'update_user'
    ];

    protected $table = 'form_input_value';
}
