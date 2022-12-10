<?php

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\FrontEndController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


Route::get('sitemap.xml', [FrontEndController::class, 'sitemap'])->name('sitemap');
Route::get('/', [FrontEndController::class, 'index']);
Route::get('{lang}', [FrontEndController::class, 'index']);
Route::get('{lang}/{slug}', [FrontEndController::class, 'index']);


Route::post('form-send', function (Request $request) {
    $request_validator = array();
    $request_message = array();
    if(env('GOOGLE_RECAPTCHA_KEY')){
        $request_validator['g-recaptcha-response'] = 'required|recaptcha';
        $request_message['g-recaptcha-response.required'] = 'Lütfen robot olmadığınızı doğrulayın';
    }
    $form = \App\Models\form::find($request->id);
    if (!empty($form)) {
        foreach ($form->form_input as $input) {
            if($input->input_id == 9){
                if ($input->required == 1) {
                    $form_name = Str::slug($input->name).$input->id;
                    $request_validator[$form_name] = 'required | mimes:ppt,pptx,doc,docx,pdf,xls,xlsx,jpg,png,PNG,JPG,JPEG,jpeg |max:2048';
                    $request_message[$form_name.".mimes"] = $input->name." Alanına Lütfen ppt,pptx,doc,docx,pdf,xls,xlsx uzantılı dosya yükleyiniz.";
                    $request_message[$form_name.".required"] = $input->name." Alanını Doldurmak Zorundasınız.";
                    $request_message[$form_name.".max"] = $input->name." Alanı Max 2MB olabilir";
                }
            }else{
                if ($input->required == 1) {
                    $form_name = Str::slug($input->name).$input->id;
                    $request_validator[$form_name] = 'required';
                    $request_message[$form_name.".required"] = $input->name." Alanını Doldurmak Zorundasınız.";
                }
            }
        }
        $validator = Validator::make($request->all(), $request_validator, $request_message);
        $answer_all = null;
        if ($validator->passes()) {
            $form_send_id = \App\Models\form_send::orderBy('id', 'desc')->first();

            if (!empty($form_send_id->form_send_id)) {
                $form_send_id = $form_send_id->form_send_id + 1;
            } else {
                $form_send_id = 1;
            }
            $att_array=array();
            foreach ($form->form_input as $input) {

                $answer = Str::slug($input->name).$input->id;

                $answer2 = "";

                if ($input->input_id == 6) {
                    if (is_array($request->$answer)) {
                        foreach ($request->$answer as $a) {
                            $answer2 .= "," . $a;
                        }
                    } else {
                        $answer2 = $request->$answer;
                    }

                    $answer2 = ltrim($answer2, ',');
                }
                if($input->input_id == 9){
                    $file_name = $input->name."".$input->id;
                    foreach($request->file() as $key => $file){
                        $files = $_FILES[$key];

                        $path = public_path().'/upload_form';
                        if(!file_exists($path)){
                            File::makeDirectory($path);
                        }
                        $new_name = date("Y-m-d H:i:s");
                        $new_name = strtotime($new_name).".".File::extension($files['name']);

                        $file_path = $path."/".$new_name;
                        move_uploaded_file($files['tmp_name'], $file_path);
                        $answer2 = $new_name;

                        $att_array[] = array(
                            'name'=>$new_name,
                            'filePath'=>asset('upload_form/'.$new_name),
                            'mime'=>File::extension($files['name']),
                            'fileSize'=>$files['size'],
                        );
                        //$att_array[] = public_path('upload_form/'.$new_name);
                    }
                }
                else {
                    $answer2 = $request->$answer;
                }

                $answer_all .= $input->placeholder ." = ".$answer2."<br>";

                $form_send = new \App\Models\form_send();
                $form_send->form_id = $form->id;
                $form_send->form_input_id = $input->id;
                $form_send->form_send_id = $form_send_id;
                $form_send->answer = $answer2;
                $form_send->save();
            }

            $data = $answer_all;
            $form_info = array(
                'form_name'=>$form->name,
                'answer_all' =>$answer_all,

            );
            $to_expolode = explode(',',$form->to);
            foreach($to_expolode as $to){
                $form_info['to'] = $to;
                mail::send('mails.form_send', ['data'=>$data], function ($message) use ($form_info,$att_array) {
                    $message->from('info@kuarkbilisim.com', 'Form Dolduruldu');
                    $message->subject($form_info['form_name']." ".date('d.m.Y H:i'));

                    $message->to($form_info['to']);

                    if(count($att_array) > 0){
                        foreach($att_array as $at){
                            $message->attach($at['filePath']);
                        }
                    }

                });
            }


            if ($form->form_type == 2) {
                return response()->json(['type' => 'success', 'form_type' => 2, 'success_message_array' => array(array('title' => $form->form_title, 'text' => $form->form_desc))]);
            } else {
                return response()->json(['type' => 'success', 'form_type' => 1, 'route_url' => $form->form_url]);
            }



        } else {
            return response()->json(['type' => 'error', 'error' => $validator->errors()->all()]);
        }
    } else {
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
