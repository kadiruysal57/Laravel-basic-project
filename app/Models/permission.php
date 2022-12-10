<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'add_user',
        'update_user'
    ];

    protected $table = 'permission_table';
    public function users_roles(){
        return $this->hasMany(userroles::class,'permission_id','id');
    }

    public function getTableReview(){
        $permission_all = $this->select('id','name','status')->where('status',1)->get();
        foreach ($permission_all as $p){
            $p->actions = ' <a class="table-action hover-primary" href="'.route('permission.show',[$p->id]).'"><i class="ti-pencil"></i></a>
                                                <button type="button" class="table-action btn btn-pure deleteButton hover-danger" data-id="'.$p->id.'" data-action = "'.route('permission.destroy',[$p->id]).'" data-table="#permission"><i class="ti-trash"></i></button>';
            unset($p->id);
        }
        return $permission_all;
    }
    public static function boot() {

        //burasının amacı form verisi silinme kodu çalıştığı zaman yani delete() bağlantılı olan tablolardan da veriler siliniyor.
        parent::boot();
        static::deleting(function($permission) {
            $permission->users_roles()->delete();
        });
    }
}
