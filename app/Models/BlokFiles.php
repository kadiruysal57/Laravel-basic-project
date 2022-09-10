<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlokFiles extends Model
{
    use HasFactory;
    protected $fillable = [
        'group_id',
        'name',
        'status',
    ];
    protected $table = 'blok_files';
}
