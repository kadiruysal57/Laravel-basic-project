<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roleslist extends Model
{
    use HasFactory;

    protected $fillable = [
        'roles_name',
        'status',
        'add_user',
        'update_user',
    ];
    protected $table = 'roles_list';
}
