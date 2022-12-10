<?php

namespace App\Http\Controllers\Whatsapp;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Whatsapp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class WhatsappController extends Controller
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
        return view('Kpanel.whatsapp.index')->with($data);
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
        $language = Language::where('status',1)->get();
        foreach($language as $l){
            foreach($l->whatsapp_icon as $wp){
                $image = "whatsapp_icon_input".$l->id;
                $phone = "phone".$l->id;
                $wp_text = "wp_text".$l->id;
                $default_text = "default_text".$l->id;
                $button_position = "button_position".$l->id;
                $status = "status".$l->id;

                $wp->image = str_replace(env('APP_URL'),'',$request->$image);
                $wp->phone = $request->$phone;
                $wp->wp_text = $request->$wp_text;
                $wp->default_text = $request->$default_text;
                $wp->button_position = $request->$button_position;
                $wp->button_position = $request->$button_position;
                $wp->status = $request->$status;
                $wp->save();
            }
        }
        return response()->json(['type'=>'success','success_message_array' => array(Lang::get('global.success_message'))]);

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
