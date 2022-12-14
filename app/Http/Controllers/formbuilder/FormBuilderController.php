<?php

namespace App\Http\Controllers\formbuilder;

use App\Http\Controllers\Controller;
use App\Models\Contents;
use Illuminate\Http\Request;
use App\Models\form;
use App\Models\form_input;
use App\Models\form_input_value;
use App\Models\input_type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class FormBuilderController extends Controller
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
        return view('Kpanel.formbuilder.index')->with('form', form::where('status', 1)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!$this->PermissionCheck()) {

            return view('Kpanel.401');
        }
        return view('Kpanel.formbuilder.create');
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

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'form_type' => 'required',
            ], [
                'name.required' => __('formbuilder.name_required'),
                'form_type.required' => __('formbuilder.form_type_required')
            ]);
            if ($validator->passes()) {
                $form = new form();
                $form->name = $request->name;
                $form->title = $request->title;
                $form->to = $request->to;
                $form->from = $request->from;
                $form->subject = $request->subject;
                $form->file_attachment = $request->file_attachment;
                $form->additional_headers = $request->additional_headers;
                $form->message_body = $request->message_body;
                $form->status = 1;
                $form->add_user = Auth::id();
                $form_type = $request->form_type;
                $form->form_type = $form_type;
                if ($form_type == 1) {
                    $form->form_url = $request->form_url;
                } elseif ($form_type == 2) {
                    $form->form_title = $request->form_title;
                    $form->form_desc = $request->form_desc;
                }

                $form->save();


                for ($i = 1; $i <= $request->countform; $i++) {
                    $active = "active" . $i;
                    $order = "order_input" . $i;
                    $placeholder = "placeholder" . $i;
                    $type_name = "type_name" . $i;
                    $name_input = "name_input" . $i;
                    $required = "required" . $i;
                    $default_value = "default_value" . $i;
                    $placeholder_use = "placeholder_use" . $i;
                    $id_attr = "id_attr" . $i;
                    $class_attr = "class_attr" . $i;


                    if (empty($request->$active)) {
                        $active = 2;
                    } else {
                        $active = 1;
                    }
                    if (empty($request->$required)) {
                        $required = 2;
                    } else {
                        $required = 1;
                    }

                    if (empty($request->$placeholder_use)) {
                        $placeholder_use = 2;
                    } else {
                        $placeholder_use = 1;
                    }


                    if (!empty($request->$type_name)) {

                        $form_input = new form_input();
                        $form_input->name = $request->$name_input;
                        $form_input->required = $required;
                        $form_input->placeholder_use = $placeholder_use;
                        $form_input->id_attr = $request->$id_attr;
                        $form_input->class_attr = $request->$class_attr;
                        $form_input->placeholder = $request->$placeholder;
                        $form_input->status = 1;
                        $form_input->active_passive = $active;
                        $form_input->order_input = $request->$order;
                        $form_input->input_id = $request->$type_name;
                        $form_input->form_id = $form->id;
                        $form_input->add_user = Auth::id();
                        $form_input->save();


                        $value = new form_input_value();
                        $value->form_input_id = $form_input->id;
                        $value->default_value = $request->$default_value;
                        $value->add_user = Auth::id();
                        $value->save();

                        for ($f = 0; $f <= $request->countformselectbox; $f++) {
                            $addvalue_extra = "addvalue_extra" . $i . "_" . $f;

                            if (!empty($request->$addvalue_extra)) {
                                $loop_value = new form_input_value();
                                $loop_value->form_input_id = $form_input->id;
                                $loop_value->default_value = $request->$addvalue_extra;
                                $loop_value->add_user = Auth::id();
                                $loop_value->save();
                            }
                        }


                    }


                }

                return response()->json(['type' => 'success', 'success_message_array' => array(Lang::get('global.success_message')),'route_url' => route('form-builder.index')]);
            } else {
                return response()->json(['error' => $validator->errors()->all()]);
            }
        } elseif ($request->id == "update") {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ], [
                'name.required' => __('formbuilder.name_required')
            ]);

            if ($validator->passes()) {
                $form = form::find($request->form_id);
                $form->name = $request->name;
                $form->title = $request->title;
                $form->to = $request->to;
                $form->from = $request->from;
                $form->subject = $request->subject;
                $form->file_attachment = $request->file_attachment;
                $form->additional_headers = $request->additional_headers;
                $form->message_body = $request->message_body;
                $form->status = 1;
                $form->add_user = Auth::id();
                $form_type = $request->form_type;
                $form->form_type = $form_type;
                if ($form_type == 1) {
                    $form->form_url = $request->form_url;
                    $form->save();
                } elseif ($form_type == 2) {
                    $form->form_title = $request->form_title;
                    $form->form_desc = $request->form_desc;
                    $form->save();
                }

                for ($i = 1; $i <= $request->countform; $i++) {
                    $active = "active" . $i;
                    $order = "order_input" . $i;
                    $placeholder = "placeholder" . $i;
                    $type_name = "type_name" . $i;
                    $name_input = "name_input" . $i;
                    $required = "required" . $i;
                    $default_value = "default_value" . $i;
                    $placeholder_use = "placeholder_use" . $i;
                    $id_attr = "id_attr" . $i;
                    $class_attr = "class_attr" . $i;


                    if (empty($request->$active)) {
                        $active = 2;
                    } else {
                        $active = 1;
                    }
                    if (empty($request->$required)) {
                        $required = 2;
                    } else {
                        $required = 1;
                    }

                    if (empty($request->$placeholder_use)) {
                        $placeholder_use = 2;
                    } else {
                        $placeholder_use = 1;
                    }


                    if (!empty($request->$type_name)) {

                        $form_input = new form_input();
                        $form_input->name = $request->$name_input;
                        $form_input->required = $required;
                        $form_input->placeholder_use = $placeholder_use;
                        $form_input->id_attr = $request->$id_attr;
                        $form_input->class_attr = $request->$class_attr;
                        $form_input->placeholder = $request->$placeholder;
                        $form_input->status = 1;
                        $form_input->active_passive = $active;
                        $form_input->order_input = $request->$order;
                        $form_input->input_id = $request->$type_name;
                        $form_input->form_id = $form->id;
                        $form_input->add_user = Auth::id();
                        $form_input->save();


                        $value = new form_input_value();
                        $value->form_input_id = $form_input->id;
                        $value->default_value = $request->$default_value;
                        $value->add_user = Auth::id();
                        $value->save();

                        for ($f = 0; $f <= $request->countformselectbox; $f++) {
                            $addvalue_extra = "addvalue_extra" . $i . "_" . $f;

                            if (!empty($request->$addvalue_extra)) {
                                $loop_value = new form_input_value();
                                $loop_value->form_input_id = $form_input->id;
                                $loop_value->default_value = $request->$addvalue_extra;
                                $loop_value->add_user = Auth::id();
                                $loop_value->save();
                            }
                        }


                    }


                }

                $form_input = form_input::where('status', 1)->where('form_id', $form->id)->get();
                foreach ($form_input as $fi) {
                    $active = "active_edit" . $fi->id;
                    $order = "order_input_id" . $fi->id;
                    $placeholder = "placeholder_edit" . $fi->id;
                    $type_name = "type_name_edit" . $fi->id;
                    $name_input = "name_input_edit" . $fi->id;
                    $required = "required_edit" . $fi->id;
                    $placeholder_use = "placeholder_use_edit" . $fi->id;
                    $id_attr = "id_attr_edit" . $fi->id;
                    $class_attr = "class_attr_edit" . $fi->id;


                    if (empty($request->$active)) {
                        $active = 2;
                    } else {
                        $active = 1;
                    }
                    if (empty($request->$required)) {
                        $required = 2;
                    } else {
                        $required = 1;
                    }

                    if (empty($request->$placeholder_use)) {
                        $placeholder_use = 2;
                    } else {
                        $placeholder_use = 1;
                    }

                    if (!empty($request->$type_name)) {

                        $form_input = form_input::find($fi->id);
                        $form_input->name = $request->$name_input;
                        $form_input->required = $required;
                        $form_input->placeholder_use = $placeholder_use;
                        $form_input->id_attr = $request->$id_attr;
                        $form_input->class_attr = $request->$class_attr;
                        $form_input->placeholder = $request->$placeholder;
                        $form_input->status = 1;
                        $form_input->active_passive = $active;
                        $form_input->order_input = $request->$order;
                        $form_input->input_id = $request->$type_name;
                        $form_input->form_id = $form->id;
                        $form_input->update_user = Auth::id();
                        $form_input->save();
                    }

                    $value = form_input_value::where('form_input_id', $fi->id)->get();

                    foreach ($value as $v) {
                        $value_foreach = "default_value_edit" . $fi->id . "_" . $v->id;
                        $form_value = form_input_value::find($v->id);
                        $form_value->default_value = $request->$value_foreach;
                        $form_value->update_user = Auth::id();
                        $form_value->save();
                    }

                    for ($f = 0; $f <= $request->countformselectbox; $f++) {
                        $addvalue_extra = "addvalue_extra" . $fi->id . "_" . $f;
                        if (!empty($request->$addvalue_extra)) {
                            $form_value_extra = new form_input_value();
                            $form_value_extra->form_input_id = $form_input->id;
                            $form_value_extra->default_value = $request->$addvalue_extra;
                            $form_value_extra->add_user = Auth::id();
                            $form_value_extra->save();
                        }

                    }


                }

                return response()->json(['type' => 'success', 'success_message_array' => array(Lang::get('global.success_message'))]);
            } else {
                return response()->json(['error' => $validator->errors()->all()]);
            }
        } elseif ($request->id == "delete") {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
            ]);

            if ($validator->passes()) {
                $form_input = form_input::find($request->data);
                $form_input->status = 2;
                $form_input->save();

                return response()->json(['type' => "success"]);
            } else {
                return response()->json(['error' => $validator->errors()->all()]);
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
        if (empty(form::find($id))) {
            return view('Kpanel.404');
        }
        return view('Kpanel.formbuilder.edit')->with('form', form::find($id))->with('input_type1', input_type::where('status', 1)->where('loop', 1)->get())->with('input_type0', input_type::where('status', 1)->where('loop', 0)->get());
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $form = form::where('id', $id)->first();
        if (!empty($form)) {
            $content = Contents::where('form_id',$id)->get();
            foreach($content as $c){
                $c->form_id = null;
                $c->save();
            }

            $form_input = $form->form_input;
            $form_send = $form->form_send;

            foreach($form_input as $f){
                $form_input_value_many = $f->form_input_value_many();
                foreach($form_input_value_many as $many){
                    $many->delete();
                }
                $f->delete();
            }
            if(!empty($form_send)){
                foreach($form_send as $s){
                    $s->form_id = null;
                    $s->form_input_id = null;
                    $s->save();
                }
            }

            $form->delete();
            $forms = new form();
            $forms_all = $forms->getTableReview();
            return response()->json(['type' => 'success', 'tableRefresh' => 1, 'listData' => $forms_all, 'success_message_array' => array(Lang::get('global.success_message'))]);

        } else {
            return response()->json(['type' => 'error', 'error_message_array' => array(Lang::get('global.error_message'))]);

        }

    }

    public function input_type_list()
    {

        $list = input_type::where('status', 1)->get();
        $option = null;
        foreach ($list as $l) {
            if ($l->id) {
                $option .= "<option  value='" . $l->id . "'>" . $l->name . "</option>";

            } else {
                $option .= "<option value='" . $l->id . "'>" . $l->name . "</option>";
            }

        }
        return response()->json(['option' => $option]);
    }

    public function selectboxloop(Request $request)
    {
        $loop = input_type::where('id', $request->id)->first();
        return response()->json(['loop' => $loop->loop]);
    }
}
