<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class userroles extends Model
{
    use HasFactory;

    protected $fillable = [
        'permission_id',
        'roles_list_id',
        'status',
        'add_user',
        'update_user',
    ];
    protected $table = 'user_roles';

    public function roles_table(){
        return $this->hasOne(roleslist::class,'id','roles_list_id')->where('status',1);
    }
    public function CheckRole($roleName){
        return $this
            ->join('permission_table', 'permission_table.id', '=', 'user_roles.permission_id')
            ->join('users','users.permission_role','=','permission_table.id')
            ->join('roles_list','user_roles.roles_list_id','=','roles_list.id')
            ->where('roles_list.roles_name',$roleName)
            ->where('permission_table.id',Auth::user()->permission_role)
            ->first('user_roles.*');
    }
}
