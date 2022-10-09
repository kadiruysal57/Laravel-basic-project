<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class portfolio_group_image extends Model
{
    use HasFactory;

    protected $fillable = [
        'portfolio_group_id ',
        'image_url',
        'title',
        'image_order',
        'description',
        'alt_title',
        'add_user',
        'update_user',
    ];
    protected $table = 'portfolio_group_image';

    public function getImageAdd($count)
    {
        $image = __('portfolio.image');
        $title = __('portfolio.title');
        $alt_title = __('portfolio.alt_title');
        $description = __('portfolio.description');
        $order = __('portfolio.order');
        $please_select_image = __('global.please_select_image');
        $default_image = asset('panel/assets/img/no-pictures.png');

        $return_data = array();
        $return_data[1]['image'] = "<div id='portfolio_image_holder$count'
                                    class='image-content'>
                                        <img src='$default_image' class='portfolio_image_holder$count' width='32px' height='32px' alt=''>
                                    </div>";
        $return_data[1]['image_input'] = "<div class='input-group'>
                                                                                   <span class='input-group-btn'>
                                                                                     <a id='portfolio_image$count'
                                                                                        data-input='portfolio_image_input$count'
                                                                                        data-preview='portfolio_image_holder$count'
                                                                                        class='btn btn-primary lfm'>
                                                                                       <i class='fa fa-picture-o'></i> $please_select_image
                                                                                     </a>
                                                                                   </span>
    <input id='portfolio_image_input$count'
           class='form-control portfolio_image'
           type='text'
           name='portfolio_image_input$count'
           readonly=''
           value=''>
</div><script >$('.lfm').filemanager('image');</script>";
        $return_data[1]['title'] = "<input type='text' class='form-control' name='image_title$count' placeholder='$title'>";
        $return_data[1]['description'] = "<textarea class='form-control' name='image_description$count' placeholder='$description'></textarea>";
        $return_data[1]['alt_title'] = "<input type='text' class='form-control' name='alt_title$count' placeholder='$alt_title'>";
        $return_data[1]['order'] = "<input type='number' class='form-control' name='image_order$count' placeholder='$order'>";
        $return_data[1]['actions'] = "<button type='button' class='btn btn-danger btn-sm delete_portfolio_image mt-2' data-count='$count'><i class='fa fa-trash'></i></button>";
        return $return_data;
    }

    public function getTableReview($portfolio_group_id){
        $portfolio_all = $this->select('id','image_url','title','alt_title','description','image_order')->where('portfolio_group_id',$portfolio_group_id)->orderBy('image_order','ASC')->get();

        $please_select_image = __('global.please_select_image');
        foreach($portfolio_all as $all){
            $image_url = $all->image_url;
            $image = asset($all->image_url);
            $title = __('portfolio.title');
            $alt_title = __('portfolio.alt_title');
            $description = __('portfolio.description');
            $order = __('portfolio.order');
            $please_select_image = __('global.please_select_image');
            $destroy_url = route('portfolio-group.store');
            if(empty($all->title)){
                $all->title="";
            }
            $all->image = "<div id='portfolio_image_holders$all->id'
                                    class='image-content'>
                                        <img src='$image' class='portfolio_image_holders$all->id' width='32px' height='32px' alt=''>
                                    </div>";

            $image_url_colum = "<div class='input-group'>
                                                                                   <span class='input-group-btn'>
                                                                                     <a id='portfolio_images$all->id'
                                                                                        data-input='portfolio_image_inputs$all->id'
                                                                                        data-preview='portfolio_image_holders$all->id'
                                                                                        class='btn btn-primary lfm'>
                                                                                       <i class='fa fa-picture-o'></i> $please_select_image
                                                                                     </a>
                                                                                   </span>
    <input id='portfolio_image_inputs$all->id'
           class='form-control portfolio_image'
           type='text'
           name='portfolio_image_inputs$all->id'
           readonly=''
           value='$image_url'>
</div><script >$('.lfm').filemanager('image');</script>";

            $title_colum = "<input type='text' class='form-control' name='image_titles$all->id' placeholder='$title' value='$all->title'>";
            $description_colum = "<textarea class='form-control' name='image_descriptions$all->id' placeholder='$description'>$all->description</textarea>";
            $alt_title_colum = "<input type='text' class='form-control' name='alt_titles$all->id' placeholder='$alt_title' value='$all->alt_title'>";
            $image_order_colum = "<input type='number' class='form-control' name='image_orders$all->id' placeholder='$order' value='$all->image_order'>";
            $actions_colum = "<button type='button' class='btn btn-danger btn-sm deleteButtonImage mt-2' data-table='#portfolio_image_table' data-id='$all->id' data-action='$destroy_url'><i class='fa fa-trash'></i></button>";
            unset($all->id);
            unset($all->image_url);
            unset($all->title);
            unset($all->alt_title);
            unset($all->description);
            unset($all->image_order);
            $all->image_url = $image_url_colum;
            $all->title = $title_colum;
            $all->description = $description_colum;
            $all->alt_title = $alt_title_colum;
            $all->image_order = $image_order_colum;
            $all->actions = $actions_colum;
        }
        return $portfolio_all;
    }
}
