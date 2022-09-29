<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaqCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'add_user',
        'update_user',
    ];
    protected $table = 'faq_category';

    public function faq(){
        return $this->hasMany(Faq::class,'faq_category_id','id');
    }

    public static function boot() {

        //burasının amacı content verisi silinme kodu çalıştığı zaman yani delete() bağlantılı olan tablolardan da veriler siliniyor.
        parent::boot();

        static::deleting(function($contents) {
            $contents->faq()->delete();
        });
    }

    public function getTableReview(){
        $faq_all = $this->select('id','title','status')->get();
        foreach($faq_all as $all){
            if(empty($all->title)){
                $all->title="";
            }
            $all->status = statusView($all->status);

            $show_route = route('faq.show',[$all->id]);
            $destroy_route = route('faq.destroy',[$all->id]);
            $all->actions = "<a class='table-action hover-primary' href='$show_route'><i class='ti-pencil'></i></a>
<button type='button' class='table-action btn btn-pure deleteButton hover-danger' data-id='$all->id' data-action = '$destroy_route' data-table='#faq_table'><i class='ti-trash'></i></button>
";
        }
        return $faq_all;
    }
}
