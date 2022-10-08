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
            $array_ony = array_only($contents->blok_file->where('group_id',$b->id)->where('html','==',null)->toArray(),'blok_files_id');
            if($b->group_file->whereNotIn('id',$array_ony)->count()>0){
                $file_array[$b->name."_nestable"] = '<ol class="dd-list">';
                foreach ($b->group_file->whereNotIn('id',$array_ony) as $bf){
                    $html_button = "";
                    $html_class = "";
                    if($bf->type == 2){
                        $html_button = "<button type='button' data-id='$bf->id' class='btn btn-outline-primary btn-sm html_blok_edit'>
                                <i class='fa fa-gears'></i>
                            </button>";
                        $html_class="html_blok".$bf->id;
                    }
                    $file_array[$b->name."_nestable"] .= '<li class="dd-item '.$html_class.'"
                                                                                data-groupid="'.$bf->group_id.'"
                                                                                data-pagefileid ="0"
                                                                                data-id="'.$bf->id.'"
                                                                                data-html="">
                                                                                '.$html_button.'
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
                $html_button = "";
                $html_class = "";
                if($tp->file_name->type == 2){
                    $html_button = "<button type='button' data-id='$tp->id' class='btn btn-outline-primary btn-sm html_blok_edits'>
                                <i class='fa fa-gears'></i>
                            </button>";
                    $html_class="html_bloks".$tp->id;
                }
                $file_array['top_blok_nestable'] .= ' <li class="dd-item '.$html_class.'"
                                                                                data-groupid="'.$tp->group_id.'"
                                                                                data-pagefileid ="'.$tp->id.'"
                                                                                data-id="'.$tp->blok_files_id.'"
                                                                                data-html="'.$tp->html.'">
                                                                                '.$html_button.'
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
                $html_button = "";
                $html_class = "";
                if($tp->file_name->type == 2){
                    $html_button = "<button type='button' data-id='$tp->id' class='btn btn-outline-primary btn-sm html_blok_edits'>
                                <i class='fa fa-gears'></i>
                            </button>";
                    $html_class="html_bloks".$tp->id;
                }
                $file_array['left_blok_nestable'] .= ' <li class="dd-item '.$html_class.'"
                                                                                data-groupid="'.$tp->group_id.'"
                                                                                data-pagefileid ="'.$tp->id.'"
                                                                                data-id="'.$tp->blok_files_id.'"
                                                                                data-html="'.$tp->html.'">
                                                                                '.$html_button.'
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
                $html_button = "";
                $html_class = "";
                if($tp->file_name->type == 2){
                    $html_button = "<button type='button' data-id='$tp->id' class='btn btn-outline-primary btn-sm html_blok_edits'>
                                <i class='fa fa-gears'></i>
                            </button>";
                    $html_class="html_bloks".$tp->id;
                }
                $file_array['mid_blok_fix_nestable'] .= ' <li class="dd-item '.$html_class.'"
                                                                                data-groupid="'.$tp->group_id.'"
                                                                                data-pagefileid ="'.$tp->id.'"
                                                                                data-id="'.$tp->blok_files_id.'"
                                                                                data-html="'.$tp->html.'">
                                                                                '.$html_button.'
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
                $html_button = "";
                $html_class = "";
                if($tp->file_name->type == 2){
                    $html_button = "<button type='button' data-id='$tp->id' class='btn btn-outline-primary btn-sm html_blok_edits'>
                                <i class='fa fa-gears'></i>
                            </button>";
                    $html_class="html_bloks".$tp->id;
                }
                $file_array['right_blok_nestable'] .= ' <li class="dd-item '.$html_class.'"
                                                                                data-groupid="'.$tp->group_id.'"
                                                                                data-pagefileid ="'.$tp->id.'"
                                                                                data-id="'.$tp->blok_files_id.'"
                                                                                data-html="'.$tp->html.'">
                                                                                '.$html_button.'
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
                $html_button = "";
                $html_class = "";
                if($tp->file_name->type == 2){
                    $html_button = "<button type='button' data-id='$tp->id' class='btn btn-outline-primary btn-sm html_blok_edits'>
                                <i class='fa fa-gears'></i>
                            </button>";
                    $html_class="html_bloks".$tp->id;
                }
                $file_array['footer_blok_nestable'] .= ' <li class="dd-item '.$html_class.'"
                                                                                data-groupid="'.$tp->group_id.'"
                                                                                data-pagefileid ="'.$tp->id.'"
                                                                                data-id="'.$tp->blok_files_id.'"
                                                                                data-html="'.$tp->html.'"
                                                                                >
                                                                                '.$html_button.'
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

            $array_ony = array_only($default_blok->blok_file->where('group_id',$b->id)->where('html','==',null)->toArray(),'blok_files_id');
            if($b->group_file->whereNotIn('id',$array_ony)->count()>0){
                $file_array[$b->name."_nestable"] = '<ol class="dd-list">';
                foreach ($b->group_file->whereNotIn('id',$array_ony) as $bf){
                    $html_button = "";
                    $html_class = "";
                    if($bf->type == 2){
                        $html_button = "<button type='button' data-id='$bf->id' class='btn btn-outline-primary btn-sm html_blok_edit'>
                                <i class='fa fa-gears'></i>
                            </button>";
                        $html_class="html_bloks".$bf->id;
                    }
                    $blok_name = __('contents.'.$bf->name);
                    $file_array[$b->name."_nestable"] .= "<li class='dd-item $html_class'
                                                            data-groupid='$bf->group_id'
                                                            data-pagefileid ='0'
                                                            data-id='$bf->id'
                                                            data-html='$bf->html'>
                                                            $html_button
                                                            <div
                                                                class='dd-handle'>$blok_name</div>

                                                        </li>";
                }
                $file_array[$b->name."_nestable"] .= "</ol>";
            }
        }


        $file_array['top_blok_nestable'] = null;
        if($default_blok->blok_file->where('main_blok_id',1)->count() > 0){
            $file_array['top_blok_nestable'] .= '<ol class="dd-list">';
            foreach($default_blok->blok_file->where('main_blok_id',1) as $tp){
                $html_button = "";
                $html_class = "";
                if($tp->file_name->type == 2){
                    $html_button = "<button type='button' data-id='$tp->id' class='btn btn-outline-primary btn-sm html_blok_edits'>
                                <i class='fa fa-gears'></i>
                            </button>";
                    $html_class="html_bloks".$tp->id;
                }
                $blok_name = __('contents.'.$tp->file_name->name);
                $route_delete = route('blok-management.store');
                $file_array['top_blok_nestable'] .= "<li class='dd-item $html_class'
                                                        data-groupid='$tp->group_id'
                                                        data-pagefileid ='$tp->id'
                                                        data-id='$tp->blok_files_id'
                                                        data-html='$tp->html'>
                                                        $html_button
                                                        <div
                                                            class='dd-handle'>$blok_name
                                                        </div>
                                                        <div class='dd-handetrash' data-defaultblokid='$default_blok->id' data-id='$tp->id' action='$route_delete'>
                                                            <i class='fa fa-trash'></i>
                                                        </div>
                                                    </li>";
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
                $html_button = "";
                $html_class = "";
                if($tp->file_name->type == 2){
                    $html_button = "<button type='button' data-id='$tp->id' class='btn btn-outline-primary btn-sm html_blok_edits'>
                                <i class='fa fa-gears'></i>
                            </button>";
                    $html_class="html_bloks".$tp->id;
                }

                $blok_name = __('contents.'.$tp->file_name->name);
                $route_delete = route('blok-management.store');
                $file_array['left_blok_nestable'] .= "<li class='dd-item $html_class'
                                                        data-groupid='$tp->group_id'
                                                        data-pagefileid ='$tp->id'
                                                        data-id='$tp->blok_files_id'
                                                        data-html='$tp->html'>
                                                        $html_button
                                                        <div
                                                            class='dd-handle'>$blok_name
                                                        </div>
                                                        <div class='dd-handetrash' data-defaultblokid='$default_blok->id' data-id='$tp->id' action='$route_delete'>
                                                            <i class='fa fa-trash'></i>
                                                        </div>
                                                    </li>";
            }
            $file_array['left_blok_nestable'] .= '</ol>';
        }else{
            $file_array['left_blok_nestable'] .= '<div class="dd-empty"></div>';
        }

        $file_array['mid_blok_fix_nestable'] = null;
        if($default_blok->blok_file->where('main_blok_id',3)->count() > 0){
            $file_array['mid_blok_fix_nestable'] .= '<ol class="dd-list">';
            foreach($default_blok->blok_file->where('main_blok_id',3) as $tp){
                $html_button = "";
                $html_class = "";
                if($tp->file_name->type == 2){
                    $html_button = "<button type='button' data-id='$tp->id' class='btn btn-outline-primary btn-sm html_blok_edits'>
                                <i class='fa fa-gears'></i>
                            </button>";
                    $html_class="html_bloks".$tp->id;
                }

                $blok_name = __('contents.'.$tp->file_name->name);
                $route_delete = route('blok-management.store');
                $file_array['mid_blok_fix_nestable'] .= "<li class='dd-item $html_class'
                                                        data-groupid='$tp->group_id'
                                                        data-pagefileid ='$tp->id'
                                                        data-id='$tp->blok_files_id'
                                                        data-html='$tp->html'>
                                                        $html_button
                                                        <div
                                                            class='dd-handle'>$blok_name
                                                        </div>
                                                        <div class='dd-handetrash' data-defaultblokid='$default_blok->id' data-id='$tp->id' action='$route_delete'>
                                                            <i class='fa fa-trash'></i>
                                                        </div>
                                                    </li>";
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
                $html_button = "";
                $html_class = "";
                if($tp->file_name->type == 2){
                    $html_button = "<button type='button' data-id='$tp->id' class='btn btn-outline-primary btn-sm html_blok_edits'>
                                <i class='fa fa-gears'></i>
                            </button>";
                    $html_class="html_bloks".$tp->id;
                }

                $blok_name = __('contents.'.$tp->file_name->name);
                $route_delete = route('blok-management.store');
                $file_array['right_blok_nestable'] .= "<li class='dd-item $html_class'
                                                        data-groupid='$tp->group_id'
                                                        data-pagefileid ='$tp->id'
                                                        data-id='$tp->blok_files_id'
                                                        data-html='$tp->html'>
                                                        $html_button
                                                        <div
                                                            class='dd-handle'>$blok_name
                                                        </div>
                                                        <div class='dd-handetrash' data-defaultblokid='$default_blok->id' data-id='$tp->id' action='$route_delete'>
                                                            <i class='fa fa-trash'></i>
                                                        </div>
                                                    </li>";
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
                $html_button = "";
                $html_class = "";
                if($tp->file_name->type == 2){
                    $html_button = "<button type='button' data-id='$tp->id' class='btn btn-outline-primary btn-sm html_blok_edits'>
                                <i class='fa fa-gears'></i>
                            </button>";
                    $html_class="html_bloks".$tp->id;
                }

                $blok_name = __('contents.'.$tp->file_name->name);
                $route_delete = route('blok-management.store');
                $file_array['footer_blok_nestable'] .= "<li class='dd-item $html_class'
                                                        data-groupid='$tp->group_id'
                                                        data-pagefileid ='$tp->id'
                                                        data-id='$tp->blok_files_id'
                                                        data-html='$tp->html'>
                                                        $html_button
                                                        <div
                                                            class='dd-handle'>$blok_name
                                                        </div>
                                                        <div class='dd-handetrash' data-defaultblokid='$default_blok->id' data-id='$tp->id' action='$route_delete'>
                                                            <i class='fa fa-trash'></i>
                                                        </div>
                                                    </li>";
            }
            $file_array['footer_blok_nestable'] .= '</ol>';
        }
        else{
            $file_array['footer_blok_nestable'] .= '<div class="dd-empty"></div>';
        }

        return $file_array;
    }
}
