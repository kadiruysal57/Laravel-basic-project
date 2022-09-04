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
        'lang',
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
        'add_user',
        'update_user',
    ];
    protected $table = 'contents';

    public function blok_file(){
        return $this->hasMany(ContentBlokFiles::class,'content_id','id')->orderBy('blok_file_order','asc');
    }
    public function getTableReview(){
        $contents_all = $this->select('id','name','seo_url')->where('status',1)->get();
        foreach ($contents_all as $c){
            $c->actions = ' <a class="table-action hover-primary" href="'.route('contents.show',[$c->id]).'"><i class="ti-pencil"></i></a>
                                                <button type="button" class="table-action btn btn-pure deleteButton hover-danger" data-id="'.$c->id.'" data-action = "'.route('contents.destroy',[$c->id]).'" data-table="#contents_table"><i class="ti-trash"></i></button>';
            unset($c->id);
            unset($c->seo_url);
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
