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
    public function services_one(){
        return $this->hasOne(services_list::class,'services_id','id')->where('status',1);
    }
    public function services_one_first(){
        return $this->hasOne(services_list::class,'services_id','id')->orderBy('list_order','asc')->where('status',1);
    }
}
