<?php

use App\Models\Language;

Route::get('/', function () {
    $select_themes = \App\Models\ThemesCustomize::find(1);
    $main_language = Language::where('main_language',1)->first();
    if(!empty($main_language)){
        $content = \App\Models\Contents::where('seo_url','/')->where('language_id',$main_language->id)->first();
        if(!empty($content)){
            $data['content'] =$content;
            $data['select_themes'] = $select_themes;
            return view('themes.'.$select_themes->themes->themes_folder_name.'.app')->with($data);
        }else{
            dd("404");
        }
    }else{
       dd("404");
    }
});
