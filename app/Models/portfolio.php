<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class portfolio extends Model
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
    protected $table = 'portfolio';
    public function portfolio_select_group(){
        return $this->hasMany(portfolio_select_group::class,'portfolio_id','id');
    }

    public static function boot() {

        //burasının amacı content verisi silinme kodu çalıştığı zaman yani delete() bağlantılı olan tablolardan da veriler siliniyor.
        parent::boot();

        static::deleting(function($contents) {
            $contents->portfolio_select_group()->delete();
        });
    }
    public function getTableReview(){
        $portfolio_all = $this->select('id','title','description','status')->get();
        foreach($portfolio_all as $all){
            if(empty($all->title)){
                $all->title="";
            }
            $all->status = statusView($all->status);

            $show_route = route('portfolio.show',[$all->id]);
            $destroy_route = route('portfolio.destroy',[$all->id]);
            $all->actions = "<a class='table-action hover-primary' href='$show_route'><i class='ti-pencil'></i></a>
<button type='button' class='table-action btn btn-pure deleteButton hover-danger' data-id='$all->id' data-action = '$destroy_route' data-table='#portfolio_table'><i class='ti-trash'></i></button>
";
        }
        return $portfolio_all;
    }
}
