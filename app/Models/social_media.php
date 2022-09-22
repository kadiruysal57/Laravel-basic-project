<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class social_media extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'name',
        'link',
        'link_target',
        'sitesettings_id',
        'add_user',
        'update_user',
    ];
    protected $table = 'social_media';
    public function getTableReview($sitesettings_id){
        $social_all = $this->select('id','icon','name','link','link_target')->where('sitesettings_id',$sitesettings_id)->get();
        foreach($social_all as $sc){
            $src = $sc->icon;
            $sc->icon = "<i class='fa $src'></i>";
            $route_destroy = route('social-media.destroy',[$sc->id]);
            $route_update = route('social-media.update',['show_social']);

            $link_target = null;
            if($sc->link_target == 1){
                $sc->link_target = "_SELF";
            }else{
                $sc->link_target = "_BLANK";
            }

            $delete_button = '
            <button type="button" class="table-action hover-danger btn btn-pure deleteButton" data-id="'.$sc->id.'" data-action = "'.$route_destroy.'" data-table="#social_media_table'.$sitesettings_id.'" ><i class="ti-trash"></i></button>';


            $sc->action = '
            <button type="button" class="table-action hover-primary btn btn-pure social_media_add_modal" data_socialmediaid="'.$sc->id.'" data-settingsid="'.$sitesettings_id.'" data-action="'.$route_update.'" ><i class="ti-pencil"></i></button>

                                         '.$delete_button;

            unset($sc->id);
        }
        return $social_all;
    }
}
