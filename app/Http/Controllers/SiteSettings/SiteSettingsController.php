<?php

namespace App\Http\Controllers\SiteSettings;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\days;
use Illuminate\Http\Request;
use App\Models\site_settings;
use App\Models\Language;
use Illuminate\Support\Facades\Lang;

class SiteSettingsController extends Controller
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

        $data['language'] = Language::where('status',1)->get();
        $data['offices'] = Address::get();
        $data['sitesettings'] = site_settings::where('status',1)->get();
        $data['days']=days::get();
        return view('Kpanel.sitesettings.index')->with($data);
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
        $site_settings = site_settings::where('status',1)->get();
        foreach($site_settings as $s){
            $site_name = "site_name".$s->id;
            $site_slogan = "site_slogan".$s->id;
            $site_logo = "site_logo".$s->id;
            $site_favicon = "site_favicon".$s->id;
            $s->site_name = $request->$site_name;
            $s->site_slogan = $request->$site_slogan;
            $s->logo = str_replace(env('APP_URL').'/','',$request->$site_logo);
            $s->fav_icon = str_replace(env('APP_URL').'/','',$request->$site_favicon);
            $s->save();
        }

        return response()->json(['type' => 'success','success_message_array' => array(Lang::get('global.success_message'))]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
