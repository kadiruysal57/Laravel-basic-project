<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'add_user',
        'update_user'
    ];

    protected $table = 'permission_table';
    public function users_roles(){
        return $this->hasMany(userroles::class,'permission_id','id');
    }
}
