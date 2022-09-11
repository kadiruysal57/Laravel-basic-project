<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'permission_role',
        'email',
        'status',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getTableReview(){
        $users = $this->select('id','name','email','status')->get();
        foreach ($users as $u){
            $u->actions = ' <a class="table-action hover-primary" href="'.route('users.show',[$u->id]).'"><i class="ti-pencil"></i></a>
                                                <button type="button" class="table-action btn btn-pure deleteButton hover-danger" data-id="'.$u->id.'" data-action = "'.route('users.destroy',[$u->id]).'" data-table="#users_table"><i class="ti-trash"></i></button>';
            unset($u->id);
            unset($u->seo_url);
        }
        return $users;
    }
    public function permission(){
        return $this->hasOne(permission::class,'id','permission_role');
    }
}
