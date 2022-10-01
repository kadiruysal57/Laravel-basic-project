<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class portfolio_group extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'status',
        'add_user',
        'update_user',
    ];
    protected $table = 'portfolio_group';

    public function image(){
        return $this->hasMany(portfolio_group_image::class,'portfolio_group_id','id')->orderBy('image_order','ASC');
    }

    public static function boot() {

        //burasının amacı content verisi silinme kodu çalıştığı zaman yani delete() bağlantılı olan tablolardan da veriler siliniyor.
        parent::boot();

        static::deleting(function($contents) {
            $contents->image()->delete();
        });
    }
    public function getTableReview(){
        $portfolio_all = $this->select('id','title','status')->get();
        foreach($portfolio_all as $all){
            if(empty($all->title)){
                $all->title="";
            }
            $all->status = statusView($all->status);

            $show_route = route('portfolio-group.show',[$all->id]);
            $destroy_route = route('portfolio-group.destroy',[$all->id]);
            $all->actions = "<a class='table-action hover-primary' href='$show_route'><i class='ti-pencil'></i></a>
<button type='button' class='table-action btn btn-pure deleteButton hover-danger' data-id='$all->id' data-action = '$destroy_route' data-table='#portfolio_group_table'><i class='ti-trash'></i></button>
";
        }
        return $portfolio_all;
    }
}
