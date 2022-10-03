<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class services_list extends Model
{
    use HasFactory;

    protected $fillable = [

        'services_id',
        'url',
        'title',
        'description',
        'link',
        'status',
        'add_user',
        'update_user'
    ];

    protected $table = 'services_list';
}
