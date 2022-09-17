<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gallery_image extends Model
{
    use HasFactory;

    protected $fillable = [
        'gallery_id',
        'url',
        'image_order',
        'add_user',
        'update_user',
    ];
    protected $table = 'gallery_image';

    public function create_gallery_image_new($count)
    {
        $return = array();
        $plase_select = __('global.please_select_image');
        $order = __('global.order');
        $no_pictures = asset('panel/assets/img/no-pictures.png');
        $are_you_sure = __('global.are_you_sure');
        $yes = __('global.yes');
        $no = __('global.no');
        $return[$count]['url'] = "<div class='d-flex justify-content-center' id='gallery_image_content$count'>

                                                <div class='float-left' id='holder$count'>
                                                    <img style='height: 5rem;' src='$no_pictures'>
                                                </div>
                                                    <div class='mt-4 mb-4 float-left'>
                                                         <span class='input-group-btn'>
                                                             <a id='lfm$count' data-input='thumbnail$count' data-preview='holder$count'
                                                                            class='btn btn-info text-white lfm'>
                                                             <i class='fa fa-picture-o'></i> $plase_select
                                                             </a>
                                                         </span>
                                                    </div>
                                                    <input id='thumbnail$count' class='form-control' type='hidden' name='filepath_edit$count' value=''>
                                                </div>";
        $return[$count]['order'] = "<label>$order</label><input name='order$count' type='number' class='form-control' placeholder='$order' min='0'>";

        $return[$count]['delete'] = "
<div class='d-flex justify-content-center align-items-center' style='height: 75px'><button type='button' class='btn btn-danger deleteGalleryImage' data-count='$count'><i class='fa fa-trash'></i></button></div>
<script >
   $('#lfm$count').filemanager('image');
   $('.deleteGalleryImage').click(function(){
       var count = $(this).attr('data-count');
        Swal.fire({
            title: '$are_you_sure',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '$yes',
            cancelButtonText: '$no'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#gallery_image_content'+count).parent().parent().remove();
            }
        })
   });
</script>
";

        return $return;
    }
    public function edit_gallery_image_list($id)
    {
        $images = $this->where('gallery_id',$id)->orderBy('image_order','asc')->get();
        $return = array();
        foreach ($images as $key => $i){
            $count = $i->id;
            $plase_select = __('global.please_select_image');
            $order = __('global.order');
            $no_pictures = asset($i->url);
            $are_you_sure = __('global.are_you_sure');
            $yes = __('global.yes');
            $no = __('global.no');
            $route = route('gallery.store');
            $return[$key]['url'] = "<div class='d-flex justify-content-center' id='gallery_image_contents$count'>

                                                <div class='float-left' id='holder$count'>
                                                    <img style='height: 5rem;' src='$no_pictures'>
                                                </div>
                                                    <div class='mt-4 mb-4 float-left'>
                                                         <span class='input-group-btn'>
                                                             <a id='lfm$count' data-input='thumbnail$count' data-preview='holder$count'
                                                                            class='btn btn-info text-white lfm'>
                                                             <i class='fa fa-picture-o'></i> $plase_select
                                                             </a>
                                                         </span>
                                                    </div>
                                                    <input id='thumbnail$count' class='form-control' type='hidden'  name='filepath_edits$count' value='$i->url'>
                                                </div>";
            $return[$key]['order'] = "<label>$order</label><input name='orders$count' type='number' class='form-control' placeholder='$order' min='0' value='$i->image_order'>";

            $return[$key]['delete'] = "
<div class='d-flex justify-content-center align-items-center' style='height: 75px'><button type='button' class='btn btn-danger deleteGalleryImages' data-action='$route' data-id='$count'><i class='fa fa-trash'></i></button></div>
";
        }


        return $return;
    }
}
