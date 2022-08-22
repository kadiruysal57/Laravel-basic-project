<?php

namespace App\Http\Controllers\authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function sign_in(){
        return view('Kpanel.authentication.signin');
    }
    public function sign_in_post(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->passes()) {
            if(!empty($request->remember_me)){
                $remember = true;
            }else{
                $remember = false;
            }
            $userdata = array(
                'email' => $request->email,
                'password' => $request->password,
            );
            if (Auth::attempt($userdata, $remember)) {
                return response()->json(['type' => "success", 'route_url' => route('dashboard')]);
            }else{
                $error = array("Unknown email or password. Check again or try your email address and password.");
                return response()->json(['type'=>'error','error' => $error]);
            }
        } else {
            return response()->json(['type'=>'error','error' => $validator->errors()->all()]);
        }
    }


    public function logout(){
        Auth::logout();
        return redirect(route('sign_in'));
    }
}
