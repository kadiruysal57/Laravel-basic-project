<?php

namespace App\Http\Controllers\Portfolio;

use App\Http\Controllers\Controller;
use App\Models\portfolio_group;
use App\Models\portfolio_group_image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Lang;


class PortfolioGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['portfolio_group'] = portfolio_group::get();
        return view('Kpanel.portfolio.group.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Kpanel.portfolio.group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->id == "add_portfolio_image"){
            $portfolio_group_image = new portfolio_group_image();
            $portfolio_group_image = $portfolio_group_image->getImageAdd($request->count);
            return response()->json(['type' => 'success', 'success_message_array' => array(Lang::get('global.success_message')), 'listData' => $portfolio_group_image]);

        }
        if($request->id == "create"){
            $validator = Validator::make($request->all(), [
                'status' => 'required',
            ],[
                'status.required'=> __('portfolio.status_required'),
            ]);
            if ($validator->passes()){
                $portfolio_group = new portfolio_group();
                $portfolio_group->title = $request->title;
                $portfolio_group->status = $request->status;
                $portfolio_group->add_user = Auth::id();
                $portfolio_group->save();

                for ($x = 1; $x <= $request->count; $x++) {
                    $image = "portfolio_image_input".$x;
                    $title = "image_title".$x;
                    $description = "image_description".$x;
                    $order = "image_order".$x;
                    if(!empty($request->$image)){
                        $portfolio_group_image = new portfolio_group_image();
                        $portfolio_group_image->image_url = str_replace(env('APP_URL'),'',$request->$image);
                        $portfolio_group_image->title = $request->$title;
                        $portfolio_group_image->description = $request->$description;
                        $portfolio_group_image->image_order = $request->$order;
                        $portfolio_group_image->portfolio_group_id  = $portfolio_group->id;
                        $portfolio_group_image->add_user = Auth::id();
                        $portfolio_group_image->save();
                    }
                }
                $route_url = route('portfolio-group.index');
                return response()->json(['type' => 'success', 'success_message_array' => array(\Illuminate\Support\Facades\Lang::get('global.success_message')), 'route_url' => $route_url]);


            }else{
                return response()->json(['error' => $validator->errors()->all()]);

            }


        }
        if($request->id == "update"){
            $validator = Validator::make($request->all(), [
                'status' => 'required',
            ],[
                'status.required'=> __('portfolio.status_required'),
            ]);
            if ($validator->passes()){
                $portfolio_group = portfolio_group::find($request->portfolio_group_id);
                $portfolio_group->title = $request->title;
                $portfolio_group->status = $request->status;
                $portfolio_group->add_user = Auth::id();
                $portfolio_group->save();

                foreach($portfolio_group->image as $x){
                    $image = "portfolio_image_inputs".$x->id;
                    $title = "image_titles".$x->id;
                    $description = "image_descriptions".$x->id;
                    $order = "image_orders".$x->id;
                    if(!empty($request->$image)){
                        $x->image_url = str_replace(env('APP_URL'),'',$request->$image);
                        $x->title = $request->$title;
                        $x->description = $request->$description;
                        $x->image_order = $request->$order;
                        $x->update_user = Auth::id();
                        $x->save();
                    }
                }

                for ($x = 1; $x <= $request->count; $x++) {
                    $image = "portfolio_image_input".$x;
                    $title = "image_title".$x;
                    $description = "image_description".$x;
                    $order = "image_order".$x;
                    if(!empty($request->$image)){
                        $portfolio_group_image = new portfolio_group_image();
                        $portfolio_group_image->image_url = str_replace(env('APP_URL'),'',$request->$image);
                        $portfolio_group_image->title = $request->$title;
                        $portfolio_group_image->description = $request->$description;
                        $portfolio_group_image->image_order = $request->$order;
                        $portfolio_group_image->portfolio_group_id  = $portfolio_group->id;
                        $portfolio_group_image->add_user = Auth::id();
                        $portfolio_group_image->save();
                    }
                }
                $portfolio_group_model = new portfolio_group_image();
                $listData = $portfolio_group_model->getTableReview($portfolio_group->id);
                return response()->json(['type' => 'success', 'success_message_array' => array(Lang::get('global.success_message')),'listData'=>$listData]);
            }else{
                return response()->json(['error' => $validator->errors()->all()]);

            }
        }
        if($request->id == "portfolio_image_del"){
            $portfolio_group_image = portfolio_group_image::find($request->image_id);
            if(!empty($portfolio_group_image)){
                $portfolio_group_image->delete();
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
        $portfolio_group = portfolio_group::find($id);
        if(!empty($portfolio_group)){
            $data['portfolio_group'] = $portfolio_group;
            return view('Kpanel.portfolio.group.edit')->with($data);
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
        $portfolio_group = portfolio_group::find($id);
        if(!empty($portfolio_group)){
            $portfolio_group->delete();
            $portfolio_group = new portfolio_group();
            $listData = $portfolio_group->getTableReview();
            return response()->json(['type' => 'success', 'success_message_array' => array(Lang::get('global.success_message')),'tableRefresh' => 1, 'listData' => $listData]);

        }else{
            return response()->json(['type' => 'error', 'error_message_array' => array(Lang::get('global.error_message'))]);
        }
    }
}
