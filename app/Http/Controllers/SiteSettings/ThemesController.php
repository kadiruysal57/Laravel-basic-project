<?php

namespace App\Http\Controllers\SiteSettings;

use App\Http\Controllers\Controller;
use App\Models\Themes;
use App\Models\ThemesColor;
use Illuminate\Http\Request;
use App\Models\ThemesCustomize;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class ThemesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['themes_customize'] = ThemesCustomize::where('id',1)->first();
        $data['themes'] = Themes::where('status',1)->get();
        $data['themes_color'] = ThemesColor::where('status',1)->get();
        return view('Kpanel.Themes.index')->with($data);
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
        if($request->id == "update"){
            $themes = ThemesCustomize::find($request->themes_id);
            if(!empty($themes)){
                $themes->themes_id = $request->themes_id;
                $themes->themes_color_id = $request->themes_color_id;
                $themes->update_user = Auth::id();
                $themes->save();
                return response()->json(['type'=>'success','success_message_array' => array(Lang::get('global.success_message'))]);

            }else{
                return response()->json(['type'=>'error','error_message_array'=>array(Lang::get('global.error_message'))]);
            }
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
