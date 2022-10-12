<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class open_hourse extends Model
{
    use HasFactory;
    protected $fillable = [
        'site_setting_id',
        'start_day',
        'finish_day',
        'office_id',
        'start_time',
        'finish_time',
    ];
    protected $table = 'open_hourse';

    public function start_day_name(){
        return $this->hasOne(days::class,'id','start_day');
    }
    public function finish_day_name(){
        return $this->hasOne(days::class,'id','finish_day');
    }
    public function office_name(){
        return $this->hasOne(Address::class,'id','office_id');
    }
    public function getTableReview($sitesettings_id){
        $open_hourse_all = $this->select('id','start_day','finish_day','office_id','start_time','finish_time')->where('site_setting_id',$sitesettings_id)->get();
        foreach($open_hourse_all as $sc){

            $route_destroy = route('open-hourse.destroy',[$sc->id]);
            $route_update = route('open-hourse.update',['show_open_hourse']);

            $sc->start_day = __('global.'.$sc->start_day_name->name);
            $sc->finish_day = __('global.'.$sc->finish_day_name->name);
            $sc->office_id = $sc->office_name->name;

            $delete_button = '
            <button type="button" class="table-action hover-danger btn btn-pure deleteButton" data-id="'.$sc->id.'" data-action = "'.$route_destroy.'" data-table="#open_hourse_table'.$sitesettings_id.'" ><i class="ti-trash"></i></button>';


            $sc->action = '
            <button type="button" class="table-action hover-primary btn btn-pure open_hourse_add" data_openhouseid="'.$sc->id.'" data-settingsid="'.$sitesettings_id.'" data-action="'.$route_update.'" ><i class="ti-pencil"></i></button>

                                         '.$delete_button;

            unset($sc->id);
            unset($sc->finish_day_name);
            unset($sc->office_name);
            unset($sc->start_day_name);
        }
        return $open_hourse_all;
    }
}
