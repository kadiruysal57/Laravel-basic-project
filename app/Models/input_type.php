<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class input_type extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
        'loop',
        'add_user',
        'update_user'
    ];

    protected $table = 'input_type';
}
