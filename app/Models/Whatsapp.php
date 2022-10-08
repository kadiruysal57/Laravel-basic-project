<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whatsapp extends Model
{
    use HasFactory;

    protected $fillable = [
        'lang_id',
        'image',
        'phone',
        'wp_text',
        'default_text',
        'button_position',
        'status',
        'add_user',
        'update_user',
    ];
    protected $table = 'whatsapp_icon';

    public function getWp($lang = null){
        if(empty($lang)){
            $lang = \App\Models\Language::where('main_language',1)->first();
            $lang = $lang->id;
        }
        return $this->where('lang_id',$lang)->where('status',1)->first();
    }
}
