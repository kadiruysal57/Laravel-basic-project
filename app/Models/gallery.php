<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'title',
        'description',
        'status',
        'add_user',
        'update_user',
    ];
    protected $table = 'gallery';

    public function gallery_image(){
        return $this->hasMany(gallery_image::class,'gallery_id','id')->orderBy('image_order','asc');
    }

    public static function boot() {

        parent::boot();

        static::deleting(function($contents) {
            $contents->gallery_image()->delete();
        });
    }

    public function getTableReview(){
        $gallery_all = $this->select('id','name','title','description')->get();
        foreach ($gallery_all as $key => $g){
            $g->actions = ' <a class="table-action hover-primary" href="'.route('gallery.show',[$g->id]).'"><i class="ti-pencil"></i></a>
                                                <button type="button" class="table-action btn btn-pure deleteButton hover-danger" data-id="'.$g->id.'" data-action = "'.route('gallery.destroy',[$g->id]).'" data-table="#gallery_table"><i class="ti-trash"></i></button>';
            $g->id = ++$key;
        }
        return $gallery_all;
    }
}
