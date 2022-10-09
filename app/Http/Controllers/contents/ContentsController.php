<?php

namespace App\Http\Controllers\contents;

use App\Http\Controllers\Controller;
use App\Models\BlokGroups;
use App\Models\comments;
use App\Models\ContentBlokFiles;
use App\Models\DefaultBlok;
use App\Models\FaqCategory;
use App\Models\gallery;
use App\Models\MainBlok;
use App\Models\portfolio;
use App\Models\services;
use App\Models\slider;
use App\Models\form;
use App\Models\staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contents;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Language;
use App\Models\ContentGallery;
use Illuminate\Validation\Rule;

class ContentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!$this->PermissionCheck()) {

            return view('Kpanel.401');
        }
        $data['contents'] = Contents::get();
        return view('Kpanel.contents.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data['blok_groups'] = BlokGroups::where('status', 1)->get();
        $data['default_bloks'] = DefaultBlok::where('status',1)->get();
        $data['language'] = Language::where('status', 1)->get();
        $data['gallery'] = gallery::where('status', 1)->get();
        $data['slider'] = slider::where('status', 1)->get();
        $data['form'] = form::where('status', 1)->get();
        $data['faq'] = FaqCategory::where('status', 1)->get();
        $data['services'] = services::get();
        $data['portfolio'] = portfolio::where('status', 1)->get();
        $data['comments'] = comments::where('status', 1)->get();
        $data['staff'] = staff::where('status', 1)->get();
        $data['main_pages'] = Contents::where('status',1)->get();
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
        if (!$this->PermissionCheck()) {

            return response()->json(['error' => array('Bu Modülü Güncelleme Yetkiniz Bulunmamaktadır.')]);

        }

        if ($request->id == "create") {
            $content_slug = Contents::where('seo_url', $request->seo_url)->first();
            if (!empty($content_slug)) {
                return response()->json(['type' => 'error', 'error' => array(Lang::get('global.site_name_error'))]);
            }

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'title' => 'required',
                'language_id' => 'required',
                'seo_url' => 'required|unique:contents',
            ], [
                'name.required' => Lang::get('contents.name_required'),
                'title.required' => Lang::get('contents.title_required'),
                'language_id.required' => Lang::get('contents.language_id_required'),
                'seo_url.required' => Lang::get('contents.seo_url_required'),
                'seo_url.unique' => Lang::get('contents.seo_url_unique'),
            ]);
            if ($validator->passes()) {
                try {

                    $contents = new Contents();
                    $contents->name = $request->name;
                    $contents->title = $request->title;
                    $contents->short_desc = $request->short_desc;
                    $contents->description = $request->description;
                    $contents->keywords = $request->keywords;
                    $contents->seo_title = $request->seo_title;
                    $contents->seo_description = $request->seo_description;
                    $contents->language_id = $request->language_id;
                    $contents->gallery_id = $request->gallery_id;
                    $contents->services_id = $request->services_id;
                    $contents->portfolio_id = $request->portfolio_id;
                    $contents->comments_id = $request->comments_id;
                    $contents->staff_id = $request->staff_id;
                    $contents->slider_id = $request->slider_id;
                    $contents->form_id = $request->form_id;
                    $contents->faq_id = $request->faq_id;
                    $contents->focus_keywords = $request->focus_keywords;
                    $contents->main_page = $request->main_page;

                    if (empty($request->seo_url)) {
                        $seo_url = Str::slug($request->name);
                        $contents->seo_url = $seo_url;
                    } elseif ($request->seo_url == "/") {
                        $contents->seo_url = "/";
                    } else {
                        $seo_url = Str::slug($request->seo_url);
                        $contents->seo_url = $seo_url;
                    }
                    $contents->left_blok_active = checkboxorswitch($request->left_blok);
                    $contents->right_blok_active = checkboxorswitch($request->right_blok);
                    $contents->default_blok_id = $request->default_blok;
                    $contents->add_user = Auth::id();
                    $contents->save();

                    for ($i = 0; $i <= $request->count_gallery; $i++) {
                        $gallery_image = "gallery_add_image" . $i;
                        $gallery_order = "image_order" . $i;
                        if (!empty($request->$gallery_image) && $request->$gallery_order) {
                            $gallery_model = new ContentGallery();
                            $gallery_model->content_id = $contents->id;
                            $gallery_model->image_url = str_replace(env('APP_URL'), '', $request->$gallery_image);
                            $gallery_model->image_order = $request->$gallery_order;
                            $gallery_model->add_user = Auth::id();
                            $gallery_model->save();
                        }
                    }


                    if (empty($request->default_blok)) {
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
                                $ContentBlokFilesNewData->html = $data->html;
                                $ContentBlokFilesNewData->add_user = Auth::id();
                                $ContentBlokFilesNewData->save();
                            }
                        }
                    }

                    return response()->json(['type' => "success", 'route_url' => route('contents.index'), 'success_message_array' => array(Lang::get('global.success_message'))]);
                } catch (Throwable $e) {
                    report($e);
                    return response()->json(['type' => 'error', 'error_message_array' => array(Lang::get('global.error_message'))]);
                }

            } else {
                return response()->json(['type' => 'error', 'error' => $validator->errors()->all()]);
            }
        }
        if ($request->id == "update") {
            if (empty($request->seo_url)) {
                $seo_url_2 = Str::slug($request->name);
                $content_slug = Contents::where('seo_url', $seo_url_2)->first();
                if (!empty($content_slug)) {
                    return response()->json(['type' => 'error', 'error' => array(Lang::get('global.site_name_error'))]);
                }
            }
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'title' => 'required',
                'language_id' => 'required',

            ], [
                'name.required' => Lang::get('contents.name_required'),
                'title.required' => Lang::get('contents.title_required'),
                'language_id.required' => Lang::get('contents.language_id_required'),
            ]);
            if ($validator->passes()) {
                $contents = Contents::find($request->contents_id);

                if ($contents->seo_url != $request->seo_url) {
                    $validator = Validator::make($request->all(), [
                        'seo_url' => 'required|unique:contents',
                    ], [
                        'seo_url.required' => Lang::get('contents.seo_url_required'),
                        'seo_url.unique' => Lang::get('contents.seo_url_unique'),
                    ]);
                    if (!$validator->passes()) {
                        return response()->json(['error' => $validator->errors()->all()]);
                    }
                }

                $contents->name = $request->name;
                $contents->title = $request->title;
                $contents->short_desc = $request->short_desc;
                $contents->description = $request->description;
                $contents->keywords = $request->keywords;
                $contents->seo_title = $request->seo_title;
                $contents->gallery_id = $request->gallery_id;
                $contents->services_id = $request->services_id;
                $contents->portfolio_id = $request->portfolio_id;
                $contents->comments_id = $request->comments_id;
                $contents->staff_id = $request->staff_id;
                $contents->slider_id = $request->slider_id;
                $contents->form_id = $request->form_id;
                $contents->faq_id = $request->faq_id;
                $contents->language_id = $request->language_id;
                $contents->seo_description = $request->seo_description;
                $contents->focus_keywords = $request->focus_keywords;
                $contents->main_page = $request->main_page;

                if (empty($request->seo_url)) {
                    $seo_url = Str::slug($request->name);
                    $contents->seo_url = $seo_url;
                } elseif ($request->seo_url == "/") {
                    $contents->seo_url = "/";
                } else {
                    $seo_url = Str::slug($request->seo_url);
                    $contents->seo_url = $seo_url;
                }

                $contents->left_blok_active = checkboxorswitch($request->left_blok);
                $contents->right_blok_active = checkboxorswitch($request->right_blok);
                $contents->default_blok_id = $request->default_blok;
                $contents->update_user = Auth::id();
                $contents->save();

                for ($i = 0; $i <= $request->count_gallery; $i++) {
                    $gallery_image = "gallery_add_image" . $i;
                    $gallery_order = "image_order" . $i;
                    if (!empty($request->$gallery_image) && $request->$gallery_order) {
                        $gallery_model = new ContentGallery();
                        $gallery_model->content_id = $contents->id;
                        $gallery_model->image_url = str_replace(env('APP_URL'), '', $request->$gallery_image);
                        $gallery_model->image_order = $request->$gallery_order;
                        $gallery_model->add_user = Auth::id();
                        $gallery_model->save();
                    }
                }
                foreach ($contents->content_gallery as $c) {
                    $gallery_image = "gallery_add_images" . $c->id;
                    $gallery_order = "image_orders" . $c->id;
                    if (!empty($request->$gallery_image) && $request->$gallery_order) {
                        $gallery_model = ContentGallery::find($c->id);
                        $gallery_model->image_url = str_replace(env('APP_URL'), '', $request->$gallery_image);
                        $gallery_model->image_order = $request->$gallery_order;
                        $gallery_model->update_user = Auth::id();
                        $gallery_model->save();
                    }
                }

                if (empty($request->default_blok)) {
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
                                    $ContentBlokFilesNewData->html = $data->html;
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
                                $ContentBlokFilesNewData->html = $data->html;
                                $ContentBlokFilesNewData->add_user = Auth::id();
                                $ContentBlokFilesNewData->save();
                            }

                        }
                    }
                }


                $blok_group = new BlokGroups();
                $file_array = $blok_group->content_blok_file($contents->id);

                $content_gallery_model = new ContentGallery();
                $content_gallery_all = $content_gallery_model->getTableReview($contents->id);
                return response()->json(['type' => 'success', 'success_message_array' => array(Lang::get('global.success_message')), 'file_array' => $file_array, 'listData' => $content_gallery_all]);
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
        if ($request->id == "seo_url_str") {
            $str_slug = Str::slug($request->name);
            $content_slug = Contents::where('seo_url', $str_slug)->first();
            if (empty($content_slug)) {
                return response()->json(['type' => 'success', 'seo_url' => $str_slug]);
            } else {

                for ($i = 1; $i <= 1000; $i++) {
                    $str_slug = Str::slug($request->name . "-" . $i);
                    $content_slug = Contents::where('seo_url', $str_slug)->first();
                    if (empty($content_slug)) {
                        break;
                    }
                }
                return response()->json(['type' => 'error', 'seo_url' => $str_slug]);

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
        $data['default_bloks'] = DefaultBlok::where('status',1)->get();
        $data['language'] = Language::where('status', 1)->get();
        $data['gallery'] = gallery::where('status', 1)->get();
        $data['slider'] = slider::where('status', 1)->get();
        $data['form'] = form::where('status', 1)->get();
        $data['faq'] = FaqCategory::where('status', 1)->get();
        $data['services'] = services::get();
        $data['portfolio'] = portfolio::where('status', 1)->get();
        $data['comments'] = comments::where('status', 1)->get();
        $data['main_pages'] = Contents::where('status',1)->where('id','!=',$id)->get();
        $data['staff'] = staff::where('status', 1)->get();
        if (empty(Contents::find($id))) {
            return view('Kpanel.404');
        }
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

        if (!$this->PermissionCheck()) {
            return response()->json(['error' => array('Bu Modülü Güncelleme Yetkiniz Bulunmamaktadır.')]);
        }

        if ($id == "gallery_add") {
            $content_gallery = new ContentGallery();
            $gallery_add = $content_gallery->gallery_add($request->count);

            return response()->json(['type' => 'success', 'success_message_array' => array(Lang::get('global.success_message')), 'listData' => $gallery_add]);
        }
        if ($id == "gallery_image_delete") {
            $gallery_image = ContentGallery::find($request->value);

            if (!empty($gallery_image)) {
                $content_id = $gallery_image->content_id;
                $gallery_image->delete();

                $content_gallery_model = new ContentGallery();
                $content_gallery_all = $content_gallery_model->getTableReview($content_id);
                return response()->json(['type' => 'success', 'success_message_array' => array(Lang::get('global.success_message')), 'listData' => $content_gallery_all]);

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
        if (!$this->PermissionCheck()) {

            return response()->json(['error' => array('Bu Modülü Güncelleme Yetkiniz Bulunmamaktadır.')]);

        }
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
