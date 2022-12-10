<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class menuitem extends Model
{
    use HasFactory;
    protected $fillable = [
        'tableId',
        'menu_name',
        'real_link',
        'top_category',
        'menu_order',
        'menu_id',
        'add_user',
        'update_user',
    ];

    protected $table = 'menu_item';

    function menu_name_connection(){
        return $this->hasOne(Contents::class,'id','menu_name');
    }

    function menu(){
        return $this->hasOne(Menu::class,'id','menu_id');
    }

    function menu_id_connection(){
        return $this->hasOne(menu::class,'id','menu_id');
    }

    public function create_Menu($data, $order, $top_category = null)
    {
        $dataId = array(
            'id' => $data->dbtableid,
        );
        $dataUpdateorInsert = array(
            'tableId' => $data->tableid,
            'menu_name' => $data->name,
            'real_link' => $data->real_link,
            'top_category' => $top_category,
            'menu_order' => $order,
            'menu_id' => $data->id,
        );
        if(!empty($data->dbtableid)){
            $dataUpdateorInsert['update_user']=Auth::id();
        }else{
            $dataUpdateorInsert['add_user']=Auth::id();
        }
        $menu = $this->updateOrCreate($dataId,$dataUpdateorInsert);

        if (!empty($data->children)) {
            foreach ($data->children as $key => $c) {
                $this->create_Menu($c, ++$key, $menu->id);
            }
        }
        return $menu->id;
    }

    public function menu_category_delete($top_category){

        $menu_item = $this->where('top_category',$top_category)->get();
        foreach ($menu_item as $ms){
            $this->menu_category_delete($ms->id);
        }
        $this->where('top_category',$top_category)->delete();
    }

    public function show_menu($menu_id, $id = null,$menu_item_id=null)
    {
        $menu = $this
            ->select('menu_item.*', 'contents.name as page_name' )
            ->leftJoin('contents', function ($join) {
                $join->on('menu_item.menu_name', '=', 'contents.id')
                    ->where('menu_item.tableId', '=', 1);
            })
            ->where('menu_id', $menu_id);
        if (!empty($id)) {
            $menu = $menu->where('menu_item.top_category', $id);
        } else {
            $menu = $menu->where('menu_item.top_category', null);
        }

        if (!empty($menu_item_id)) {
            $menu = $menu->where('menu_item.id', $menu_item_id);
        }

        $menu = $menu->orderBy('menu_item.menu_order','asc')->get();


        if (count($menu) > 0) {
            if(empty($menu_item_id)){
                return $this->menuPanelHtml($menu);
            }
        }  else {
            return "";
        }
    }

    public function menuPanelHtml($menu){

        $dataHtml = "<ol class='dd-list'>";
        foreach ($menu as $m) {

            $page_name = null;
            $link=null;
            if ($m->tableId == 1) {
                $page_name = $m->page_name;
                $page= Contents::find($m->menu_name);
                $link=$page->seo_url;
                $settingbutton = null;
            } else{
                $page_name = $m->menu_name;
                $link = $m->real_link;
                $settingbutton = "<span class='dd-settingbutton btn-info btn-hover-scale me-5 float-right menu-custom-modal-open' data-action='".route('menu.edit',[$m->id])."' data-menuid='".$m->menu_id."' data-id='".$m->id."'> <i class='fa fa-solid fa-gear'></i></span>";
            }

            $dataHtml .= '<li class="dd-item dd3-item dd-deleteCont'.$m->id.'"
                                                        data-tableid="' . $m->tableId . '"
                                                        data-name="' . $m->menu_name . '"
                                                        data-real_link="' . $link . '"
                                                        data-id="' . $m->menu_id . '"
                                                        data-dbtableid="' . $m->id . '">
                                                        <div class="dd-handle dd3-handle"></div>

                                                        <div class="dd3-content">
                                                            '.$page_name.'
                                                                <span class="dd-deletebutton btn-danger btn-hover-scale me-5  float-right" data-action="'.route('menu.destroy',[$m->id]).'" data-menuid="'.$m->menu_id.'" data-id="'.$m->id.'"><i class="fa fa-trash"></i></button></span>
                                                            '.$settingbutton.'
                                                        </div>
                                                        ' . $this->show_menu($m->menu_id, $m->id) . '
                                                    </li>';

        }
        $dataHtml .= "</ol>";



        return $dataHtml;
    }

    public function collaps_html($data,$menu_id,$type){

        if(count($data) > 0){
            $dataHtml = "<ol class='dd-list'>";
            foreach ($data as $m){
                $dataHtml .= '<li class="dd-item"
                                                        data-tableid="'.$type.'"
                                                        data-name="' . $m->id . '"
                                                        data-real_link=""
                                                        data-id="' . $menu_id . '"
                                                        data-dbtableid="' . $m->id . '">
                                                        <div class="dd-handle dd3-handle"></div>

                                                        <div class="dd3-content">
                                                            '.$m->name.'
                                                        </div>
                                                    </li>';
            }
            $dataHtml .= "</ol>";
        }else{
            $dataHtml = "<div class='dd-empty'></div>";
        }





        return $dataHtml;
    }

    public function menuChildFrontEnd($menu_item_id){
        $count = $this->where('top_category',$menu_item_id)->count();
        $returnhtml = null;
        if($count > 0){

            $menu = $this->where('top_category',$menu_item_id)->get();
            $returnhtml = '<ul class="dropdown-menu">';
            foreach ($menu as $m){
                $returnhtml .= $this->getFrontEndHtml($m);

            }

            $returnhtml .="</ul>";
        }
        return $returnhtml;
    }

    public function getFrontEndHtml($data){
        $liclass = null;
        $aclass = null;
        $atoggle = null;
        if(getMenuChildCount($data->id) > 0){
            $liclass = "dropdown";
            $aclass = "dropdown-toggle";
            $atoggle = 'data-bs-toggle="dropdown" aria-expanded="false"';
        }
        $slugname = Str::of(getMenuName($data))->slug('-');

        $returnhtml = '<li class="'.$liclass.'"><a class="dropdown-item '.$aclass.'" href="'.$slugname.'" '.$atoggle.'>'.getMenuName($data).'</a>'.$this->menuChildFrontEnd($data->id).'</li>';
        return $returnhtml;
    }

    public function yummyMenu($m){
        $return_html = "";

        if($m->tableId == 1){
            if($m->menu->language->main_language == 1){
                $url = $m->menu_name_connection->seo_url;
            }else{
                if(!empty($m->menu_name_connection->seo_url) && $m->menu_name_connection->seo_url != "/"){
                    $url = $m->menu->language->slug."/".$m->menu_name_connection->seo_url;
                }else{
                    $url = $m->menu->language->slug."".$m->menu_name_connection->seo_url;
                }

            }

            $menu_name = $m->menu_name_connection->name;
        }elseif($m->tableId == 99){
            if($m->menu->language->main_language == 1){
                $url = $m->real_link;
            }else{
                if(!empty($m->real_link) && $m->real_link != "/"){
                    $url = $m->menu->language->slug."/".$m->real_link;
                }else{
                    $url = $m->menu->language->slug."".$m->real_link;
                }
            }

            $menu_name = $m->menu_name;
        }
        $url = rtrim($url,'/');
        if(count($this->yummyChildMenu($m->id)) <= 0){
            $return_html.= "<li>";

            $return_html .= "<a title='$menu_name' class='menu-f-item-li' href='$url'>$menu_name</a>";

            $return_html .="</li>";
        }else{
            $return_html .="<li class='dropdown'>";
            $return_html .= "<a title='$menu_name' class='menu-f-item-li'  href='$url'><span>$menu_name</span> <i class='fa fa-angle-down' aria-hidden='true'></i></a>";
            $return_html .="<ul>";
            $child_menu = $this->yummyChildMenu($m->id);
            foreach ($child_menu as $cm){
                $return_html .= $this->yummyMenu($cm);
            }
            $return_html .= "</ul>";

            $return_html .="</li>";
        }



        return $return_html;
    }
    public function yummyChildMenu($id){
        return $this->where('top_category',$id)->orderBy('menu_order','asc')->get();
    }

    public function yummyFooter($m){
        $return_html = "";

        if($m->tableId == 1){
            if($m->menu->language->main_language == 1){
                $url = $m->menu_name_connection->seo_url;
            }else{
                if(!empty($m->menu_name_connection->seo_url) && $m->menu_name_connection->seo_url != "/"){
                    $url = $m->menu->language->slug."/".$m->menu_name_connection->seo_url;
                }else{
                    $url = $m->menu->language->slug."".$m->menu_name_connection->seo_url;
                }

            }

            $menu_name = $m->menu_name_connection->name;
        }elseif($m->tableId == 99){
            if($m->menu->language->main_language == 1){
                $url = $m->real_link;
            }else{
                if(!empty($m->real_link) && $m->real_link != "/"){
                    $url = $m->menu->language->slug."/".$m->real_link;
                }else{
                    $url = $m->menu->language->slug."".$m->real_link;
                }
            }

            $menu_name = $m->menu_name;
        }
        $url = rtrim($url,'/');
        $return_html.= "<li >";

        $return_html .= "<a title='$menu_name'  href='$url'>$menu_name</a>";

        $return_html .="</li>";



        return $return_html;
    }
    public function menteseFooter($m){
        $return_html = "";

        if($m->tableId == 1){
            if($m->menu->language->main_language == 1){
                $url = $m->menu_name_connection->seo_url;
            }else{
                if(!empty($m->menu_name_connection->seo_url) && $m->menu_name_connection->seo_url != "/"){
                    $url = $m->menu->language->slug."/".$m->menu_name_connection->seo_url;
                }else{
                    $url = $m->menu->language->slug."".$m->menu_name_connection->seo_url;
                }

            }

            $menu_name = $m->menu_name_connection->name;
        }elseif($m->tableId == 99){
            if($m->menu->language->main_language == 1){
                $url = $m->real_link;
            }else{
                if(!empty($m->real_link) && $m->real_link != "/"){
                    $url = $m->menu->language->slug."/".$m->real_link;
                }else{
                    $url = $m->menu->language->slug."".$m->real_link;
                }
            }

            $menu_name = $m->menu_name;
        }
        $url = rtrim($url,'/');
        $return_html.= "<li >";

        $return_html .= "<a title='$menu_name' href='$url'><font color='ffffff'>$menu_name</font></a>";

        $return_html .="</li>";



        return $return_html;
    }
}
