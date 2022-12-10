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
        return $this->hasMany(slider_image::class,'slider_id','id')->where('status',1)->orderBy('order_input');
    }
    public function slider_image_delete(){
        return $this->hasMany(slider_image::class,'slider_id','id');
    }
    public function slider_image_one(){
        return $this->hasOne(slider_image::class,'slider_id','id')->where('status',1);
    }
    public function getTableReview(){
        $slider_all = $this->select('id','name','title')->where('status',1)->get();
        foreach ($slider_all as $s){
            $s->actions = ' <a class="table-action hover-primary" href="'.route('slider.show',[$s->id]).'"><i class="ti-pencil"></i></a>
                                                <button type="button" class="table-action btn btn-pure deleteButton hover-danger" data-id="'.$s->id.'" data-action = "'.route('slider.destroy',[$s->id]).'" data-table="#slider"><i class="ti-trash"></i></button>';
            unset($s->id);
        }
        return $slider_all;
    }
    public static function boot() {

        //burasının amacı form verisi silinme kodu çalıştığı zaman yani delete() bağlantılı olan tablolardan da veriler siliniyor.
        parent::boot();
        static::deleting(function($slider) {
            $slider->slider_image_delete()->delete();
        });
    }
}
