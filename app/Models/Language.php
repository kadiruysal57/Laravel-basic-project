<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Lang;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_name',
        'slug',
        'status',
        'main_language',
    ];
    protected $table = 'language';


    public function getTableReview(){
        $language_all = $this->select('id','name','short_name','slug','main_language')->where('status','!=',3)->get();
        $current_mother_language = Lang::get("language.current_mother_language");
        $change_mother_language = Lang::get("language.change_mother_language");


        foreach($language_all as $lg){
            if($lg->main_language == 1){
                $lg->main_language = '<button type="button"
                                                    class="btn btn-gray btn-sm">'.$current_mother_language.'</button>';
            }else{
                $lg->main_language = '<button type="button"
                                                    class="btn btn-success btn-sm">'.$change_mother_language.'</button>';
            }
            $route_destroy = route('language.destroy',[$lg->id]);
            $route_show = route('language.store',[$lg->id]);
            $lg->action = '
            <button class="table-action hover-primary btn btn-pure updateButtonLanguage" onclick="language_update()" data-toggle="modal" data-target="#language-edit-modal"  data-id="'.$lg->id.'" data-action = "'.$route_show.'" ><i class="ti-pencil"></i></button>

                                         <button class="table-action hover-danger btn btn-pure deleteButton" data-id="'.$lg->id.'" data-action = "'.$route_destroy.'" data-table=".language_table" ><i class="ti-trash"></i></button>';

        }
        return $language_all;
    }
}