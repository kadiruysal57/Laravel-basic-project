<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThemesCustomize extends Model
{
    use HasFactory;
    protected $fillable = [
        'themes_id',
        'themes_color_id',
        'special_css',
        'special_jss',
        'update_user',
    ];
    protected $table = 'themes_customize';

    public function themes(){
        return $this->hasOne(Themes::class,'id','themes_id');
    }

    public function color(){
        return $this->hasOne(ThemesColor::class,'id','themes_color_id');
    }

}
