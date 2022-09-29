<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class staff extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'status',
        'add_user',
        'update_user',
    ];

    protected $table = 'staff';

    public function staff_many(){
        return $this->hasMany(staff_list::class,'staff_id','id')->where('status',1);
    }
    public function staff_one(){
        return $this->hasOne(staff_list::class,'staff_id','id')->where('status',1);
    }
}
