<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class form_input extends Model
{
    use HasFactory;
    protected $fillable = [
        'input_id',
        'form_id',
        'name',
        'required',
        'placeholder_use',
        'id_attr',
        'class_attr',
        'placeholder',
        'status',
        'active_passive',
        'order_input',
        'add_user',
        'update_user'
    ];

    protected $table = 'form_input';

    public function input_type(){
        return $this->hasOne(input_type::class,'id','input_id');
    }
    public function form(){
        return $this->hasMany(form::class,'id','form_id');
    }
    public function form_input_value_many(){
        return $this->hasMany(form_input_value::class,'form_input_id','id');
    }
    public function form_input_value_one(){
        return $this->hasOne(form_input_value::class,'form_input_id','id');
    }
    public static function boot() {

        //burasının amacı form verisi silinme kodu çalıştığı zaman yani delete() bağlantılı olan tablolardan da veriler siliniyor.
        parent::boot();

        static::deleting(function($form) {
            $form->form_input_value_many()->delete();
        });
    }

    public function createForm($input){
        $return_input = "";
        if($input->input_id == 1 || $input->input_id == 4 || $input->input_id == 2 || $input->input_id == 7 || $input->input_id == 8){
            $return_input .= $this->createText($input);
        }elseif($input->input_id == 5){
            $return_input .= $this->createTextarea($input);
        }elseif($input->input_id == 3){
            $return_input .= $this->createSelect($input);
        }elseif($input->input_id == 6){
            $return_input .= $this->createCheckBox($input);
        }elseif($input->input_id == 9){
            $return_input .= $this->createFile($input);
        }
        return $return_input;
    }
    public function createText($fi){
        $return_text = "";
        $class = "col-12";
        $name = "";
        $id="";
        $placeholder = "";
        $required="";
        $type = "text";
        if($fi->input_id == 4){
            $type = "email";
        }elseif($fi->input_id == 2){
            $type = "number";
        }elseif($fi->input_id == 7){
            $type = "date";
        }elseif($fi->input_id == 8){
            $type = "time";
        }
        if(!empty($fi->class_attr)){
            $class = $fi->class_attr;
        }
        if(!empty($fi->name)){
            $name = Str::slug($fi->name)."".$fi->id;
        }
        if(!empty($fi->id_attr)){
            $id = $fi->id_attr;
        }
        if(!empty($fi->placeholder)){
            $placeholder = $fi->placeholder;
        }
        if(!empty($fi->required) && $fi->required == 1){
            $required ="required=''";
        }
        $return_text .="<div class='$class col-md-12 mb-10'>
                            <input type='$type' name='$name' class='form-control' $required id='$id' placeholder='$placeholder'>
                            <div class='validate'></div>
                        </div>";
        return $return_text;
    }
    public function createTextarea($fi){
        $class = "col-lg-12";
        $name = "";
        $id="";
        $placeholder = "";
        $required="";

        if(!empty($fi->class_attr)){
            $class = $fi->class_attr;
        }
        if(!empty($fi->name)){
            $name = Str::slug($fi->name)."".$fi->id;
        }
        if(!empty($fi->id_attr)){
            $id = $fi->id_attr;
        }
        if(!empty($fi->placeholder)){
            $placeholder = $fi->placeholder;
        }
        if(!empty($fi->required) && $fi->required == 1){
            $required ="required=''";
        }
        $return_text = "<div class='$class col-md-12 mb-10'><textarea class='form-control $class' name='$name' rows='5' $required id='$id' placeholder='$placeholder'></textarea><div class='validate'></div></div>";

        return $return_text;
    }
    public function createSelect($fi){
        $class = "col-lg-12";
        $name = "";
        $id="";
        $placeholder = "";
        $required="";

        if(!empty($fi->class_attr)){
            $class = $fi->class_attr;
        }
        if(!empty($fi->name)){
            $name = Str::slug($fi->name)."".$fi->id;
        }
        if(!empty($fi->id_attr)){
            $id = $fi->id_attr;
        }
        if(!empty($fi->placeholder)){
            $placeholder = $fi->placeholder;
        }
        if(!empty($fi->required) && $fi->required == 1){
            $required ="required=''";
        }
        $option = "";
        foreach($fi->form_input_value_many as $input_value){
            $option .= "<option>$input_value->default_value</option>";
        }
        $return_text = "<div class='$class col-md-12 mb-10'>
                            <select name='$name' $required id='$id' class='form-control $class'>
                            <option value=''>$placeholder</option>
                            $option
                            </select>
                            <div class='validate'></div>
                        </div>";

        return $return_text;
    }
    public function createCheckBox($fi){
        $class = "col-lg-12";
        $name = "";
        $id="";
        $placeholder = "";
        $required="";

        if(!empty($fi->class_attr)){
            $class = $fi->class_attr;
        }
        if(!empty($fi->name)){
            $name = Str::slug($fi->name)."".$fi->id."[]";
        }
        if(!empty($fi->id_attr)){
            $id = $fi->id_attr;
        }
        if(!empty($fi->placeholder)){
            $placeholder = $fi->placeholder;
        }
        if(!empty($fi->required) && $fi->required == 1){
            $required ="required=''";
        }
        $option = "";
        foreach($fi->form_input_value_many as $key=>$input_value){
            $option .= "<div class='col-lg-12 col-sm-12'><input type='checkbox' value='$input_value->default_value' name='$name' id='$id.$key'><label for='$id.$key'>$input_value->default_value</label></div>";
        }
        $return_text = "<div class='$class col-md-12 mb-10'>
                            <label for=''>$fi->placeholder</label>
                            <div class='col-lg-12 col-md-12'>
                            $option
                            <div class='validate'></div>
                            </div>
                        </div>";

        return $return_text;
    }
    public function createFile($fi){
        $return_text = "";
        $class = "col-12";
        $name = "";
        $id="";
        $placeholder = "";
        $required="";
        $type = "file";
        if(!empty($fi->class_attr)){
            $class = $fi->class_attr;
        }
        if(!empty($fi->name)){
            $name = Str::slug($fi->name)."".$fi->id;
        }
        if(!empty($fi->id_attr)){
            $id = $fi->id_attr;
        }
        if(!empty($fi->placeholder)){
            $placeholder = $fi->placeholder;
        }
        if(!empty($fi->required) && $fi->required == 1){
            $required ="required=''";
        }
        $return_text .="<div class='$class col-md-12 mb-10'>
                            <input type='$type' name='$name' class='form-control' $required id='$id' placeholder='$placeholder'>
                            <div class='validate'></div>
                        </div>";
        return $return_text;
    }
}
