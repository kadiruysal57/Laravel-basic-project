<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class form extends Model
{
    use HasFactory;
    protected $fillable = [
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
        return $this->hasMany(form_input::class,'form_id','id')->where('status',1);
    }
}
