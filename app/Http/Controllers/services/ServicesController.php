<?php

namespace App\Http\Controllers\services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\services;
use App\Models\services_list;
use Illuminate\Support\Facades\Lang;

class ServicesController extends Controller
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
        return view('Kpanel.services.index')->with('services',services::where('status',1)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!$this->PermissionCheck()){

            return view('Kpanel.401');
        }
        return view('Kpanel.services.create');
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
                'name'=>'required',
                'status'=>'required',
            ],[
                'name.required'=>Lang::get('services.name_required'),
                'status.required'=>Lang::get('services.status_required'),
            ]);
            if ($validator->passes()) {
                $services = new services();
                $services->name = $request->name;
                $services->description = $request->description;
                $services->status = $request->status;
                $services->add_user = Auth::id();
                $services->save();

                for ($i = 0; $i <= $request->count; $i++) {
                    $link = "services_link" . $i;
                    $description = "services_desc". $i;
                    $services_title = "services_title". $i;
                    $filepath = "filepath". $i;
                    $order = "order". $i;
                    if(empty($request->$order)){
                        $order = $i;
                    }else{
                        $order = $request->$order;
                    }


                    if(!empty($request->$services_title)){
                        $services_list = new services_list();
                        $services_list->link = $request->$link;
                        $services_list->description =  $request->$description;
                        $services_list->title = $request->$services_title;
                        $services_list->url =  str_replace(env('APP_URL'),'', $request->$filepath);
                        $services_list->list_order = $order;
                        $services_list->status = 1;
                        $services_list->services_id = $services->id;
                        $services_list->add_user = Auth::id();
                        $services_list->save();
                    }
                }
                return response()->json(['type' => "success",'route_url'=>route('services.index')]);

            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
            return response()->json(['error' => $validator->errors()->all()]);
        }

        if($request->id == "update"){
            $validator = Validator::make($request->all(), [
                'name'=>'required',
                'status'=>'required',
            ],[
                'name.required'=>Lang::get('services.name_required'),
                'status.required'=>Lang::get('services.status_required'),
            ]);
            if ($validator->passes()) {
                $services = services::find($request->services_id);
                $services->name = $request->name;
                $services->description = $request->description;
                $services->status = $request->status;
                $services->update_user = Auth::id();
                $services->save();

                $order_table = services_list::where('status',1)->where('services_id', $services->id)->orderBy('list_order','DESC')->first();
                $order_last = $order_table->list_order;

                for ($i = 1; $i <= $request->count; $i++) {
                    $link = "services_link" . $i;
                    $description = "services_desc". $i;
                    $services_title = "services_title". $i;
                    $filepath = "filepath". $i;
                    $order = "order". $i;
                    if(empty($request->$order)){
                        $order_last = $order_last + 1;
                    }else{
                        $order_last = $request->$order;
                    }
                    echo $order;

                    if(!empty($request->$services_title)){
                        $services_list = new services_list();
                        $services_list->link = $request->$link;
                        $services_list->description =  $request->$description;
                        $services_list->title = $request->$services_title;
                        $services_list->url =  str_replace(env('APP_URL'),'', $request->$filepath);
                        $services_list->list_order =  $order_last;
                        $services_list->status = 1;
                        $services_list->services_id = $services->id;
                        $services_list->add_user = Auth::id();
                        $services_list->save();
                    }
                }

                $services_list = services_list::where('services_id',$services->id)->where('status',1)->get();
                foreach ($services_list as $st){
                    $link_edit = "services_link_edit" . $st->id;
                    $description_edit = "services_desc_edit". $st->id;
                    $services_title_edit = "services_title_edit". $st->id;
                    $filepath_edit = "filepath_edit". $st->id;
                    $order = "order_edit". $st->id;


                    if(!empty($request->$services_title_edit)){

                        $services_list = services_list::find($st->id);
                        $services_list->link = $request->$link_edit;
                        $services_list->description =  $request->$description_edit;
                        $services_list->title = $request->$services_title_edit;
                        $services_list->url = str_replace(env('APP_URL'),'', $request->$filepath_edit);
                        $services_list->list_order =  $request->$order;
                        $services_list->status = 1;
                        $services_list->services_id = $services->id;
                        $services_list->update_user = Auth::id();
                        $services_list->save();
                    }
                }



            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
            return response()->json(['error' => $validator->errors()->all()]);


        }
        if($request->id == "services_delete"){
            $services_list_del = services_list::find($request->services_id);

            if(!empty($services_list_del)){
                $services_list_del->delete();
                return response()->json(['type' => 'success', 'success_message_array' => array(Lang::get('global.success_message'))]);

            }else{
                return response()->json(['type' => 'error', 'error_message_array' => array(Lang::get('global.error_message'))]);
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
        if(!$this->PermissionCheck()){

            return view('Kpanel.401');
        }
        if(empty(services::find($id))){
            return view('Kpanel.404');
        }
        return view('Kpanel.services.edit')->with('services',services::find($id));
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
