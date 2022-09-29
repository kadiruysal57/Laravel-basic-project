<?php

namespace App\Http\Controllers\staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\staff;
use App\Models\staff_list;

class StaffController extends Controller
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
        return view('Kpanel.staff.index')->with('staff',staff::where('status',1)->get());
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
        return view('Kpanel.staff.create');
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
                $staff = new staff();
                $staff->name = $request->name;
                $staff->description = $request->description;
                $staff->status = $request->status;
                $staff->add_user = Auth::id();
                $staff->save();

                for ($i = 0; $i <= $request->count; $i++) {
                    $name = "staff_name" . $i;
                    $description = "staff_desc". $i;
                    $staff_title = "staff_title". $i;
                    $filepath = "filepath". $i;

                    if(!empty($request->$filepath)){
                        $staff_list = new staff_list();
                        $staff_list->name = $request->$name;
                        $staff_list->description =  $request->$description;
                        $staff_list->staff_title = $request->$staff_title;
                        $staff_list->url =  $request->$filepath;
                        $staff_list->status = 1;
                        $staff_list->staff_id = $staff->id;
                        $staff_list->add_user = Auth::id();
                        $staff_list->save();
                    }
                }
                return response()->json(['type' => "success",'route_url'=>route('staff.index')]);

            }
        }

        if($request->id == "update"){
            $validator = Validator::make($request->all(), [
                'name'=>'required',
                'status'=>'required',
            ]);
            if ($validator->passes()) {
                $staff = staff::find($request->staff_id);
                $staff->name = $request->name;
                $staff->description = $request->description;
                $staff->status = $request->status;
                $staff->update_user = Auth::id();
                $staff->save();

                for ($i = 0; $i <= $request->count; $i++) {
                    $name = "staff_name" . $i;
                    $description = "staff_desc". $i;
                    $staff_title = "staff_title". $i;
                    $filepath = "filepath". $i;

                    if(!empty($request->$filepath)){
                        $staff_list = new staff_list();
                        $staff_list->name = $request->$name;
                        $staff_list->description =  $request->$description;
                        $staff_list->staff_title = $request->$staff_title;
                        $staff_list->url =  $request->$filepath;
                        $staff_list->status = 1;
                        $staff_list->staff_id = $staff->id;
                        $staff_list->add_user = Auth::id();
                        $staff_list->save();
                    }
                }

                $staff_list = staff_list::where('staff_id',$staff->id)->where('status',1)->get();
                foreach ($staff_list as $st){
                    $name_edit = "staff_name_edit" . $st->id;
                    $description_edit = "staff_desc_edit". $st->id;
                    $staff_title_edit = "staff_title_edit". $st->id;
                    $filepath_edit = "filepath_edit". $st->id;

                    if(!empty($request->$filepath_edit)){

                        $staff_list = staff_list::find($st->id);
                        $staff_list->name = $request->$name_edit;
                        $staff_list->description =  $request->$description_edit;
                        $staff_list->staff_title = $request->$staff_title_edit;
                        $staff_list->url =  $request->$filepath_edit;
                        $staff_list->status = 1;
                        $staff_list->staff_id = $staff->id;
                        $staff_list->update_user = Auth::id();
                        $staff_list->save();
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
        if(empty(staff::find($id))){
            return view('Kpanel.404');
        }
        return view('Kpanel.staff.edit')->with('staff',staff::find($id));
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
