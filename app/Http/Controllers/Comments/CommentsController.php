<?php

namespace App\Http\Controllers\Comments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\comments;
use App\Models\comments_list;

class CommentsController extends Controller
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
        return view('Kpanel.comments.index')->with('comments',comments::where('status',1)->get());
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
        return view('Kpanel.comments.create');
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
                'status'=>'required',
            ]);
            if ($validator->passes()) {
                $comments = new comments();
                $comments->name = $request->name;
                $comments->description = $request->description;
                $comments->status = $request->status;
                $comments->add_user = Auth::id();
                $comments->save();

                for ($i = 0; $i <= $request->count; $i++) {
                    $name = "comments_name" . $i;
                    $job_title = "comments_job_title". $i;
                    $comments_com = "comments". $i;
                    $rate = "rate". $i;
                    $filepath = "filepath". $i;

                    if(!empty($request->$filepath)){
                        $comments_list = new comments_list();
                        $comments_list->name = $request->$name;
                        $comments_list->job_title =  $request->$job_title;
                        $comments_list->comments = $request->$comments_com;
                        $comments_list->rate = $request->$rate;
                        $comments_list->url =  $request->$filepath;
                        $comments_list->status = 1;
                        $comments_list->comments_id = $comments->id;
                        $comments_list->add_user = Auth::id();
                        $comments_list->save();
                    }
                }
                return response()->json(['type' => "success",'route_url'=>route('comments.index')]);

            }
        }

        if($request->id == "update"){
            $validator = Validator::make($request->all(), [
                'name'=>'required',
                'status'=>'required',
            ]);
            if ($validator->passes()) {
                $comments = comments::find($request->comments_id);
                $comments->name = $request->name;
                $comments->description = $request->description;
                $comments->status = $request->status;
                $comments->update_user = Auth::id();
                $comments->save();

                for ($i = 0; $i <= $request->count; $i++) {
                    $name = "comments_name" . $i;
                    $job_title = "comments_job_title". $i;
                    $comments_com = "comments". $i;
                    $rate = "rate". $i;
                    $filepath = "filepath". $i;

                    if(!empty($request->$filepath)){
                        $comments_list = new comments_list();
                        $comments_list->name = $request->$name;
                        $comments_list->job_title =  $request->$job_title;
                        $comments_list->comments = $request->$comments_com;
                        $comments_list->rate = $request->$rate;
                        $comments_list->url =  $request->$filepath;
                        $comments_list->status = 1;
                        $comments_list->comments_id = $comments->id;
                        $comments_list->add_user = Auth::id();
                        $comments_list->save();
                    }
                }

                $comments_list = comments_list::where('comments_id',$comments->id)->where('status',1)->get();
                foreach ($comments_list as $cl){
                    $name_edit = "comments_name_edit" . $cl->id;
                    $job_title = "comments_job_title_edit". $cl->id;
                    $comments_com = "comments_edit". $cl->id;
                    $rate = "rate_edit". $cl->id;
                    $filepath_edit = "filepath_edit". $cl->id;

                    if(!empty($request->$filepath_edit)){
                        $comments_list = comments_list::find($cl->id);
                        $comments_list->name = $request->$name_edit;
                        $comments_list->job_title =  $request->$job_title;
                        $comments_list->comments = $request->$comments_com;
                        $comments_list->url =  $request->$filepath_edit;
                        $comments_list->rate =  $request->$rate;
                        $comments_list->status = 1;
                        $comments_list->comments_id = $comments->id;
                        $comments_list->update_user = Auth::id();
                        $comments_list->save();
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
        if(!$this->PermissionCheck()){

            return view('Kpanel.401');
        }
        if(empty(comments::find($id))){
            return view('Kpanel.404');
        }
        return view('Kpanel.comments.edit')->with('comments',comments::find($id));
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
