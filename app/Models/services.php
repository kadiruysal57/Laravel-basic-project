<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class services extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'status',
        'add_user',
        'update_user',
    ];

    protected $table = 'services';

    public function services_many(){
        return $this->hasMany(services_list::class,'services_id','id')->orderBy('list_order')->where('status',1);
    }
    public function services_delete(){
        return $this->hasMany(services_list::class,'services_id','id');
    }
    public function services_one(){
        return $this->hasOne(services_list::class,'services_id','id')->where('status',1);
    }
    public function services_one_first(){
        return $this->hasOne(services_list::class,'services_id','id')->orderBy('list_order','asc')->where('status',1);
    }
    public function getTableReview(){
        $services_all = $this->select('id','name')->where('status',1)->get();
        foreach ($services_all as $s){
            $s->actions = ' <a class="table-action hover-primary" href="'.route('services.show',[$s->id]).'"><i class="ti-pencil"></i></a>
                                                <button type="button" class="table-action btn btn-pure deleteButton hover-danger" data-id="'.$s->id.'" data-action = "'.route('services.destroy',[$s->id]).'" data-table="#services"><i class="ti-trash"></i></button>';
            unset($s->id);
        }
        return $services_all;
    }
    public static function boot() {

        //burasının amacı form verisi silinme kodu çalıştığı zaman yani delete() bağlantılı olan tablolardan da veriler siliniyor.
        parent::boot();
        static::deleting(function($services) {
            $services->services_delete()->delete();
        });
    }
}
