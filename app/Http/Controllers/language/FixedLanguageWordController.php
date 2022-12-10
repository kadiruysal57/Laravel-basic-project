<?php

namespace App\Http\Controllers\language;

use App\Http\Controllers\Controller;
use App\Models\fixed_language_word;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class FixedLanguageWordController extends Controller
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
        $data['word'] = fixed_language_word::get();

        $data['languages'] = Language::where('status',1)->orderBy('main_language','asc')->get();
        return view('Kpanel.fixed_language_word.index')->with($data);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$this->PermissionCheck()){

            return response()->json(['error' => array('Bu Modülü Güncelleme Yetkiniz Bulunmamaktadır.')]);

        }
        if ($request->id == "add_new_word") {
            $fixed_word_model = new fixed_language_word();
            $listData = $fixed_word_model->getWordAdd($request->count);
            return response()->json(['type' => 'success', 'success_message_array' => array(Lang::get('global.success_message')), 'listData' => $listData]);
        }
        if ($request->id == "update") {
            for ($x = 1; $x <= $request->count; $x++) {
                $code_name = "code_name" . $x;
                $fixed_word = "fixed_word" . $x;
                $languages = "languages" . $x;
                if (!empty($request->$code_name) && !empty($request->$fixed_word) && !empty($request->$languages)) {
                    $fixed_word_model = new fixed_language_word();
                    $fixed_word_model->lang_id = $request->$languages;
                    $fixed_word_model->code_name = $request->$code_name;
                    $fixed_word_model->word = $request->$fixed_word;
                    $fixed_word_model->lock = 2;
                    $fixed_word_model->add_user = Auth::id();
                    $fixed_word_model->save();
                }
            }

            $getAllWord = fixed_language_word::get();
            foreach ($getAllWord as $w){
                $code_name = "code_names" . $w->id;
                $fixed_word = "fixed_words" . $w->id;
                $languages = "languages_s" . $w->id;
                if (!empty($request->$code_name) && !empty($request->$fixed_word) && !empty($request->$languages)) {
                    $w->lang_id = $request->$languages;
                    $w->code_name = $request->$code_name;
                    $w->word = $request->$fixed_word;
                    $w->update_user = Auth::id();
                    $w->save();
                }
            }
            $fixed_word_model = new fixed_language_word();
            $listData = $fixed_word_model->getTableReview();
            return response()->json(['type' => 'success', 'success_message_array' => array(Lang::get('global.success_message')), 'listData' => $listData]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$this->PermissionCheck()){

            return response()->json(['error' => array('Bu Modülü Güncelleme Yetkiniz Bulunmamaktadır.')]);

        }
        $fixed_word = fixed_language_word::find($id);
        if(!empty($fixed_word)){
            $fixed_word->delete();
            $fixed_word_model = new fixed_language_word();
            $listData = $fixed_word_model->getTableReview();
            return response()->json(['type' => 'success', 'success_message_array' => array(Lang::get('global.success_message')),'tableRefresh' => 1, 'listData' => $listData]);
        }else{
            return response()->json(['type' => 'error', 'error_message_array' => array(Lang::get('global.error_message'))]);
        }
    }
}
