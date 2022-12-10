<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category_item extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'content_id',
        'add_user',
        'update_user',
    ];
    protected $table = 'category_item';

    public function content(){
        return $this->hasOne(Contents::class,'id','content_id');
    }
}
