<?php

namespace App\Http\Controllers\slider;

use App\Http\Controllers\Controller;
use App\Models\permission;
use App\Models\slider;
use App\Models\slider_image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
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
        if(!$this->PermissionCheck()){

            return view('Kpanel.401');
        }
        return view('Kpanel.slider.index')->with('slider',slider::where('status',1)->get());
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
        if(!$this->PermissionCheck()){

            return response()->json(['error' => array('Bu Modülü Güncelleme Yetkiniz Bulunmamaktadır.')]);

        }
        if($request->id == "create"){
            $validator = Validator::make($request->all(), [
                'name'=>'required',
                'status' => 'required',
            ],[
                'name.required'=>Lang::get('slider.name_required'),
                'status.required'=>Lang::get('slider.status_required'),
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
                    $button_href = "button_href". $i;
                    $filepath = "filepath". $i;
                    $order = "order". $i;
                    if(empty($request->$order)){
                        $order = $i;
                    }else{
                        $order = $request->$order;
                    }
                    if(!empty($request->$title)){
                        $slide_image = new slider_image();
                        $slide_image->title = $request->$title;
                        $slide_image->description =  $request->$description;
                        $slide_image->text = $request->$text;
                        $slide_image->button_text =  $request->$button_text;
                        $slide_image->button_colour =  $request->$button_colour;
                        $slide_image->button_href =  $request->$button_href;
                        $slide_image->url =  $request->$filepath;
                        $slide_image->order_input = $order;
                        $slide_image->status = 1;
                        $slide_image->slider_id = $slide->id;
                        $slide_image->add_user = Auth::id();
                        $slide_image->save();
                    }
                }
                return response()->json(['type' => "success",'route_url'=>route('slider.index')]);

            }
            else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
            return response()->json(['error' => $validator->errors()->all()]);
        }

        if($request->id == "update"){
            $validator = Validator::make($request->all(), [
                'name'=>'required',
                'status' => 'required',
            ],[
                'name.required'=>Lang::get('slider.name_required'),
                'status.required'=>Lang::get('slider.status_required'),
            ]);
            if ($validator->passes()) {
                $slide = slider::find($request->slider_id);
                $slide->name = $request->name;
                $slide->title = $request->title;
                $slide->description = $request->description;
                $slide->status = $request->status;
                $slide->update_user = Auth::id();
                $slide->save();

                $order_table = slider_image::where('status',1)->where('slider_id', $slide->id)->orderBy('order_input','DESC')->first();
                if(empty($order_table)){
                    $order_last = 0;
                }
                if(!empty($order_table)){
                    $order_last = $order_table->order_input;
                }


                for ($i = 0; $i <= $request->count; $i++) {
                    $title = "slider_title" . $i;
                    $order = "order" . $i;
                    $description = "slider_desc". $i;
                    $text = "slider_text". $i;
                    $button_text = "button_text". $i;
                    $button_colour = "button_colour". $i;
                    $button_href = "button_href". $i;
                    $filepath = "filepath". $i;


                    if(empty($request->$order)){
                        $order_last = $order_last + 1;
                    }else{
                        $order_last = $request->$order;
                    }
                    if(!empty($request->$title)){
                        $slide_image = new slider_image();
                        $slide_image->title = $request->$title;
                        $slide_image->description =  $request->$description;
                        $slide_image->text = $request->$text;
                        $slide_image->button_text =  $request->$button_text;
                        $slide_image->button_colour =  $request->$button_colour;
                        $slide_image->button_href =  $request->$button_href;
                        $slide_image->url =  str_replace(env('APP_URL'),'',$request->$filepath);
                        $slide_image->order_input =  $order_last;
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
                    $button_href_edit = "button_href_edit". $si->id;
                    $filepath_edit = "filepath_edit". $si->id;
                    $order = "order_edit". $si->id;

                    if(!empty($request->$title_edit)){

                        $slide_image = slider_image::find($si->id);
                        $slide_image->title = $request->$title_edit;
                        $slide_image->description =  $request->$description_edit;
                        $slide_image->text = $request->$text_edit;
                        $slide_image->button_text =  $request->$button_text_edit;
                        $slide_image->button_colour =  $request->$button_colour_edit;
                        $slide_image->button_href =  $request->$button_href_edit;
                        $slide_image->url = str_replace(env('APP_URL'),'', $request->$filepath_edit);
                        $slide_image->order_input =  $request->$order;
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
            return response()->json(['error' => $validator->errors()->all()]);


        }

        if($request->id == "delete"){
            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);

            if ($validator->passes()) {

                $slider_image = slider_image::find($request->data);
                $slider_image->status = 2;
                $slider_image->save();

                return response()->json(['type' => "success", 'route_url' => route('slider.index')]);
            } else {
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
        if(empty(slider::find($id))){
            return view('Kpanel.404');
        }
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
        $slider = slider::where('id', $id)->first();
        if (!empty($slider)) {
            $slider->delete();
            $sliderr = new slider();
            $slider_all = $sliderr->getTableReview();
            return response()->json(['type' => 'success', 'tableRefresh' => 1, 'listData' => $slider_all, 'success_message_array' => array(Lang::get('global.success_message'))]);

        } else {
            return response()->json(['type' => 'error', 'error_message_array' => array(Lang::get('global.error_message'))]);

        }

    }
}
