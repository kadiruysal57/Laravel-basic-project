<?php

namespace App\Http\Controllers\SiteSettings;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\social_media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
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
        $validator = Validator::make($request->all(), [
            'address_name'=>'required',
        ],[
            'address_name.required'=>__('sitesettings.address_name_required'),
        ]);
        if ($validator->passes()) {
            if(!empty($request->address_id)){
                $address = Address::find($request->address_id);
                $address->update_user = Auth::id();
            }else{
                $address = new Address();
                $address->add_user = Auth::id();
            }
            $address->name = $request->address_name;
            $address->address = $request->address;
            $address->gsm = $request->gsm;
            $address->email = $request->email;
            $address->maps = $request->maps;
            $address->site_settings_id = $request->site_settings_id;

            $address->save();
            $address_modal = new Address();
            $listData= $address_modal->getTableReview($request->site_settings_id);
            return response()->json(['type'=>'success','site_settings_id'=>$request->site_settings_id,'listData'=>$listData,'tableRefresh'=>1,'success_message_array' => array(Lang::get('global.success_message'))]);

        }else{
            return response()->json(['error' => $validator->errors()->all()]);

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
        if(!$this->PermissionCheck()){
            return response()->json(['error' => array('Bu Modülü Güncelleme Yetkiniz Bulunmamaktadır.')]);
        }
        if($id == "show_address"){
            $address = Address::find($request->id);
            if(!empty($address)){
                return response()->json(['type'=>'success','listdata'=>$address]);
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
        $address = Address::find($id);
        if(!empty($address)){
            $sitesettings_id  = $address->site_settings_id;
            $address->delete();


            $address = new Address();
            $listData= $address->getTableReview($sitesettings_id);
            return response()->json(['type'=>'success','site_settings_id'=>$sitesettings_id,'listData'=>$listData,'tableRefresh'=>1,'success_message_array' => array(Lang::get('global.success_message'))]);
        }else{
            return response()->json(['type'=>'error','error_message_array'=>array(Lang::get('global.error_message'))]);
        }
    }
}
