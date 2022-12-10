<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class form extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'title',
        'to',
        'from',
        'subject',
        'file_attachment',
        'additional_headers',
        'message_body',
        'form_type',
        'form_url',
        'form_title',
        'form_desc',
        'status',
        'add_user',
        'update_user',
    ];
    protected $table = 'form';
    public function form_input(){
        return $this->hasMany(form_input::class,'form_id','id')->where('status',1)->orderBy('order_input');
    }

    public function form_send(){
        return $this->hasMany(form_send::class,'form_id','id');
    }

    public function getTableReview(){
        $form_all = $this->select('id','name')->where('status',1)->get();
        foreach ($form_all as $f){
            $f->actions = ' <a class="table-action hover-primary" href="'.route('form-builder.show',[$f->id]).'"><i class="ti-pencil"></i></a>
                                                <button type="button" class="table-action btn btn-pure deleteButton hover-danger" data-id="'.$f->id.'" data-action = "'.route('form-builder.destroy',[$f->id]).'" data-table="#form-builder-form"><i class="ti-trash"></i></button>';
            unset($f->id);
        }
        return $form_all;
    }

    public static function boot() {

        //burasının amacı form verisi silinme kodu çalıştığı zaman yani delete() bağlantılı olan tablolardan da veriler siliniyor.
        parent::boot();
        static::deleting(function($form) {
            foreach ($form->form_input as $fi){
                $fi->form_input_value_many()->delete();
            }
            $form->form_input()->delete();
        });
    }
}
