<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fixed_language_word extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'lang_id',
        'code_name',
        'word',
        'lock',
        'add_user',
        'update_user',
    ];
    protected $table = 'fixed_language_word';

    public function getWordAdd($count){
        $code_name = __('fixed_word.code_name');
        $fixed_word = __('fixed_word.word');
        $languages = Language::where('status',1)->orderBy('main_language','asc')->get();
        $lanugage_option = "";
        foreach($languages as $l){
            $lanugage_option .= "<option value='$l->id'>$l->name</option>";
        }

        $return_data = array();
        $return_data[1]['code_name'] = "<input type='text' class='form-control' name='code_name$count' placeholder='$code_name'>";
        $return_data[1]['fixed_word'] = "<input type='text' class='form-control' name='fixed_word$count' placeholder='$fixed_word'>";
        $return_data[1]['languages'] = "<select name='languages$count' class='form-control'>$lanugage_option</select>";
        $return_data[1]['action'] = "<button type='button' class='btn btn-danger btn-sm delete_fixed_word mt-2' data-count='$count'><i class='fa fa-trash'></i></button>
                                     <button type='submit' class='btn btn-primary btn-sm mt-2'><i class='fa fa-save'></i></button>";
        return $return_data;
    }

    public function getTableReview(){

        $code_name = __('fixed_word.code_name');
        $fixed_word = __('fixed_word.word');

        $all_word = $this->select('id','lock','lang_id','code_name','word')->get();
        $languages = Language::where('status',1)->orderBy('main_language','asc')->get();
        foreach($all_word as $key => $all){
            $readonly = null;
            if($all->lock == 1){
                $readonly = 'readonly=""';
            }
            $delete_route = route('fixed-word.destroy',[$all->id]);
            $lanugage_option = "";
            foreach($languages as $l){
                if($all->lang_id == $l->id){
                    $lanugage_option .= "<option selected='' value='$l->id'>$l->name</option>";
                }else{
                    $lanugage_option .= "<option value='$l->id'>$l->name</option>";
                }
            }
            $all->code_name = "<input $readonly type='text' class='form-control' name='code_names$all->id' value='$all->code_name' placeholder='$code_name'>";
            $all->word = "<input type='text' class='form-control' name='fixed_words$all->id' value='$all->word' placeholder='$fixed_word'>";
            $all->language = "<select $readonly name='languages_s$all->id' class='form-control'>$lanugage_option</select>";

            $deletebutton = null;
            if($all->lock == 2){
                $deletebutton = "<button type='button' class='btn btn-danger btn-sm deleteButton mt-2' data-id='$all->id' data-action = '$delete_route' data-table='#fixed_word_table'><i class='fa fa-trash'></i></button>";
            }
            $all->action = "$deletebutton
                            <button type='submit' class='btn btn-primary btn-sm mt-2'><i class='fa fa-save'></i></button>";
            unset($all->lang_id);
            unset($all->id);
            unset($all->lock);
        }
        return $all_word;
    }
}
