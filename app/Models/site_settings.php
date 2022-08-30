<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class site_settings extends Model
{
    use HasFactory;
    protected $fillable = [
        'site_name',
        'site_slogan',
        'logo',
        'fav_icon',
        'language_id',
        'status',
    ];
    protected $table = 'site_settings';
    public function default_value(){
        return $this->where('status',1)->orderBy('id','asc')->first();
    }
    public function social_media(){
        return $this->hasMany(social_media::class,'sitesettings_id','id');
    }
}
