<?php

namespace App\Http\Controllers\slider;

use App\Http\Controllers\Controller;
use App\Models\slider;
use App\Models\slider_image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Kpanel.slider.index')->with('slider',slider::where('status',1)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Kpanel.slider.create');
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
                'description'=>'required',
                'status'=>'required',
            ]);
            if ($validator->passes()) {
                $slide = new slider();
                $slide->name = $request->name;
                $slide->title = $request->title;
                $slide->description = $request->description;
                $slide->status = $request->status;
                $slide->add_user = Auth::id();
                $slide->save();

                for ($i = 0; $i <= $request->count; $i++) {
                    $title = "slider_title" . $i;
                    $description = "slider_desc". $i;
                    $text = "slider_text". $i;
                    $button_text = "button_text". $i;
                    $button_colour = "button_colour". $i;
                    $filepath = "filepath". $i;
                    if(!empty($request->$filepath)){
                        $slide_image = new slider_image();
                        $slide_image->title = $request->$title;
                        $slide_image->description =  $request->$description;
                        $slide_image->text = $request->$text;
                        $slide_image->button_text =  $request->$button_text;
                        $slide_image->button_colour =  $request->$button_colour;
                        $slide_image->url =  $request->$filepath;
                        $slide_image->status = 1;
                        $slide_image->slider_id = $slide->id;
                        $slide_image->add_user = Auth::id();
                        $slide_image->save();
                    }
                }
                return response()->json(['type' => "success",'route_url'=>route('slider.index')]);

            }
        }

        if($request->id == "update"){
            $validator = Validator::make($request->all(), [
                'name'=>'required',
                'title'=>'required',
                'description'=>'required',
                'status'=>'required',
            ]);
            if ($validator->passes()) {
                $slide = slider::find($request->slider_id);
                $slide->name = $request->name;
                $slide->title = $request->title;
                $slide->description = $request->description;
                $slide->status = $request->status;
                $slide->update_user = Auth::id();
                $slide->save();

                for ($i = 0; $i <= $request->count; $i++) {
                    $title = "slider_title" . $i;
                    $description = "slider_desc". $i;
                    $text = "slider_text". $i;
                    $button_text = "button_text". $i;
                    $button_colour = "button_colour". $i;
                    $filepath = "filepath". $i;
                    if(!empty($request->$filepath)){
                        $slide_image = new slider_image();
                        $slide_image->title = $request->$title;
                        $slide_image->description =  $request->$description;
                        $slide_image->text = $request->$text;
                        $slide_image->button_text =  $request->$button_text;
                        $slide_image->button_colour =  $request->$button_colour;
                        $slide_image->url =  $request->$filepath;
                        $slide_image->status = 1;
                        $slide_image->slider_id = $slide->id;
                        $slide_image->add_user = Auth::id();
                        $slide_image->save();
                    }
                }

                $slider_image = slider_image::where('slider_id',$slide->id)->where('status',1)->get();
                foreach ($slider_image as $si){
                    $title_edit = "slider_title_edit" . $si->id;
                    $description_edit = "slider_desc_edit". $si->id;
                    $text_edit = "slider_text_edit". $si->id;
                    $button_text_edit = "button_text_edit". $si->id;
                    $button_colour_edit = "button_colour_edit". $si->id;
                    $filepath_edit = "filepath_edit". $si->id;
                    
                    if(!empty($request->$filepath_edit)){

                        $slide_image = slider_image::find($si->id);
                        $slide_image->title = $request->$title_edit;
                        $slide_image->description =  $request->$description_edit;
                        $slide_image->text = $request->$text_edit;
                        $slide_image->button_text =  $request->$button_text_edit;
                        $slide_image->button_colour =  $request->$button_colour_edit;
                        $slide_image->url =  $request->$filepath_edit;
                        $slide_image->status = 1;
                        $slide_image->slider_id = $slide->id;
                        $slide_image->update_user = Auth::id();
                        $slide_image->save();
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
        return view('Kpanel.slider.edit')->with('slider',slider::find($id));
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
