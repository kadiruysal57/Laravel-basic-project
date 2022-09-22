<?php

namespace App\Http\Controllers\socialmedia;

use App\Http\Controllers\Controller;
use App\Models\social_media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if(!empty($request->social_media_id)){
            $social_media = social_media::find($request->social_media_id);
        }else{
            $social_media = new social_media();
        }
        $social_media->icon = $request->icon;
        $social_media->name = $request->social_media_name;
        $social_media->link = $request->social_media_link;
        $social_media->link_target = $request->social_media_target;
        $social_media->sitesettings_id = $request->site_settings_id;
        $social_media->add_user = Auth::id();
        $social_media->save();

        $listData= $social_media->getTableReview($request->site_settings_id);
        return response()->json(['type'=>'success','site_settings_id'=>$request->site_settings_id,'listData'=>$listData,'tableRefresh'=>1,'success_message_array' => array(Lang::get('global.success_message'))]);

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
        if(!$this->PermissionCheck()){

            return view('Kpanel.401');
        }
        if($id == "show_social"){
            $social_media = social_media::find($request->id);
            if(!empty($social_media)){
                return response()->json(['type'=>'success','listdata'=>$social_media]);
            }else{
                return response()->json(['type'=>'error','error_message_array'=>array(Lang::get('global.error_message'))]);
            }
        }

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
        $social = social_media::find($id);
        if(!empty($social)){
            $sitesettings_id  = $social->sitesettings_id;
            $social->delete();


            $social_media = new social_media();
            $listData= $social_media->getTableReview($sitesettings_id);
            return response()->json(['type'=>'success','site_settings_id'=>$sitesettings_id,'listData'=>$listData,'tableRefresh'=>1,'success_message_array' => array(Lang::get('global.success_message'))]);
        }else{
            return response()->json(['type'=>'error','error_message_array'=>array(Lang::get('global.error_message'))]);
        }
    }
}
