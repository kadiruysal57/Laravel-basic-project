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

    public function default_menu(){
        return array('Top Menu','Footer Menu');
    }
}
