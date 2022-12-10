<?php

namespace App\Http\Controllers\SiteSettings;

use App\Http\Controllers\Controller;
use App\Models\open_hourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Lang;

class OpenHourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$this->PermissionCheck()) {
            return response()->json(['error' => array('Bu Modülü Güncelleme Yetkiniz Bulunmamaktadır.')]);
        }
        $validator = Validator::make($request->all(), [
            'start_day' => 'required',
            'finish_day' => 'required',
            'office_id' => 'required',
            'start_time' => 'required',
            'finish_time' => 'required',
        ], [
            'start_day.required' => __('sitesettings.start_day_required'),
            'finish_day.required' => __('sitesettings.finish_day_required'),
            'office_id.required' => __('sitesettings.office_id_required'),
            'start_time.required' => __('sitesettings.start_time_required'),
            'finish_time.required' => __('sitesettings.finish_time_required'),
        ]);
        if ($validator->passes()) {

            if (!empty($request->open_hourse_id)) {
                $open_hourse_id = open_hourse::find($request->open_hourse_id);
                $open_hourse_id->update_user = Auth::id();
            } else {
                $open_hourse_id = new open_hourse();
                $open_hourse_id->add_user = Auth::id();
            }

            $open_hourse_id->site_setting_id = $request->open_hourse_site_settings_id;
            $open_hourse_id->start_day = $request->start_day;
            $open_hourse_id->finish_day = $request->finish_day;
            $open_hourse_id->office_id = $request->office_id;
            $open_hourse_id->start_time = $request->start_time;
            $open_hourse_id->finish_time = $request->finish_time;
            $open_hourse_id->save();

            $open_hourse_modal = new open_hourse();
            $listData = $open_hourse_modal->getTableReview($request->open_hourse_site_settings_id);
            return response()->json(['type' => 'success', 'site_settings_id' => $request->open_hourse_site_settings_id, 'listData' => $listData, 'tableRefresh' => 1, 'success_message_array' => array(Lang::get('global.success_message'))]);


        } else {
            return response()->json(['error' => $validator->errors()->all()]);

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
        //
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
        if (!$this->PermissionCheck()) {
            return response()->json(['error' => array('Bu Modülü Güncelleme Yetkiniz Bulunmamaktadır.')]);
        }
        if ($id == "show_open_hourse") {
            $open_hourse = open_hourse::find($request->id);
            if (!empty($open_hourse)) {
                return response()->json(['type' => 'success', 'listdata' => $open_hourse]);
            } else {
                return response()->json(['type' => 'error', 'error_message_array' => array(Lang::get('global.error_message'))]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!empty($id)) {
            $open_hourse = open_hourse::find($id);

            if (!empty($open_hourse)) {

                $sitesettings_id = $open_hourse->site_setting_id;
                $open_hourse->delete();

                $open_hourse_modal = new open_hourse();
                $listData = $open_hourse_modal->getTableReview($sitesettings_id);
                return response()->json(['type' => 'success', 'site_settings_id' => $sitesettings_id, 'listData' => $listData, 'tableRefresh' => 1, 'success_message_array' => array(Lang::get('global.success_message'))]);

            } else {
                return response()->json(['type' => 'error', 'error_message_array' => array(Lang::get('global.error_message'))]);

            }
        } else {
            return response()->json(['type' => 'error', 'error_message_array' => array(Lang::get('global.error_message'))]);

        }
    }
}
