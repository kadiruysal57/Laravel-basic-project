<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class slider extends Model
{
    use HasFactory;
    protected $fillable = [


        'name',
        'status',
        'title',
        'description',
        'add_user',
        'update_user',

    ];

    protected $table = 'slider';

    public function slider_image_many(){
        return $this->hasMany(slider_image::class,'slider_id','id')->where('status',1);
    }
    public function slider_image_one(){
        return $this->hasOne(slider_image::class,'slider_id','id')->where('status',1);
    }
}
