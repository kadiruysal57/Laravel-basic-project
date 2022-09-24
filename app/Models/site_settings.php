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
    public function address(){
        return $this->hasMany(Address::class,'site_settings_id','id');
    }
    public function social_media(){
        return $this->hasMany(social_media::class,'sitesettings_id','id');
    }

    public static function boot() {

        //burasının amacı content verisi silinme kodu çalıştığı zaman yani delete() bağlantılı olan tablolardan da veriler siliniyor.
        parent::boot();

        static::deleting(function($contents) {
            $contents->social_media()->delete();
            $contents->address()->delete();
        });
    }
}
