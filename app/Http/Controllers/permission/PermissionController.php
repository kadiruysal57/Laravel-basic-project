<?php

namespace App\Http\Controllers\permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\permission;
use App\Models\roleslist;
use App\Models\userroles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
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
        return view('Kpanel.permission.index')->with('permission',permission::where('status',1)->get());
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
        return view('Kpanel.permission.create')->with('permission_role',permission::where('status',1)->get())->with('users_roles',userroles::get())->with('roles_table',roleslist::get());
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
                $Permission = new permission();
                $Permission->name = $request->name;
                $Permission->status = $request->status;
                $Permission->add_user = Auth::id();
                $Permission->save();

                $roles_list = roleslist::get();

                foreach ($roles_list as $rt){
                    $userroles_status = 'role_permission'.$rt->id;
                    $userroles_status_request = $request->$userroles_status;

                    if(empty($userroles_status_request)){
                        $userroles_status_request = 2;
                    }else{
                        $userroles_status_request = 1;
                    }
                    $user_r = new userroles();
                    $user_r->permission_id = $Permission->id;
                    $user_r->roles_list_id = $rt->id;
                    $user_r->status = $userroles_status_request;
                    $user_r->add_user = Auth::id();
                    $user_r->save();

                }
                return response()->json(['type' => "success",'route_url'=>route('permission.index')]);
            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
        }

        if($request->id == "update"){
            $validator = Validator::make($request->all(), [
                'name'=>'required',
                'status'=>'required',
            ]);
            if ($validator->passes()) {
                $Permission = permission::find($request->permission_id);
                $Permission->name = $request->name;
                $Permission->status = $request->status;
                $Permission->update_user = Auth::id();
                $Permission->save();

                $user_roles = userroles::where('permission_id',$Permission->id)->get();
                foreach ($user_roles as $ur){
                    $userroles_status = 'edit_permission'.$ur->id;
                    $userroles_status_request = $request->$userroles_status;

                    if(empty($userroles_status_request)){
                        $userroles_status_request = 2;
                    }else{
                        $userroles_status_request = 1;
                    }

                    $user_r = userroles::find($ur->id);
                    $user_r->status = $userroles_status_request;
                    $user_r->save();
                }

                return response()->json(['type' => "success"]);
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
        return view('Kpanel.permission.edit')->with('permission',permission::find($id))->with('users_roles',userroles::get())->with('roles_table',roleslist::get());
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
