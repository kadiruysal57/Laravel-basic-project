<?php

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\FrontEndController;




Route::get('/',[FrontEndController::class,'index']);
Route::get('{lang}',[FrontEndController::class,'index']);
Route::get('{lang}/{slug}',[FrontEndController::class,'index']);

Route::post('form-send',function(Request $request){
    $request_validator = array();
    $request_message = array();
    $form = \App\Models\form::find($request->id);
    if(!empty($form)){
        $validator = Validator::make($request->all(),$request_validator,$request_message);
        if ($validator->passes()) {
            $form_send_id = \App\Models\form_send::orderBy('id','desc')->first();

            if(!empty($form_send_id->form_send_id)){
                $form_send_id = $form_send_id->form_send_id +1;
            }else{
                $form_send_id = 1;
            }
            foreach($form->form_input as $input){

                $answer = $input->name;

                $answer2 = "";

                if($input->input_id == 6){
                    if(is_array($request->$answer)){
                        foreach ($request->$answer as $a){
                            $answer2 .=",".$a;
                        }
                    }else{
                        $answer2 = $request->$answer;
                    }

                    $answer2 = ltrim($answer2,',');
                }else{
                    $answer2 = $request->$answer;
                }

                $form_send = new \App\Models\form_send();
                $form_send->form_id = $form->id;
                $form_send->form_input_id = $input->id;
                $form_send->form_send_id = $form_send_id;
                $form_send->answer = $answer2;
                $form_send->save();
            }

            if($form->form_type == 2){
                return response()->json(['type' => 'success','form_type'=>2, 'success_message_array' =>array(array('title'=>$form->form_title,'text'=>$form->form_desc))]);
            }else{
                return response()->json(['type' => 'success','form_type'=>1, 'route_url' =>$form->form_url]);
            }

        }else{
            return response()->json(['type' => 'error', 'error' => $validator->errors()->all()]);
        }
    }else{
        return response()->json(['type' => 'error', 'error' => 'Bir hata oluştu']);
    }
})->name('form_send');


/*Route::get('{lang}/{slug}', function ($lang = null,$slug = null) {
    dd(langUrlControl($lang,$slug));
    $select_themes = \App\Models\ThemesCustomize::find(1);
    if(!empty($lang)){
        $main_language = Language::where('seo_url',$lang)->first();
    }else{
        $main_language = Language::where('main_language',1)->first();
    }
    if(!empty($main_language)){
        $content = \App\Models\Contents::where('seo_url',$slug)->where('language_id',$main_language->id)->first();
        if(!empty($content)){
            $data['content'] =$content;
            $data['select_themes'] = $select_themes;

            $wp_model = new \App\Models\Whatsapp();
            $data['wp'] = $wp_model->getWp();
            return view('themes.'.$select_themes->themes->themes_folder_name.'.app')->with($data);
        }else{
            dd("404");
        }
    }else{
        dd("404");
    }
});*/
