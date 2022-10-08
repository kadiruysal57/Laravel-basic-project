<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class form_send extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'form_id',
        'form_input_id',
        'form_send_id',
        'answer',
    ];

    protected $table = 'form_send';
}
