<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentGallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'content_id',
        'image_url',
        'image_order',
        'add_user',
        'update_user',
    ];
    protected $table = 'content_gallery';

    public function gallery_add($count)
    {
        $default_image = asset("/panel/assets/img/no-pictures.png");
        $gallery_select = __('contents.gallery_select');
        $gallery_order = __('contents.order');
        $return_text = array();
        $return_text[1]['file_image'] = "<div class='col-lg-12 text-center gallery_image_delete$count'>
                            <div id='content_gallery_holder$count'
                                 class='image-content'>
                                <img
                                    src='$default_image' width='32px' height='32px'>
                            </div>
                        </div>";
        $return_text[1]['file_input']= "
                        <div class='form-group'>

                            <div class='input-group'>
                               <span class='input-group-btn'>
                                 <a id='gallery_add$count'
                                    data-input='gallery_add_input$count'
                                    data-preview='content_gallery_holder$count'
                                    class='btn btn-primary'>
                                    <i class='fa fa-picture-o'></i> $gallery_select
                                 </a>
                               </span>
                                <input id='gallery_add_input$count'
                                       class='form-control'
                                       type='text'
                                       name='gallery_add_image$count'
                                       readonly
                                       value=''>
                            </div>
                        </div><script>
                         $('#gallery_add$count').filemanager('image');
                        </script>";
        $return_text[1]['order'] = "
            <div class='form-group'>
                <input class='form-control ' name='image_order$count' placeholder='$gallery_order' required type='text'>
            </div>
        ";
        $return_text[1]['action'] = "
            <button type='button' class='btn btn-danger btn-sm gallery_image_delete' data-count='$count'  style='margin-top: 5px;'><i class='fa fa-trash'></i></button>
        ";
        return $return_text;
    }
    public function getTableReview($content_id){
        $all_image = $this->where('content_id',$content_id)->select('id','image_url','image_order')->orderBy('image_order','asc')->get();
        foreach($all_image as $key => $all){
            $count = $all->id;
            $default_image = asset($all->image_url);
            $gallery_select = __('contents.gallery_select');
            $gallery_order = __('contents.order');
            $delete_route = route('contents.update',['gallery_image_delete']);
            $return_text = array();
            $all->image_url_s = "<div class='col-lg-12 text-center gallery_image_deletes$count'>
                            <div id='content_gallery_holders$count'
                                 class='image-content'>
                                <img
                                    src='$default_image' width='32px' height='32px'>
                            </div>
                        </div>";
            $all->file_input= "
                        <div class='form-group'>

                            <div class='input-group'>
                               <span class='input-group-btn'>
                                 <a id='gallery_adds$count'
                                    data-input='gallery_add_inputs$count'
                                    data-preview='content_gallery_holders$count'
                                    class='btn btn-primary'>
                                    <i class='fa fa-picture-o'></i> $gallery_select
                                 </a>
                               </span>
                                <input id='gallery_add_inputs$count'
                                       class='form-control'
                                       type='text'
                                       name='gallery_add_images$count'
                                       readonly
                                       value='$all->image_url'>
                            </div>
                        </div><script>
                         $('#gallery_adds$count').filemanager('image');
                        </script>";
            $all->image_orders = "
            <div class='form-group'>
                <input class='form-control ' name='image_orders$count' value='$all->image_order' placeholder='$gallery_order' required type='text'>
            </div>
        ";
            $all->action = "
            <button type='button' class='btn btn-danger btn-sm deleteButtonGallery' data-id='$all->id' data-action = '$delete_route' data-table='#content_gallery_add_table'   style='margin-top: 5px;'><i class='fa fa-trash'></i></button>
        ";


            unset($all->image_url);
            unset($all->image_order);
            unset($all->id);
        }
        return $all_image;
    }
}
