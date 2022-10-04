<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contents extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'title',
        'short_desc',
        'language_id',
        'description',
        'main_photo',
        'preview_photo',
        'css_iframe',
        'js_iframe',
        'seo_title',
        'keywords',
        'seo_description',
        'focus_keywords',
        'seo_url',
        'lock_page',
        'status',
        'left_blok_active',
        'right_blok_active',
        'default_blok_id',
        'slider_id',
        'gallery_id',
        'services_id',
        'portfolio_id',
        'form_id',
        'faq_id',
        'add_user',
        'update_user',
    ];
    protected $table = 'contents';

    public function blok_file(){
        return $this->hasMany(ContentBlokFiles::class,'content_id','id')->orderBy('blok_file_order','asc');
    }
    public function language(){
        return $this->hasOne(Language::class,'id','language_id');
    }
    public function default_blok_id(){
        return $this->hasOne(DefaultBlok::class,'id','default_blok_id');
    }
    public function content_gallery(){
        return $this->hasMany(ContentGallery::class,'content_id','id')->orderBy('image_order','asc');
    }
    public function content_gallery_one(){
        return $this->hasOne(ContentGallery::class,'content_id','id')->orderBy('image_order','asc');
    }
    public function services(){
        return $this->hasOne(services::class,'id','services_id');
    }
    public function content_slider(){

        return $this->hasOne(slider::class,'id','slider_id');
    }

    public function portfolio(){
        return $this->hasOne(portfolio::class,'id','portfolio_id');
    }
    public function getTableReview(){
        $contents_all = $this->select('id','name','language_id','seo_url')->where('status',1)->get();
        foreach ($contents_all as $c){
            $c->actions = ' <a class="table-action hover-primary" href="'.route('contents.show',[$c->id]).'"><i class="ti-pencil"></i></a>
                                                <button type="button" class="table-action btn btn-pure deleteButton hover-danger" data-id="'.$c->id.'" data-action = "'.route('contents.destroy',[$c->id]).'" data-table="#contents_table"><i class="ti-trash"></i></button>';
            $c->language_id = $c->language->name;
            unset($c->id);
            unset($c->seo_url);
            unset($c->language);
        }
        return $contents_all;
    }
    public static function boot() {

        //burasının amacı content verisi silinme kodu çalıştığı zaman yani delete() bağlantılı olan tablolardan da veriler siliniyor.
        parent::boot();

        static::deleting(function($contents) {
            $contents->blok_file()->delete();
        });
    }
}
