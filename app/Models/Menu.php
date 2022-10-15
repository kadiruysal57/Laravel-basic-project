<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'language_id',
    ];
    protected $table = 'menu';

    public function language(){
        return $this->hasOne(Language::class,'id','language_id');
    }
    public function menu_item_top(){
        return $this->hasMany(menuitem::class,'menu_id','id')->where('top_category','=',null)->orderBy('menu_order','asc');
    }


    public function default_menu(){
        return array('1'=>'Top Menu','2'=>'Footer Menu');
    }
}
