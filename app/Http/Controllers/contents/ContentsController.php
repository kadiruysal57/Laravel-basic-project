<?php

namespace App\Http\Controllers\contents;

use App\Http\Controllers\Controller;
use App\Models\BlokGroups;
use App\Models\ContentBlokFiles;
use App\Models\MainBlok;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contents;
use Illuminate\Support\Facades\Lang;
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

        return view('Kpanel.contents.index')->with('contents', Contents::get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data['blok_groups'] = BlokGroups::where('status', 1)->get();
        return view('Kpanel.contents.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->id == "create") {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'title' => 'required',
                'short_desc' => 'required',
                'seo_title' => 'required',
                'keywords' => 'required',
                'seo_description' => 'required',
                'focus_keywords' => 'required',
            ]);
            if ($validator->passes()) {
                try {

                    $contents = new Contents();
                    $contents->name = $request->name;
                    $contents->title = $request->title;
                    $contents->short_desc = $request->short_desc;
                    $contents->keywords = $request->keywords;
                    $contents->seo_title = $request->seo_title;
                    $contents->seo_description = $request->seo_description;
                    $contents->focus_keywords = $request->focus_keywords;
                    if (empty($request->seo_url)) {
                        $seo_url = Str::slug($request->name);
                        $contents->seo_url = $seo_url;
                    } else {
                        $contents->seo_url = $request->seo_url;
                    }
                    $contents->left_blok_active = checkboxorswitch($request->left_blok);
                    $contents->right_blok_active = checkboxorswitch($request->right_blok);
                    $contents->add_user = Auth::id();
                    $contents->save();

                    /*Blok Management Save Code*/
                    $blok_data = array(); /* Keyler Main Blok Id ile eşit olmalıdır*/
                    $blok_data['1'] = json_decode($request->top_blok_data);
                    $blok_data['2'] = json_decode($request->left_blok_data);
                    $blok_data['3'] = json_decode($request->mid_blok_data);
                    $blok_data['4'] = json_decode($request->right_blok_data);
                    $blok_data['5'] = json_decode($request->footer_blok_data);

                    foreach ($blok_data as $key => $bd) {
                        foreach ($bd as $order => $data) {

                            $ContentBlokFilesNewData = new ContentBlokFiles();
                            $ContentBlokFilesNewData->main_blok_id = $key;
                            $ContentBlokFilesNewData->group_id = $data->groupid;
                            $ContentBlokFilesNewData->content_id = $contents->id;
                            $ContentBlokFilesNewData->blok_files_id = $data->id;
                            $ContentBlokFilesNewData->blok_file_order = ++$order;
                            $ContentBlokFilesNewData->add_user = Auth::id();
                            $ContentBlokFilesNewData->save();
                        }
                    }
                    return response()->json(['type' => "success", 'route_url' => route('contents.index'), 'success_message_array' => array(Lang::get('global.success_message'))]);
                } catch (Throwable $e) {
                    report($e);
                    return response()->json(['type' => 'error', 'error_message_array' => array(Lang::get('global.error_message'))]);
                    $contents = new Contents();
                    $contents->name = $request->name;
                    $contents->title = $request->title;
                    $contents->short_desc = $request->short_desc;
                    $contents->keywords = $request->keywords;
                    $contents->seo_title = $request->seo_title;
                    $contents->seo_description = $request->seo_description;
                    $contents->focus_keywords = $request->focus_keywords;
                    $contents->description = $request->description;
                    if (empty($request->seo_url)) {
                        $seo_url = Str::slug($request->name);
                        $contents->seo_url = $seo_url;
                    } else {
                        $contents->seo_url = $request->seo_url;
                    }

                    /*Blok Management Save Code*/


                }

            }
        }
        if ($request->id == "update") {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'title' => 'required',
                'short_desc' => 'required',
                'seo_title' => 'required',
                'keywords' => 'required',
                'seo_description' => 'required',
                'focus_keywords' => 'required',
            ]);
            if ($validator->passes()) {
                $contents = Contents::find($request->contents_id);
                $contents->name = $request->name;
                $contents->title = $request->title;
                $contents->short_desc = $request->short_desc;
                $contents->keywords = $request->keywords;
                $contents->seo_title = $request->seo_title;
                $contents->seo_description = $request->seo_description;
                $contents->focus_keywords = $request->focus_keywords;
                $contents->description = $request->description;

                if (empty($request->seo_url)) {
                    $seo_url = Str::slug($request->name);
                    $contents->seo_url = $seo_url;
                } else {
                    $contents->seo_url = $request->seo_url;
                }

                $contents->left_blok_active = checkboxorswitch($request->left_blok);
                $contents->right_blok_active = checkboxorswitch($request->right_blok);
                $contents->update_user = Auth::id();
                $contents->save();

                /*Blok Management Save Code*/
                $blok_data = array(); /* Keyler Main Blok Id ile eşit olmalıdır*/
                $blok_data['1'] = json_decode($request->top_blok_data);
                $blok_data['2'] = json_decode($request->left_blok_data);
                $blok_data['3'] = json_decode($request->mid_blok_data);
                $blok_data['4'] = json_decode($request->right_blok_data);
                $blok_data['5'] = json_decode($request->footer_blok_data);

                foreach ($blok_data as $key => $bd) {
                    foreach ($bd as $order => $data) {

                        if (!empty($data->pagefileid)) {
                            $check = ContentBlokFiles::where('id', $data->pagefileid)->first();
                            if (!empty($check)) {
                                $ContentBlokFilesNewData = ContentBlokFiles::where('id', $data->pagefileid)->first();
                                $ContentBlokFilesNewData->main_blok_id = $key;

                                $ContentBlokFilesNewData->blok_file_order = ++$order;
                                $ContentBlokFilesNewData->update_user = Auth::id();
                                $ContentBlokFilesNewData->save();
                            }
                        } else {

                            $ContentBlokFilesNewData = new ContentBlokFiles();
                            $ContentBlokFilesNewData->main_blok_id = $key;
                            $ContentBlokFilesNewData->group_id = $data->groupid;
                            $ContentBlokFilesNewData->content_id = $contents->id;
                            $ContentBlokFilesNewData->blok_files_id = $data->id;
                            $ContentBlokFilesNewData->blok_file_order = ++$order;
                            $ContentBlokFilesNewData->add_user = Auth::id();
                            $ContentBlokFilesNewData->save();
                        }

                    }
                }

                $blok_group = new BlokGroups();
                $file_array = $blok_group->content_blok_file($contents->id);

                return response()->json(['type' => 'success', 'success_message_array' => array(Lang::get('global.success_message')), 'file_array' => $file_array]);
            } else {
                return response()->json(['error' => $validator->errors()->all()]);
            }

            if ($request->id == "blok-file-delete") {

                $check = ContentBlokFiles::where('id', $request->page_files_id)->first();
                if (!empty($check)) {
                    $check->delete();
                    $blok_group = new BlokGroups();
                    $file_array = $blok_group->content_blok_file($request->contentsid);


                    return response()->json(['type' => 'success', 'success_message_array' => array(Lang::get('global.success_message')), 'file_array' => $file_array]);

                } else {
                    return response()->json(['type' => 'error', 'error_message_array' => array(Lang::get('global.error_message'))]);
                }
            }
        }

        if ($request->id == "blok-file-delete") {

            $check = ContentBlokFiles::where('id', $request->page_files_id)->first();
            if (!empty($check)) {
                $check->delete();
                $blok_group = new BlokGroups();
                $file_array = $blok_group->content_blok_file($request->contentsid);


                return response()->json(['type' => 'success', 'success_message_array' => array(Lang::get('global.success_message')), 'file_array' => $file_array]);

            } else {
                return response()->json(['type' => 'error', 'error_message_array' => array(Lang::get('global.error_message'))]);
            }
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
        $data['blok_groups'] = BlokGroups::where('status', 1)->get();
        $data['contents'] = Contents::find($id);
        return view('Kpanel.contents.edit')->with($data);
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $content = Contents::where('id', $id)->first();
        if (!empty($content)) {
            $content->delete();
            $content_model = new Contents();
            $content_all = $content_model->getTableReview();
            return response()->json(['type' => 'success', 'tableRefresh' => 1, 'listData' => $content_all, 'success_message_array' => array(Lang::get('global.success_message'))]);

        } else {
            return response()->json(['type' => 'error', 'error_message_array' => array(Lang::get('global.error_message'))]);

        }
    }
}
