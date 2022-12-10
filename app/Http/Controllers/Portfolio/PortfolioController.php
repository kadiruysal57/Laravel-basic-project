<?php

namespace App\Http\Controllers\Portfolio;

use App\Http\Controllers\Controller;
use App\Models\portfolio;
use App\Models\portfolio_group;
use App\Models\portfolio_select_group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Lang;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['portfolio'] = portfolio::get();
        return view('Kpanel.portfolio.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['portfolio_group'] = portfolio_group::get();
        return view('Kpanel.portfolio.create')->with($data);
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
                'title' => 'required',
                'description' => 'required',
                'status' => 'required',
            ],[
                'title.required'=> __('portfolio.title_required'),
                'description.required'=> __('portfolio.description_required'),
                'status.required'=> __('portfolio.status_required'),
            ]);
            if ($validator->passes()){
                $portfolio = new portfolio();
                $portfolio->title = $request->title;
                $portfolio->description = $request->description;
                $portfolio->status = $request->status;
                $portfolio->add_user = Auth::id();
                $portfolio->save();
                if(!empty($request->portfolio_groups)){
                    foreach ($request->portfolio_groups as $pg){

                        $portfolio_select = new portfolio_select_group();
                        $portfolio_select->portfolio_group_id = $pg;
                        $portfolio_select->portfolio_id = $portfolio->id;
                        $portfolio_select->add_user = Auth::id();
                        $portfolio_select->save();
                    }
                }

                $route_url = route('portfolio.index');
                return response()->json(['type' => 'success', 'success_message_array' => array(Lang::get('global.success_message')), 'route_url' => $route_url]);


            }else{
                return response()->json(['error' => $validator->errors()->all()]);
            }
        }
        if($request->id == "update"){
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
                'status' => 'required',
            ],[
                'title.required'=> __('portfolio.title_required'),
                'description.required'=> __('portfolio.description_required'),
                'status.required'=> __('portfolio.status_required'),
            ]);
            if ($validator->passes()){
                $portfolio = portfolio::find($request->portfolio_id);
                $portfolio->title = $request->title;
                $portfolio->description = $request->description;
                $portfolio->status = $request->status;
                $portfolio->update_user = Auth::id();
                $portfolio->save();

                if(!empty($portfolio->portfolio_select_group)){
                    foreach($portfolio->portfolio_select_group as $p){
                        if(!in_array($p->portfolio_group_id,$request->portfolio_groups)){

                            $p->delete();
                        }
                    }
                }
                if(!empty($request->portfolio_groups)){
                    foreach ($request->portfolio_groups as $pg){
                        $check = portfolio_select_group::where('portfolio_group_id',$pg)->where('portfolio_id',$portfolio->id)->first();

                        if(empty($check)){
                            $portfolio_select = new portfolio_select_group();
                            $portfolio_select->portfolio_group_id = $pg;
                            $portfolio_select->portfolio_id = $portfolio->id;
                            $portfolio_select->update_user = Auth::id();
                            $portfolio_select->save();
                        }
                    }
                }

                $route_url = route('portfolio.index');
                return response()->json(['type' => 'success', 'success_message_array' => array(Lang::get('global.success_message')), 'route_url' => $route_url]);


            }else{
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
        $portfolio = portfolio::find($id);
        if(!empty($portfolio)){
            $select_array = array();
            $data['portfolio'] = $portfolio;
            $data['portfolio_group'] = portfolio_group::get();
            foreach($data['portfolio']->portfolio_select_group as $group){
               array_push($select_array,$group->portfolio_group_id);
            }
            $data['select_array'] = $select_array;
            return view('Kpanel.portfolio.edit')->with($data);
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
        $portfolio = portfolio::find($id);
        if(!empty($portfolio)){
            $portfolio->delete();
            $portfolio_model = new portfolio();
            $listData = $portfolio_model->getTableReview();
            return response()->json(['type' => 'success', 'success_message_array' => array(Lang::get('global.success_message')),'tableRefresh' => 1, 'listData' => $listData]);

        }else{
            return response()->json(['type' => 'error', 'error_message_array' => array(Lang::get('global.error_message'))]);
        }
    }
}
