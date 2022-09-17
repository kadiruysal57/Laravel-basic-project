<?php

namespace App\Http\Controllers\gallery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\gallery;
use App\Models\gallery_image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['gallery'] = gallery::get();
        return view('Kpanel.gallery.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Kpanel.gallery.create');
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
                'name' => 'required',
                'title' => 'required',
                'description' => 'required',
                'status'=>'required',
            ],[
                'name.required'=>Lang::get('gallery.gallery_name_required'),
                'title.required'=>Lang::get('gallery.gallery_title_required'),
                'description.required'=>Lang::get('gallery.gallery_description_required'),
                'status.required'=>Lang::get('gallery.gallery_status_required')
            ]);
            if ($validator->passes()) {
                $gallery = new gallery();
                $gallery->name = $request->name;
                $gallery->title = $request->title;
                $gallery->description = $request->description;
                $gallery->add_user = Auth::id();
                $gallery->save();
                for ($x = 0; $x <= $request->gallery_count; $x++) {
                    $url = "filepath_edit".$x;
                    $order = "order".$x;
                    if(!empty($request->$url)){
                        $gallery_image = new gallery_image();
                        $gallery_image->gallery_id = $gallery->id;
                        $gallery_image->url = str_replace(env('APP_URL'),'',$request->$url);
                        $gallery_image->image_order=$request->$order;
                        $gallery_image->add_user = Auth::id();
                        $gallery_image->save();
                    }
                }

                return response()->json(['type' => "success", 'route_url' => route('gallery.index'), 'success_message_array' => array(Lang::get('global.success_message'))]);

            }else {
                return response()->json(['type'=>'error','error' => $validator->errors()->all()]);
            }
        }
        if($request->id == "update"){
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'title' => 'required',
                'description' => 'required',
                'status'=>'required',
            ],[
                'name.required'=>Lang::get('gallery.gallery_name_required'),
                'title.required'=>Lang::get('gallery.gallery_title_required'),
                'description.required'=>Lang::get('gallery.gallery_description_required'),
                'status.required'=>Lang::get('gallery.gallery_status_required')
            ]);
            if ($validator->passes()) {
                $gallery = gallery::where('id',$request->gallery_id)->first();
                if(!empty($gallery)){
                    $gallery->name = $request->name;
                    $gallery->title = $request->title;
                    $gallery->description = $request->description;
                    $gallery->update_user = Auth::id();
                    $gallery->save();


                    foreach ($gallery->gallery_image as $gi){
                        $url = "filepath_edits".$gi->id;
                        $order = "orders".$gi->id;
                        $gi->url = str_replace(env('APP_URL'),'',$request->$url);
                        $gi->image_order = $request->$order;
                        $gi->update_user = Auth::id();
                        $gi->save();
                    }

                    for ($x = 0; $x <= $request->gallery_count; $x++) {
                        $url = "filepath_edit".$x;
                        $order = "order".$x;
                        if(!empty($request->$url)){
                            $image_order = 0;
                            if(!empty($request->$order)){
                                $image_order = $request->$order;
                            }
                            $gallery_image = new gallery_image();
                            $gallery_image->gallery_id = $gallery->id;
                            $gallery_image->url = str_replace(env('APP_URL'),'',$request->$url);
                            $gallery_image->image_order = $image_order;
                            $gallery_image->add_user = Auth::id();
                            $gallery_image->save();
                        }
                    }
                    $gallery_image_model = new gallery_image();
                    $gallery_list = $gallery_image_model->edit_gallery_image_list($gallery->id);
                    return response()->json(['type' => "success", 'tableRefresh' => 1, 'listData' => $gallery_list, 'success_message_array' => array(Lang::get('global.success_message'))]);
                }else{
                    return response()->json(['type' => 'error', 'error_message_array' => array(Lang::get('global.error_message'))]);
                }
                return response()->json(['type' => 'error', 'error_message_array' => array(Lang::get('global.error_message'))]);
            }else {
                return response()->json(['type'=>'error','error' => $validator->errors()->all()]);
            }
        }

        if($request->id == "gallery_image_delete"){
            $gallery_image = gallery_image::where('id',$request->image_id)->first();
            if(!empty($gallery_image)){
                $gallery_image->delete();
                return response()->json(['type' => 'success', 'success_message_array' => array(Lang::get('global.success_message'))]);
            }else{
                return response()->json(['type' => 'error', 'error_message_array' => array(Lang::get('global.error_message'))]);
            }
        }
        if($request->id == "create_gallery_image_new"){
            $gallery_image = new gallery_image();
            $gallery_image_html = $gallery_image->create_gallery_image_new($request->count);
            return response()->json(['type' => 'success', 'tableRefresh' => 1, 'listData' => $gallery_image_html, 'success_message_array' => array(Lang::get('global.success_message'))]);
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
        $data['gallery'] = gallery::where('id',$id)->first();
        return view('Kpanel.gallery.edit')->with($data);
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
        $gallery = gallery::where('id',$id)->first();
        if(!empty($gallery)){
            $gallery->delete();
            $gallery_model = new gallery();
            $gallery_all = $gallery_model->getTableReview();
            return response()->json(['type' => 'success', 'tableRefresh' => 1, 'listData' => $gallery_all, 'success_message_array' => array(Lang::get('global.success_message'))]);

        }else {
            return response()->json(['type' => 'error', 'error_message_array' => array(Lang::get('global.error_message'))]);

        }
    }
}
