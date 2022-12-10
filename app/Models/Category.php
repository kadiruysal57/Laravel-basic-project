<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'add_user',
        'update_user',
    ];
    protected $table = 'category';

    public function category_item(){
        return $this->hasMany(category_item::class,'category_id','id');
    }
    public static function boot() {

        //burasının amacı content verisi silinme kodu çalıştığı zaman yani delete() bağlantılı olan tablolardan da veriler siliniyor.
        parent::boot();

        static::deleting(function($contents) {
            $contents->category_item()->delete();
        });
    }

    public function getTableReview(){
        $portfolio_all = $this->select('id','name','description','status')->get();
        foreach($portfolio_all as $all){

            if(empty($all->title)){
                $all->title="";
            }
            $all->status = statusView($all->status);

            $show_route = route('category.show',[$all->id]);
            $destroy_route = route('category.destroy',[$all->id]);
            $all->actions = "<a class='table-action hover-primary' href='$show_route'><i class='ti-pencil'></i></a>
<button type='button' class='table-action btn btn-pure deleteButton hover-danger' data-id='$all->id' data-action = '$destroy_route' data-table='#category_table'><i class='ti-trash'></i></button>
";
            unset($all->id);
        }
        return $portfolio_all;
    }
}
