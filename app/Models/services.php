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
        return $this->hasMany(services_list::class,'services_id','id')->where('status',1);
    }
    public function services_one(){
        return $this->hasOne(services_list::class,'services_id','id')->where('status',1);
    }
}
