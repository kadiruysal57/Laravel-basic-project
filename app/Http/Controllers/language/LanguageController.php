<?php

namespace App\Http\Controllers\language;

use App\Http\Controllers\Controller;
use App\Models\site_settings;
use Illuminate\Http\Request;
use App\Models\Language;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use App\Models\Menu;
class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$this->PermissionCheck()){

            return view('Kpanel.401');
        }

        $with['language'] = Language::where('status','!=',3)->get();
       return view('Kpanel.language.index')->with($with);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$this->PermissionCheck()){

            return response()->json(['error' => array('Bu Modülü Güncelleme Yetkiniz Bulunmamaktadır.')]);

        }

        if($request->id == "create"){
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'short_name' => 'required | unique:language',
                'main_language' => 'required',
            ]);
            if ($validator->passes()) {
                if($request->main_language == 1){
                    Language::where('main_language','=',1)->update(['main_language' => 2]);
                }

                $language = new Language();
                $language->name = $request->name;
                $language->short_name = $request->short_name;
                $language->slug = Str::slug($request->short_name);
                $language->main_language = $request->main_language;
                $language->add_user = Auth::id();
                $return = $language->save();
                if(!empty($language->id)){
                    $Menu = new Menu();
                    $sitesettings = new site_settings();
                    $sitesettings = $sitesettings->default_value();
                    foreach ($Menu->default_menu() as $df){
                        $menu_new = new Menu();
                        $menu_new->name = $df;
                        $menu_new->status = 1;
                        $menu_new->language_id = $language->id;
                        $menu_new->add_user = Auth::id();
                        $menu_new->save();
                    }
                    $sitesettings_new = new site_settings();
                    $sitesettings_new->site_name = $sitesettings->site_name;
                    $sitesettings_new->site_slogan = $sitesettings->site_slogan;
                    $sitesettings_new->logo = $sitesettings->logo;
                    $sitesettings_new->fav_icon = $sitesettings->fav_icon;
                    $sitesettings_new->language_id = $language->id;
                    $sitesettings_new->status = 1;
                    $sitesettings_new->save();
                }

                $language_model = new Language();
                $language_all = $language_model->getTableReview();

                return response()->json(['type'=>'success','listData' => $language_all,'success_message_array' => array(Lang::get('global.success_message'))]);

            }else {
                return response()->json(['type'=>'error','error' => $validator->errors()->all()]);
            }
        }
        elseif($request->id == "update"){
            $language = Language::where('id',$request->id_input)->first();
            if(!empty($language)){
                $validator_array = array();
                if($language->short_name != $request->short_name){
                    $validator_array['short_name'] = 'required | unique:language';
                }
                if($language->slug != $request->slug && !empty($request->slug)){
                    $validator_array['slug'] = 'required | unique:language';
                }
                $validator = Validator::make($request->all(),$validator_array);
                if ($validator->passes()) {
                    if($request->main_language == 1){
                        Language::where('main_language','=',1)->update(['main_language' => 2]);
                    }
                    $language->name = $request->name;
                    $language->short_name = $request->short_name;
                    if(!empty($request->slug)){
                        $language->slug = $request->slug;
                    }else{
                        $language->slug = Str::slug($request->short_name);
                    }
                    $language->main_language = $request->main_language;
                    $language->save();

                    $language_model = new Language();
                    $language_all = $language_model->getTableReview();

                    return response()->json(['type'=>'success','listData' => $language_all,'success_message_array' => array(Lang::get('global.success_message'))]);
                }else{
                    return response()->json(['type'=>'error','error' => $validator->errors()->all()]);
                }
            }else{
                return response()->json(['type'=>'error','error_message_array'=>array(Lang::get('global.error_message'))]);
            }
            return response()->json(['type'=>'error','error_message_array'=>array(Lang::get('global.error_message'))]);
        }
        elseif($request->id == "main_language"){
            $language = Language::where('status','!=',3)->find($request->data_id);
            if(!empty($language)){

                Language::where('main_language','=',1)->update(['main_language' => 2]);
                $language->main_language = 1;
                $language->save();
                $language_model = new Language();
                $language_all = $language_model->getTableReview();

                return response()->json(['type'=>'success','listData' => $language_all,'success_message_array' => array(Lang::get('global.success_message'))]);

            }else{

                return response()->json(['type'=>'error','error_message_array'=>array(Lang::get('global.error_message'))]);
            }
            return response()->json(['type'=>'error','error_message_array'=>array(Lang::get('global.error_message'))]);
        }
        else{

            $language = Language::where('id',$request->id)->where('status','!=',3)->first();
            if(!empty($language)){
                return response()->json(['type'=>'success','inputData'=>$language]);
            }else{
                return response()->json(['type'=>'error','error_message_array'=>array(Lang::get('global.error_message'))]);
            }
            return response()->json(['type'=>'error','error_message_array'=>array(Lang::get('global.error_message'))]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if(!$this->PermissionCheck()){

            return response()->json(['error' => array('Bu Modülü Silme Yetkiniz Bulunmamaktadır.')]);

        }
        $language = Language::where('id',$id)->first();
        $language_count = Language::where('id','!=',$id)->where('status','!=',3)->count();
        if(!empty($language->id)){
            if($language_count > 0){
                if($language->main_language == 1){
                    $language->main_language = 2;
                    $language_new_main_language = Language::where('status','!=',3)->where('id','!=',$language->id)->first();
                    $language_new_main_language->main_language = 1;
                    $language_new_main_language->update_user = Auth::id();
                    $language_new_main_language->save();
                }
                $language->update_user = Auth::id();
                $language->status = 3;
                $language->save();

                $Menu = Menu::where('language_id',$id)->get();
                foreach ($Menu as $m){
                    $m->status = 3;
                    $m->update_user = Auth::id();
                    $m->save();
                }

                $sitesettings = site_settings::where('language_id',$id)->get();
                foreach ($sitesettings as $s){
                    $s->status = 3;
                    $s->update_user = Auth::id();
                    $s->save();
                }

                $language_model = new Language();
                $language_all = $language_model->getTableReview();

                return response()->json(['type'=>'success','tableRefresh'=>1,'listData' => $language_all,'success_message_array' => array(Lang::get('global.success_message'))]);
            }else{
                return response()->json(['type'=>'error','error_message_array'=>array(Lang::get('global.data_min_one'))]);

            }
        }
        return response()->json(['type'=>'error','error_message_array'=>array(Lang::get('global.error_message'))]);

    }
}
