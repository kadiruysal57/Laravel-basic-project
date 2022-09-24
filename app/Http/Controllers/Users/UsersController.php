<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
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
        $data['users'] = User::get();
        return view('Kpanel.users.index')->with($data);
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

        return view('Kpanel.users.create');
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
                'user_name' => 'required',
                'email' => 'required|email|unique:users',
                'status' => 'required',
                'password' => 'required | min:6 |same:password_same',
                'password_same'=>'required'

            ],[
                'user_name.required'=>__('users.user_name_required'),
                'email.required'=>__('users.email_required'),
                'email.email'=>__('users.email_email'),
                'email.unique'=>__('users.email_unique'),
                'password.required'=>__('users.password_required'),
                'password.min'=>__('users.password_min'),
                'password.same'=>__('users.password_same_error'),
                'password_same.required'=>__('users.password_same_required'),
            ]);
            if ($validator->passes()) {
                $user = new User();
                $user->name = $request->user_name;
                $user->status = $request->status;
                $user->email  = $request->email ;
                $user->password  = Hash::make($request->password);
                $user->add_user = Auth::id();
                $user->save();

                return response()->json(['type' => "success", 'route_url' => route('users.index'), 'success_message_array' => array(Lang::get('global.success_message'))]);



            }else{
                return response()->json(['type'=>'error','error' => $validator->errors()->all()]);
            }
        }
        if($request->id == "update"){
            $user = User::where('id',$request->user_id)->first();
            if(!empty($user)){
                $validatorInput = [
                    'user_name' => 'required',
                    'email' => 'required|email',
                    'status' => 'required',

                ];
                $validatorErrors = [
                    'user_name.required'=>__('users.user_name_required'),
                    'email.required'=>__('users.email_required'),
                    'email.email'=>__('users.email_email'),
                    'email.unique'=>__('users.email_unique'),
                    'password.required'=>__('users.password_required'),
                    'password.min'=>__('users.password_min'),
                    'password.same'=>__('users.password_same_error'),
                    'password_same.required'=>__('users.password_same_required'),
                ];
                if($user->email != $request->email){
                    $validatorInput['email']='required|email|unique:users';
                }
                if(!empty($request->password)){
                    $validatorInput['password']='required | min:6 |same:password_same';
                    $validatorInput['password_same']='required';
                }
                $validator = Validator::make($request->all(),$validatorInput,$validatorErrors);
                if ($validator->passes()) {

                    $user->name = $request->user_name;
                    $user->status = $request->status;
                    $user->email  = $request->email;
                    if(!empty($request->password)) {
                        $user->password = Hash::make($request->password);
                    }

                    $user->update_user = Auth::id();
                    $user->save();

                    return response()->json(['type' => "success",'success_message_array' => array(Lang::get('global.success_message'))]);



                }else{
                    return response()->json(['type'=>'error','error' => $validator->errors()->all()]);
                }
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
        if(empty(User::where('id',$id)->first())){
            return view('Kpanel.404');
        }
        $data['user'] = User::where('id',$id)->first();
        return view('Kpanel.users.edit')->with($data);
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
        if(!$this->PermissionCheck()){

            return response()->json(['error' => array('Bu Modülü Silme Yetkiniz Bulunmamaktadır.')]);

        }
        $user = User::where('id', $id)->first();
        if (!empty($user)) {
            $user->delete();
            $user_model = new User();
            $user_all = $user_model->getTableReview();
            return response()->json(['type' => 'success', 'tableRefresh' => 1, 'listData' => $user_all, 'success_message_array' => array(Lang::get('global.success_message'))]);

        } else {
            return response()->json(['type' => 'error', 'error_message_array' => array(Lang::get('global.error_message'))]);

        }
    }
}
