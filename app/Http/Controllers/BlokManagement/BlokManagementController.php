<?php

namespace App\Http\Controllers\BlokManagement;

use App\Http\Controllers\Controller;
use App\Models\BlokGroups;
use App\Models\DefaultBlok;
use App\Models\DefaultBlokFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class BlokManagementController extends Controller
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
        $data['default_bloks'] = DefaultBlok::where('status',1)->get();
        return view('Kpanel.blokmanagement.index')->with($data);
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
        $data['blok_groups'] = BlokGroups::where('status', 1)->get();
        return view('Kpanel.blokmanagement.create')->with($data);
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
                'blok_name' => 'required',

            ],[
                'blok_name.required'=>__('blokmanagement.blok_name_required')
            ]);
            if ($validator->passes()) {
                $defaultblok = new DefaultBlok();
                $defaultblok->default_blok_name = $request->blok_name;
                $defaultblok->left_blok_active = checkboxorswitch($request->left_blok);
                $defaultblok->right_blok_active = checkboxorswitch($request->right_blok);
                $defaultblok->add_user = Auth::id();
                $defaultblok->save();
                /*Blok Management Save Code*/
                $blok_data = array(); /* Keyler Main Blok Id ile eşit olmalıdır*/
                $blok_data['1'] = json_decode($request->top_blok_data);
                $blok_data['2'] = json_decode($request->left_blok_data);
                $blok_data['3'] = json_decode($request->mid_blok_data);
                $blok_data['4'] = json_decode($request->right_blok_data);
                $blok_data['5'] = json_decode($request->footer_blok_data);

                foreach ($blok_data as $key => $bd) {
                    foreach ($bd as $order => $data) {

                        $DefaultBlokFile = new DefaultBlokFile();
                        $DefaultBlokFile->main_blok_id = $key;
                        $DefaultBlokFile->group_id = $data->groupid;
                        $DefaultBlokFile->default_blok_id  = $defaultblok->id;
                        $DefaultBlokFile->blok_files_id = $data->id;
                        $DefaultBlokFile->blok_file_order = ++$order;
                        $DefaultBlokFile->html = $data->html;
                        $DefaultBlokFile->add_user = Auth::id();
                        $DefaultBlokFile->save();
                    }
                }

                return response()->json(['type' => "success", 'route_url' => route('blok-management.index'), 'success_message_array' => array(Lang::get('global.success_message'))]);

            }else{
                return response()->json(['type'=>'error','error' => $validator->errors()->all()]);
            }
        }
        if($request->id == "update"){
            $validator = Validator::make($request->all(), [
                'blok_name' => 'required',

            ],[
                'blok_name.required'=>__('blokmanagement.blok_name_required')
            ]);
            if ($validator->passes()) {
                $defaultblok = DefaultBlok::where('id',$request->blok_id)->first();
                if(!empty($defaultblok)){
                    $defaultblok->default_blok_name = $request->blok_name;
                    $defaultblok->left_blok_active = checkboxorswitch($request->left_blok);
                    $defaultblok->right_blok_active = checkboxorswitch($request->right_blok);
                    $defaultblok->update_user = Auth::id();
                    $defaultblok->save();
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
                                $check = DefaultBlokFile::where('id', $data->pagefileid)->first();
                                if (!empty($check)) {
                                    $DefaultBlokFileData = DefaultBlokFile::where('id', $data->pagefileid)->first();
                                    $DefaultBlokFileData->main_blok_id = $key;
                                    $DefaultBlokFileData->blok_file_order = ++$order;
                                    $DefaultBlokFileData->html = $data->html;
                                    $DefaultBlokFileData->update_user = Auth::id();
                                    $DefaultBlokFileData->save();
                                }
                            }
                            else {

                                $DefaultBlokFileNewData = new DefaultBlokFile();
                                $DefaultBlokFileNewData->main_blok_id = $key;
                                $DefaultBlokFileNewData->group_id = $data->groupid;
                                $DefaultBlokFileNewData->default_blok_id = $defaultblok->id;
                                $DefaultBlokFileNewData->blok_files_id = $data->id;
                                $DefaultBlokFileNewData->blok_file_order = ++$order;
                                $DefaultBlokFileNewData->html = $data->html;
                                $DefaultBlokFileNewData->add_user = Auth::id();
                                $DefaultBlokFileNewData->save();
                            }

                        }
                    }

                    $blok_group = new BlokGroups();
                    $file_array = $blok_group->default_blok_file($defaultblok->id);
                    return response()->json(['type' => "success", 'route_url' => route('blok-management.index'), 'success_message_array' => array(Lang::get('global.success_message')),'file_array' => $file_array]);

                }else{
                    return response()->json(['type' => 'error', 'error_message_array' => array(Lang::get('global.error_message'))]);
                }

            }else{
                return response()->json(['type'=>'error','error' => $validator->errors()->all()]);
            }
        }

        if ($request->id == "blok-file-delete") {

            $check = DefaultBlokFile::where('id', $request->page_files_id)->first();
            if (!empty($check)) {
                $check->delete();
                $blok_group = new BlokGroups();
                $file_array = $blok_group->default_blok_file($request->default_blok_id);


                return response()->json(['type' => 'success', 'success_message_array' => array(Lang::get('global.success_message')), 'file_array' => $file_array]);

            } else {
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
        if(!$this->PermissionCheck()){

            return view('Kpanel.401');
        }
        $data['blok_groups'] = BlokGroups::where('status', 1)->get();
        $data['default_blok'] = DefaultBlok::where('id',$id)->first();
        return view('Kpanel.blokmanagement.edit')->with($data);
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
        if(!$this->PermissionCheck()){

            return response()->json(['error' => array('Bu Modülü Silme Yetkiniz Bulunmamaktadır.')]);

        }
        $default_blok = DefaultBlok::where('id', $id)->first();
        if (!empty($default_blok)) {
            $default_blok->status = 2;
            $default_blok->save();
            $default_blok_model = new DefaultBlok();
            $default_blok_all = $default_blok_model->getTableReview();
            return response()->json(['type' => 'success', 'tableRefresh' => 1, 'listData' => $default_blok_all, 'success_message_array' => array(Lang::get('global.success_message'))]);

        } else {
            return response()->json(['type' => 'error', 'error_message_array' => array(Lang::get('global.error_message'))]);

        }
    }
}
