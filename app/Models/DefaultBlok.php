<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultBlok extends Model
{
    use HasFactory;

    protected $fillable = [
        'default_blok_name',
        'left_blok_active',
        'right_blok_active',
        'status',
        'add_user',
        'update_user',
    ];
    protected $table = 'default_blok';

    public function blok_file(){
        return $this->hasMany(DefaultBlokFile::class,'default_blok_id','id')->orderBy('blok_file_order','asc');
    }

    public function getTableReview(){
        $default_blok_all = $this->select('id','default_blok_name as name')->where('status',1)->get();
        foreach ($default_blok_all as $d){
            $d->actions = ' <a class="table-action hover-primary" href="'.route('blok-management.show',[$d->id]).'"><i class="ti-pencil"></i></a>
                                                <button type="button" class="table-action btn btn-pure deleteButton hover-danger" data-id="'.$d->id.'" data-action = "'.route('blok-management.destroy',[$d->id]).'" data-table="#default_bloks_table"><i class="ti-trash"></i></button>';
            unset($d->id);
        }
        return $default_blok_all;
    }
}
