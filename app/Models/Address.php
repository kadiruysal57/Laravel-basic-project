<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'site_settings_id',
        'name',
        'address',
        'gsm',
        'email',
        'maps',
    ];
    protected $table = 'address';


    public function getTableReview($sitesettings_id){
        $address_all = $this->select('id','name','address','gsm','email','maps')->where('site_settings_id',$sitesettings_id)->get();
        foreach($address_all as $sc){

            $route_destroy = route('address.destroy',[$sc->id]);
            $route_update = route('address.update',['show_address']);



            $delete_button = '
            <button type="button" class="table-action hover-danger btn btn-pure deleteButton" data-id="'.$sc->id.'" data-action = "'.$route_destroy.'" data-table="#address_table'.$sitesettings_id.'" ><i class="ti-trash"></i></button>';


            $sc->action = '
            <button type="button" class="table-action hover-primary btn btn-pure address_add_button" data_address_id="'.$sc->id.'" data-settingsid="'.$sitesettings_id.'" data-action="'.$route_update.'" ><i class="ti-pencil"></i></button>

                                         '.$delete_button;

            unset($sc->id);
        }
        return $address_all;
    }
}
