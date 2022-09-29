<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'answer',
        'faq_category_id',
        'add_user',
        'update_user',
    ];
    protected $table = 'faq';

    public function getFaqAdd($count){
        $question = __('faq.question');
        $answer = __('faq.answer');


        $return_data = array();
        $return_data[1]['question'] = "<input type='text' class='form-control' name='question$count' placeholder='$question'>";
        $return_data[1]['answer'] = "<textarea class='form-control' name='answer$count' placeholder='$answer'></textarea>";
        $return_data[1]['actions'] = "<button type='button' class='btn btn-danger btn-sm delete_faq_word mt-2' data-count='$count'><i class='fa fa-trash'></i></button>";
        return $return_data;
    }

    public function getTableReview($category_id){
        $faq_all =$this->select('id','question','answer')->where('faq_category_id',$category_id)->get();
        $question = __('faq.question');
        $answer = __('faq.answer');

        foreach($faq_all as $all){
            $route_store = route('faq.store');
            $all->question = "<input id='faqs_td$all->id' type='text' class='form-control' name='questions$all->id' value='$all->question' placeholder='$question'>";
            $all->answer = "<textarea class='form-control' name='answer$all->id' placeholder='$answer'>$all->answer</textarea>";
            $all->actions = "<button type='button' class='btn btn-danger mt-2 btn-sm deleteButtonFaq' data-id='$all->id' data-action = '$route_store' data-table='#faq_table'><i class='ti-trash'></i></button>";
            unset($all->id);
        }
        return $faq_all;
    }
}
