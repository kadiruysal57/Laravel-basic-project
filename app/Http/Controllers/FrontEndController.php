<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\menuitem;
use App\Models\site_settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Language;

class FrontEndController extends Controller
{
    public function index($lang = null,$slug = null){
        $params = langUrlControl($lang,$slug);

        $select_themes = \App\Models\ThemesCustomize::find(1);
        $language = Language::where('slug',$params['lang'])->where('status',1)->first();
        if(!empty($language)){
            $content = \App\Models\Contents::where('seo_url',$params['seo_url'])->where('language_id',getLangId($params['lang']))->first();

            if(!empty($content)){
                $wp_model = new \App\Models\Whatsapp();
                $data['active_lang'] = $params['lang'];
                session(['active_lang' => $params['lang']]);



                $data['content'] =$content;
                $data['select_themes'] = $select_themes;
                $data['wp'] = $wp_model->getWp();

                /// top data
                $data['site_setting'] = site_settings::where('language_id',getLangId($params['lang']))->first();
                $data['menu_top'] = Menu::where('language_id',getLangId($params['lang']))->where('type',1)->first();
                $data['menu_item_model'] = new menuitem();

                //footer data
                $data['site_setting'] = site_settings::where('language_id',getLangId($params['lang']))->first();
                $data['menu_footer'] = Menu::where('language_id',getLangId($params['lang']))->where('type',2)->first();

                $data['languages'] = Language::where('status',1)->get();

                return view('themes.'.$select_themes->themes->themes_folder_name.'.app')->with($data);
            }else{
                dd("404");
            }
        }else{
            dd("404");
        }
    }
}
