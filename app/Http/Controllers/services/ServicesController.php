<?php

namespace App\Http\Controllers\services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\services;
use App\Models\services_list;

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

                    if(!empty($request->$filepath)){
                        $services_list = new services_list();
                        $services_list->link = $request->$link;
                        $services_list->description =  $request->$description;
                        $services_list->title = $request->$services_title;
                        $services_list->url =  $request->$filepath;
                        $services_list->status = 1;
                        $services_list->services_id = $services->id;
                        $services_list->add_user = Auth::id();
                        $services_list->save();
                    }
                }
                return response()->json(['type' => "success",'route_url'=>route('services.index')]);

            }
        }

        if($request->id == "update"){
            $validator = Validator::make($request->all(), [
                'name'=>'required',
                'status'=>'required',
            ]);
            if ($validator->passes()) {
                $services = services::find($request->services_id);
                $services->name = $request->name;
                $services->description = $request->description;
                $services->status = $request->status;
                $services->update_user = Auth::id();
                $services->save();

                for ($i = 0; $i <= $request->count; $i++) {
                    $link = "services_link" . $i;
                    $description = "services_desc". $i;
                    $services_title = "services_title". $i;
                    $filepath = "filepath". $i;

                    if(!empty($request->$filepath)){
                        $services_list = new services_list();
                        $services_list->link = $request->$link;
                        $services_list->description =  $request->$description;
                        $services_list->title = $request->$services_title;
                        $services_list->url =  $request->$filepath;
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
                    echo $request->$filepath_edit;

                    if(!empty($request->$filepath_edit)){

                        $services_list = services_list::find($st->id);
                        $services_list->link = $request->$link_edit;
                        $services_list->description =  $request->$description_edit;
                        $services_list->title = $request->$services_title_edit;
                        $services_list->url =  $request->$filepath_edit;
                        $services_list->status = 1;
                        $services_list->services_id = $services->id;
                        $services_list->update_user = Auth::id();
                        $services_list->save();
                    }
                }
                return response()->json(['type' => "success"]);
            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
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
