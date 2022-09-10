<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class form_input extends Model
{
    use HasFactory;
    protected $fillable = [
        'input_id',
        'form_id',
        'name',
        'required',
        'placeholder_use',
        'id_attr',
        'class_attr',
        'placeholder',
        'status',
        'active_passive',
        'order_input',
        'add_user',
        'update_user'
    ];

    protected $table = 'form_input';

    public function input_type(){
        return $this->hasOne(input_type::class,'id','input_id');
    }
    public function form(){
        return $this->hasMany(form::class,'id','form_id');
    }
    public function form_input_value_many(){
        return $this->hasMany(form_input_value::class,'form_input_id','id');
    }
    public function form_input_value_one(){
        return $this->hasOne(form_input_value::class,'form_input_id','id');
    }
    public static function boot() {

        //burasının amacı form verisi silinme kodu çalıştığı zaman yani delete() bağlantılı olan tablolardan da veriler siliniyor.
        parent::boot();

        static::deleting(function($form) {
            $form->form_input_value_many()->delete();
        });
    }
}
