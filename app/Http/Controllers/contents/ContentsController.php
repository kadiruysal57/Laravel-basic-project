<?php

namespace App\Http\Controllers\contents;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contents;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class ContentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Kpanel.contents.index')->with('contents',Contents::get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('Kpanel.contents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->id == "create"){

            $validator = Validator::make($request->all(), [
                'name'=>'required',
                'title'=>'required',
                'short_desc'=>'required',
                'seo_title'=>'required',
                'keywords'=>'required',
                'seo_description'=>'required',
                'focus_keywords'=>'required',
            ]);
            if($validator->passes()){
                $contents = new Contents();
                $contents->name = $request->name;
                $contents->title = $request->title;
                $contents->short_desc = $request->short_desc;
                $contents->keywords = $request->keywords;
                $contents->seo_title = $request->seo_title;
                $contents->seo_description = $request->seo_description;
                $contents->focus_keywords = $request->focus_keywords;
                if(empty($request->seo_url)){
                    $seo_url = Str::slug($request->name);
                    $contents->seo_url = $seo_url;
                }else{
                    $contents->seo_url = $request->seo_url;
                }
                $contents->add_user = Auth::id();
                $contents->save();
                return response()->json(['type' => "success",'route_url'=>route('contents.index')]);
            }

        }

        if($request->id == "update"){

            $validator = Validator::make($request->all(), [
                'name'=>'required',
                'title'=>'required',
                'short_desc'=>'required',
                'seo_title'=>'required',
                'keywords'=>'required',
                'seo_description'=>'required',
                'focus_keywords'=>'required',
            ]);
            if($validator->passes()){
                $contents = Contents::find($request->contents_id);
                $contents->name = $request->name;
                $contents->title = $request->title;
                $contents->short_desc = $request->short_desc;
                $contents->keywords = $request->keywords;
                $contents->seo_title = $request->seo_title;
                $contents->seo_description = $request->seo_description;
                $contents->focus_keywords = $request->focus_keywords;
                if(empty($request->seo_url)){
                    $seo_url = Str::slug($request->name);
                    $contents->seo_url = $seo_url;
                }else{
                    $contents->seo_url = $request->seo_url;
                }
                $contents->update_user = Auth::id();
                $contents->save();
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
        return view('Kpanel.contents.edit')->with('contents',Contents::find($id));
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
