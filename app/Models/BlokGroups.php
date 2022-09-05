<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlokGroups extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
        'file_url',
    ];
    protected $table = 'blok_groups';

    public function group_file(){
        return $this->hasMany(BlokFiles::class,'group_id','id');
    }

    public function content_blok_file($id){
        $contents = Contents::where('id',$id)->first();
        $blok_group = $this->where('status',1)->get();
        $file_array = array();
        foreach ($blok_group as $b){
            $array_ony = array_only($contents->blok_file->where('group_id',$b->id)->toArray(),'blok_files_id');
            if($b->group_file->whereNotIn('id',$array_ony)->count()>0){
                $file_array[$b->name."_nestable"] = '<ol class="dd-list">';
                foreach ($b->group_file->whereNotIn('id',$array_ony) as $bf){
                    $file_array[$b->name."_nestable"] .= '<li class="dd-item"
                                                                                data-groupid="'.$bf->group_id.'"
                                                                                data-pagefileid ="0"
                                                                                data-id="'.$bf->id.'">
                                                                                <div
                                                                                    class="dd-handle">'.__('contents.'.$bf->name).'</div>
                                                                            </li>';
                }
                $file_array[$b->name."_nestable"] .= "</ol>";
            }

        }


        $file_array['top_blok_nestable'] = null;
        if($contents->blok_file->where('main_blok_id',1)->count() > 0){
            $file_array['top_blok_nestable'] .= '<ol class="dd-list">';
            foreach($contents->blok_file->where('main_blok_id',1) as $tp){
                $file_array['top_blok_nestable'] .= ' <li class="dd-item"
                                                                                data-groupid="'.$tp->group_id.'"
                                                                                data-pagefileid ="'.$tp->id.'"
                                                                                data-id="'.$tp->blok_files_id.'">
                                                                                <div
                                                                                    class="dd-handle">'.__('contents.'.$tp->file_name->name).'
                                                                                </div>
                                                                                <div class="dd-handetrash" data-contentsid="'.$contents->id.'" data-id="'.$tp->id.'" action="'.route('contents.store').'">
                                                                                     <i class="fa fa-trash"></i>
                                                                                </div>
                                                                            </li>';
            }
            $file_array['top_blok_nestable'] .= '</ol>';
        }
        else{
            $file_array['top_blok_nestable'] .= '<div class="dd-empty"></div>';
        }

        $file_array['left_blok_nestable'] = null;
        if($contents->blok_file->where('main_blok_id',2)->count() > 0){
            $file_array['left_blok_nestable'] .= '<ol class="dd-list">';
            foreach($contents->blok_file->where('main_blok_id',2) as $tp){
                $file_array['left_blok_nestable'] .= ' <li class="dd-item"
                                                                                data-groupid="'.$tp->group_id.'"
                                                                                data-pagefileid ="'.$tp->id.'"
                                                                                data-id="'.$tp->blok_files_id.'">
                                                                                <div
                                                                                    class="dd-handle">'.__('contents.'.$tp->file_name->name).'
                                                                                </div>
                                                                                <div class="dd-handetrash" data-contentsid="'.$contents->id.'" data-id="'.$tp->id.'" action="'.route('contents.store').'">
                                                                                     <i class="fa fa-trash"></i>
                                                                                </div>
                                                                            </li>';
            }
            $file_array['left_blok_nestable'] .= '</ol>';
        }else{
            $file_array['left_blok_nestable'] .= '<div class="dd-empty"></div>';
        }

        $file_array['mid_blok_fix_nestable'] = null;
        if($contents->blok_file->where('main_blok_id',3)->count() > 0){
            $file_array['mid_blok_fix_nestable'] .= '<ol class="dd-list">';
            foreach($contents->blok_file->where('main_blok_id',3) as $tp){
                $file_array['mid_blok_fix_nestable'] .= ' <li class="dd-item"
                                                                                data-groupid="'.$tp->group_id.'"
                                                                                data-pagefileid ="'.$tp->id.'"
                                                                                data-id="'.$tp->blok_files_id.'">
                                                                                <div
                                                                                    class="dd-handle">'.__('contents.'.$tp->file_name->name).'
                                                                                </div>
                                                                                <div class="dd-handetrash" data-contentsid="'.$contents->id.'" data-id="'.$tp->id.'" action="'.route('contents.store').'">
                                                                                     <i class="fa fa-trash"></i>
                                                                                </div>
                                                                            </li>';
            }
            $file_array['mid_blok_fix_nestable'] .= '</ol>';
        }
        else{
            $file_array['mid_blok_fix_nestable'] .= '<div class="dd-empty"></div>';
        }

        $file_array['right_blok_nestable'] = null;
        if($contents->blok_file->where('main_blok_id',4)->count() > 0){
            $file_array['right_blok_nestable'] .= '<ol class="dd-list">';
            foreach($contents->blok_file->where('main_blok_id',4) as $tp){
                $file_array['right_blok_nestable'] .= ' <li class="dd-item"
                                                                                data-groupid="'.$tp->group_id.'"
                                                                                data-pagefileid ="'.$tp->id.'"
                                                                                data-id="'.$tp->blok_files_id.'">
                                                                                <div
                                                                                    class="dd-handle">'.__('contents.'.$tp->file_name->name).'
                                                                                </div>
                                                                                <div class="dd-handetrash" data-contentsid="'.$contents->id.'" data-id="'.$tp->id.'" action="'.route('contents.store').'">
                                                                                     <i class="fa fa-trash"></i>
                                                                                </div>
                                                                            </li>';
            }
            $file_array['right_blok_nestable'] .= '</ol>';
        }
        else{
            $file_array['right_blok_nestable'] .= '<div class="dd-empty"></div>';
        }

        $file_array['footer_blok_nestable'] = null;
        if($contents->blok_file->where('main_blok_id',5)->count() > 0){
            $file_array['footer_blok_nestable'] .= '<ol class="dd-list">';
            foreach($contents->blok_file->where('main_blok_id',5) as $tp){
                $file_array['footer_blok_nestable'] .= ' <li class="dd-item"
                                                                                data-groupid="'.$tp->group_id.'"
                                                                                data-pagefileid ="'.$tp->id.'"
                                                                                data-id="'.$tp->blok_files_id.'">
                                                                                <div
                                                                                    class="dd-handle">'.__('contents.'.$tp->file_name->name).'
                                                                                </div>
                                                                                <div class="dd-handetrash" data-contentsid="'.$contents->id.'" data-id="'.$tp->id.'" action="'.route('contents.store').'">
                                                                                     <i class="fa fa-trash"></i>
                                                                                </div>
                                                                            </li>';
            }
            $file_array['footer_blok_nestable'] .= '</ol>';
        }
        else{
            $file_array['footer_blok_nestable'] .= '<div class="dd-empty"></div>';
        }

        return $file_array;
    }
    public function default_blok_file($id){
        $default_blok = DefaultBlok::where('id',$id)->first();
        $blok_group = $this->where('status',1)->get();
        $file_array = array();
        foreach ($blok_group as $b){
            $array_ony = array_only($default_blok->blok_file->where('group_id',$b->id)->toArray(),'blok_files_id');
            if($b->group_file->whereNotIn('id',$array_ony)->count()>0){
                $file_array[$b->name."_nestable"] = '<ol class="dd-list">';
                foreach ($b->group_file->whereNotIn('id',$array_ony) as $bf){
                    $file_array[$b->name."_nestable"] .= '<li class="dd-item"
                                                                                data-groupid="'.$bf->group_id.'"
                                                                                data-pagefileid ="0"
                                                                                data-id="'.$bf->id.'">
                                                                                <div
                                                                                    class="dd-handle">'.__('contents.'.$bf->name).'</div>
                                                                            </li>';
                }
                $file_array[$b->name."_nestable"] .= "</ol>";
            }
        }


        $file_array['top_blok_nestable'] = null;
        if($default_blok->blok_file->where('main_blok_id',1)->count() > 0){
            $file_array['top_blok_nestable'] .= '<ol class="dd-list">';
            foreach($default_blok->blok_file->where('main_blok_id',1) as $tp){
                $file_array['top_blok_nestable'] .= ' <li class="dd-item"
                                                                                data-groupid="'.$tp->group_id.'"
                                                                                data-pagefileid ="'.$tp->id.'"
                                                                                data-id="'.$tp->blok_files_id.'">
                                                                                <div
                                                                                    class="dd-handle">'.__('contents.'.$tp->file_name->name).'
                                                                                </div>
                                                                                <div class="dd-handetrash" data-defaultblokid="'.$default_blok->id.'" data-id="'.$tp->id.'" action="'.route('blok-management.store').'">
                                                                                     <i class="fa fa-trash"></i>
                                                                                </div>
                                                                            </li>';
            }
            $file_array['top_blok_nestable'] .= '</ol>';
        }
        else{
            $file_array['top_blok_nestable'] .= '<div class="dd-empty"></div>';
        }

        $file_array['left_blok_nestable'] = null;
        if($default_blok->blok_file->where('main_blok_id',2)->count() > 0){
            $file_array['left_blok_nestable'] .= '<ol class="dd-list">';
            foreach($default_blok->blok_file->where('main_blok_id',2) as $tp){
                $file_array['left_blok_nestable'] .= ' <li class="dd-item"
                                                                                data-groupid="'.$tp->group_id.'"
                                                                                data-pagefileid ="'.$tp->id.'"
                                                                                data-id="'.$tp->blok_files_id.'">
                                                                                <div
                                                                                    class="dd-handle">'.__('contents.'.$tp->file_name->name).'
                                                                                </div>
                                                                                <div class="dd-handetrash" data-defaultblokid="'.$default_blok->id.'" data-id="'.$tp->id.'" action="'.route('blok-management.store').'">
                                                                                     <i class="fa fa-trash"></i>
                                                                                </div>
                                                                            </li>';
            }
            $file_array['left_blok_nestable'] .= '</ol>';
        }else{
            $file_array['left_blok_nestable'] .= '<div class="dd-empty"></div>';
        }

        $file_array['mid_blok_fix_nestable'] = null;
        if($default_blok->blok_file->where('main_blok_id',3)->count() > 0){
            $file_array['mid_blok_fix_nestable'] .= '<ol class="dd-list">';
            foreach($default_blok->blok_file->where('main_blok_id',3) as $tp){
                $file_array['mid_blok_fix_nestable'] .= ' <li class="dd-item"
                                                                                data-groupid="'.$tp->group_id.'"
                                                                                data-pagefileid ="'.$tp->id.'"
                                                                                data-id="'.$tp->blok_files_id.'">
                                                                                <div
                                                                                    class="dd-handle">'.__('contents.'.$tp->file_name->name).'
                                                                                </div>
                                                                                <div class="dd-handetrash" data-defaultblokid="'.$default_blok->id.'" data-id="'.$tp->id.'" action="'.route('blok-management.store').'">
                                                                                     <i class="fa fa-trash"></i>
                                                                                </div>
                                                                            </li>';
            }
            $file_array['mid_blok_fix_nestable'] .= '</ol>';
        }
        else{
            $file_array['mid_blok_fix_nestable'] .= '<div class="dd-empty"></div>';
        }

        $file_array['right_blok_nestable'] = null;
        if($default_blok->blok_file->where('main_blok_id',4)->count() > 0){
            $file_array['right_blok_nestable'] .= '<ol class="dd-list">';
            foreach($default_blok->blok_file->where('main_blok_id',4) as $tp){
                $file_array['right_blok_nestable'] .= ' <li class="dd-item"
                                                                                data-groupid="'.$tp->group_id.'"
                                                                                data-pagefileid ="'.$tp->id.'"
                                                                                data-id="'.$tp->blok_files_id.'">
                                                                                <div
                                                                                    class="dd-handle">'.__('contents.'.$tp->file_name->name).'
                                                                                </div>
                                                                                <div class="dd-handetrash" data-defaultblokid="'.$default_blok->id.'" data-id="'.$tp->id.'" action="'.route('blok-management.store').'">
                                                                                     <i class="fa fa-trash"></i>
                                                                                </div>
                                                                            </li>';
            }
            $file_array['right_blok_nestable'] .= '</ol>';
        }
        else{
            $file_array['right_blok_nestable'] .= '<div class="dd-empty"></div>';
        }

        $file_array['footer_blok_nestable'] = null;
        if($default_blok->blok_file->where('main_blok_id',5)->count() > 0){
            $file_array['footer_blok_nestable'] .= '<ol class="dd-list">';
            foreach($default_blok->blok_file->where('main_blok_id',5) as $tp){
                $file_array['footer_blok_nestable'] .= ' <li class="dd-item"
                                                                                data-groupid="'.$tp->group_id.'"
                                                                                data-pagefileid ="'.$tp->id.'"
                                                                                data-id="'.$tp->blok_files_id.'">
                                                                                <div
                                                                                    class="dd-handle">'.__('contents.'.$tp->file_name->name).'
                                                                                </div>
                                                                                <div class="dd-handetrash" data-defaultblokid="'.$default_blok->id.'" data-id="'.$tp->id.'" action="'.route('blok-management.store').'">
                                                                                     <i class="fa fa-trash"></i>
                                                                                </div>
                                                                            </li>';
            }
            $file_array['footer_blok_nestable'] .= '</ol>';
        }
        else{
            $file_array['footer_blok_nestable'] .= '<div class="dd-empty"></div>';
        }

        return $file_array;
    }
}
