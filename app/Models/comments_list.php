<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comments_list extends Model
{
    use HasFactory;

    protected $fillable = [

        'comments_id',
        'name',
        'job_title',
        'comments',
        'url',
        'rate',
        'status',
        'add_user',
        'update_user'
    ];

    protected $table = 'comments_list';
}
