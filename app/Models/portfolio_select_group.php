<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class portfolio_select_group extends Model
{
    use HasFactory;
    protected $fillable = [
        'portfolio_group_id',
        'portfolio_id',
        'add_user',
        'update_user',
    ];
    protected $table = 'portfolio_select_group';

    public function portfolio_group(){
        return $this->hasMany(portfolio_group::class,'id','portfolio_group_id');
    }
}
