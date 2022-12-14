<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class slider_image extends Model
{
    use HasFactory;

    protected $fillable = [

        'slider_id',
        'title',
        'description',
        'text',
        'button_text',
        'button_colour',
        'button_href',
        'url',
        'order_input',
        'status',
        'add_user',
        'update_user'
    ];
    public function slider(){
        return $this->hasMany(slider::class,'id','slider_id');
    }

    protected $table = 'slider_image';

}
