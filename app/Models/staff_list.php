<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class staff_list extends Model
{
    use HasFactory;

    protected $fillable = [

        'staff_id',
        'name',
        'staff_title',
        'description',
        'url',
        'status',
        'add_user',
        'update_user'
    ];

    protected $table = 'staff_list';
}
