<?php

namespace App\Http\Controllers\Faq;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use App\Models\fixed_language_word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['faq_category'] = FaqCategory::get();
        return view('Kpanel.faq.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Kpanel.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->id == "add_faq_new"){
            $faq_model = new Faq();
            $faq_add_new = $faq_model->getFaqAdd($request->count);
            return response()->json(['type' => 'success', 'success_message_array' => array(Lang::get('global.success_message')), 'listData' => $faq_add_new]);

        }
        if($request->id == "create"){
            $validator = Validator::make($request->all(), [
                'status' => 'required',
            ],[
                'status.required'=>Lang::get('faq.status_required'),
            ]);
            if ($validator->passes()){
                $faq_category = new FaqCategory();
                $faq_category->title = $request->title;
                $faq_category->description = $request->description;
                $faq_category->add_user = Auth::id();
                $faq_category->save();


                for ($x = 1; $x <= $request->count; $x++) {
                    $question = "question".$x;
                    $answer = "answer".$x;
                    if(!empty($request->$question) && !empty($request->$answer)){
                        $faq_model = new Faq();
                        $faq_model->question = $request->$question;
                        $faq_model->answer = $request->$answer;
                        $faq_model->faq_category_id = $faq_category->id;
                        $faq_model->add_user = Auth::id();
                        $faq_model->save();
                    }
                }

                $route_url = route('faq.index');
                return response()->json(['type' => 'success', 'success_message_array' => array(Lang::get('global.success_message')), 'route_url' => $route_url]);

            }else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
            return response()->json(['error' => $validator->errors()->all()]);

        }
        if($request->id == "update"){
            $validator = Validator::make($request->all(), [
                'status' => 'required',
            ],[
                'status.required'=>Lang::get('faq.status_required'),
            ]);
            if ($validator->passes()){
                $faq_category = FaqCategory::find($request->faq_id);
                $faq_category->title = $request->title;
                $faq_category->description = $request->description;
                $faq_category->update_user = Auth::id();
                $faq_category->save();

                foreach ($faq_category->faq as $f){
                    $question = "questions".$f->id;
                    $answer = "answer".$f->id;
                    if(!empty($request->$question) && !empty($request->$answer)){
                        $f->question = $request->$question;
                        $f->answer = $request->$answer;
                        $f->update_user = Auth::id();
                        $f->save();
                    }
                }

                for ($x = 1; $x <= $request->count; $x++) {
                    $question = "question".$x;
                    $answer = "answer".$x;
                    if(!empty($request->$question) && !empty($request->$answer)){
                        $faq_model = new Faq();
                        $faq_model->question = $request->$question;
                        $faq_model->answer = $request->$answer;
                        $faq_model->faq_category_id = $faq_category->id;
                        $faq_model->add_user = Auth::id();
                        $faq_model->save();
                    }
                }

                $faq_model = new Faq();
                $listData = $faq_model->getTableReview($faq_category->id);
                return response()->json(['type' => 'success', 'success_message_array' => array(Lang::get('global.success_message')),'listData'=>$listData]);

            }else{
                return response()->json(['error' => $validator->errors()->all()]);

            }
        }
        if($request->id == "faq_delete"){
            $faq = Faq::find($request->faq_id);
            if(!empty($faq)){
                $faq->delete();
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
        $faq = FaqCategory::find($id);
        if(!empty($faq)){
            $data['faq'] = $faq;
            return view('Kpanel.faq.edit')->with($data);
        }else{
            return view('Kpanel.404');
        }
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
        $faq = FaqCategory::find($id);
        if(!empty($faq)){
            $faq->delete();
            $faq_model = new FaqCategory();
            $listData = $faq_model->getTableReview();
            return response()->json(['type' => 'success', 'success_message_array' => array(Lang::get('global.success_message')),'tableRefresh' => 1, 'listData' => $listData]);

        }else{
            return response()->json(['type' => 'error', 'error_message_array' => array(Lang::get('global.error_message'))]);
        }
    }
}
