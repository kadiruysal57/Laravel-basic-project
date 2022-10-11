<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'status',
        'add_user',
        'update_user',
    ];

    protected $table = 'comments';

    public function comments_many(){
        return $this->hasMany(comments_list::class,'comments_id','id')->where('status',1)->orderBy('comment_order','asc');
    }
    public function comments_one(){
        return $this->hasOne(comments_list::class,'comments_id','id')->where('status',1)->orderBy('comment_order','asc');
    }
}
