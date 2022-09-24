@extends('Kpanel.layouts.app')


@section('page-title') Form @endsection <!-- Sayfa title'ı ayarlanıyor -->

@section('CssContent')

@endsection


@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title">{{__('formbuilder.formbuilder_edit_title')}}</strong></h4>

                    </header>
                    <div class="card-body">
                        <div class="d-flex ">

                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#form">{{__('formbuilder.formbuilder_page_title')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#form-input">{{__('formbuilder.formbuilder_form_input')}}</a>
                                </li>
                            </ul>

                        </div>
                        <form id="form_edit" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{route('form-builder.store')}}">
                            <input type="hidden" name="id" value="update">
                            <input type="hidden" name="form_id" value="{{$form->id}}">
                                <div class="tab-content">
                                <div class="tab-pane fade active show" id="form">
                                    <div class="form-group">
                                        <label class="require">{{__('global.name')}}</label>
                                        <input class="form-control " name="name" required type="text" value="{{$form->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label class="require">{{__('global.title')}}</label>
                                        <input class="form-control " name="title" required type="text" value="{{$form->title}}">
                                    </div>
                                    <div class="form-group">
                                        <label class="require">{{__('formbuilder.formbuilder_to')}}</label>
                                        <input class="form-control " name="to" required type="text" value="{{$form->to}}">
                                    </div>
                                    <div class="form-group">
                                        <label class="require">{{__('formbuilder.formbuilder_from')}}</label>
                                        <input class="form-control " name="from" required type="text" value="{{$form->from}}">
                                    </div>

                                    <div class="form-group">
                                        <label class="require">{{__('formbuilder.formbuilder_subject')}}</label>
                                        <input class="form-control " name="subject" required type="text" value="{{$form->subject}}">
                                    </div>

                                    <div class="form-group">
                                        <label class="require">{{__('formbuilder.formbuilder_file_attachment')}}</label>
                                        <textarea class="form-control" name="file_attachment">{{$form->file_attachment}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="require">{{__('formbuilder.formbuilder_additional_headers')}}</label>
                                        <textarea class="form-control" name="additional_headers">{{$form->additional_headers}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="require">{{__('formbuilder.formbuilder_message_body')}}</label>
                                        <textarea class="form-control" name="message_body">{{$form->message_body}}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label class="require">{{__('formbuilder.formbuilder_form_type')}}</label>
                                        <select name="form_type" id="form_type" class="form-control" tabindex="-98">
                                            <option>{{__('formbuilder.formbuilder_form_type_select')}}</option>
                                            <option @if($form->form_type == 1) selected @endif value="1">{{__('formbuilder.formbuilder_form_new_page')}}</option>
                                            <option @if($form->form_type == 2) selected @endif value="2">{{__('formbuilder.formbuilder_form_information')}}</option>
                                        </select>
                                    </div>


                                    <div id="return_type">
                                        <div class="fv-row mb-7 fv-plugins-icon-container return_div" @if($form->form_type == 2) style="display:none;" @endif>
                                            <label class="fs-6 fw-bold form-label mt-3">
                                                <span >{{__('formbuilder.formbuilder_form_url')}}</span>
                                            </label>
                                            <input type="text" name="form_url" id="url-input" value="{{$form->form_url}}" class="form-control form-control-solid">
                                        </div>
                                    </div>

                                    <div id="return_type2">

                                        <div class="fv-row mb-7 fv-plugins-icon-container return_div2" @if($form->form_type == 1) style="display:none;" @endif>
                                            <label class="fs-6 fw-bold form-label mt-3">
                                                <span >{{__('global.title')}}</span>
                                            </label>
                                            <input type="text" name="form_title" id="title-input" value="{{$form->form_title}}" class="form-control form-control-solid">
                                        </div>

                                        <div class="fv-row mb-7 fv-plugins-icon-container return_div2" @if($form->form_type == 1) style="display:none;" @endif>
                                            <label class="fs-6 fw-bold form-label mt-3">
                                                <span >{{__('global.description')}}</span>
                                            </label>
                                            <input type="text" name="form_desc" id="desc-input" value="{{$form->form_desc}}" class="form-control form-control-solid">
                                        </div>
                                    </div>

                                </div>





                                <div class="tab-pane fade " id="form-input">
                                    <input id="form-input-count" name="countform" type="hidden" value="0"/>
                                    <input id="selectbox-count" name="countformselectbox" type="hidden" value="0"/>

                                    <div class="card-body">
                                        <div class="text-center">
                                            <input type="button" id="formbutton"  class="btn btn-warning m-lg-2 formbutton" value="İnput Ekle">
                                        </div>
                                        <div class="">
                                            <div class="table-responsive w-100">
                                                <!--begin::Table-->
                                                <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                    <tr class="fw-bolder text-muted">
                                                        <th class="min-w-50px">{{__('formbuilder.formbuilder_active_passive')}}</th>
                                                        <th class="min-w-150px">{{__('formbuilder.formbuilder_input_type')}}</th>
                                                        <th class="min-w-150px">{{__('formbuilder.formbuilder_placeholder')}}</th>
                                                        <th class="min-w-150px">{{__('formbuilder.formbuilder_settings')}}</th>
                                                    </tr>
                                                    </thead>
                                                    <!--end::Table head-->
                                                    <!--begin::Table body-->
                                                    <tbody id="form_feedback">

                                                    @foreach($form->form_input as $fi)
                                                        <tr id='formbody_edit{{$fi->id}}' class='a'>
                                                            <td>
                                                                <div class="form-check form-switch form-check-custom form-check-solid">
                                                                    <label class="switch">
                                                                                        <input type="checkbox" name='active_edit{{$fi->id}}' value='1'  @if($fi->active_passive == 1) checked="" @endif >
                                                                                        <span class="switch-indicator"></span>
                                                                    </label>
                                                                    <label class="form-check-label" for="flexSwitchDefault">
                                                                        </label>
                                                                </div>
                                                            </td>
                                            <td><select name='type_name_edit{{$fi->id}}' id='select_type{{$fi->id}}' class='form-control form-control-solid formbody' data-value='{{$fi->id}}'> <option value=''>{{__('formbuilder.formbuilder_select_type')}}</option>
                                                    @if($fi->input_type->loop == 1)
                                                        @foreach($input_type1 as $it)
                                                            <option @if($fi->input_id == $it->id) selected="" @endif value="{{$it->id}}">{{$it->name}}</option>
                                                        @endforeach
                                                    @endif
                                                    @if($fi->input_type->loop == 0)
                                                        @foreach($input_type0 as $it)
                                                            <option @if($fi->input_id == $it->id) selected="" @endif value="{{$it->id}}">{{$it->name}}</option>
                                                        @endforeach
                                                    @endif
                                                    </select>
                                                </td>
                                            <td><input type="text" class="form-control form-control-solid" value="{{$fi->placeholder}}" name='placeholder_edit{{$fi->id}}'></td>
                                            <td><button type='button' id='modal' data-src='{{$fi->id}}' data-toggle='modal' data-target='#exampleModal_edit{{$fi->id}}' class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 formsettings">
                                                <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor"></path>
                                                <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor"></path>
                                                </svg>
                                                </span>
                                                </button>
                                                <button type='button' data-src='{{$fi->id}}' data-action="{{route('form-builder.store')}}"  id="delete"  class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 formdeleteedit">
                                                <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"></path>
                                                <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"></path>
                                                <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"></path>
                                                </svg>
                                                </span>
                                                </button>
                                                <input id='order' name='order_edit{{$fi->id}}' type='hidden' value=''>
                                                </td>
                                            </tr>
                                                    @endforeach

                                                    </tbody>
                                                    <!--end::Table body-->
                                                </table>
                                                <div id="modelFeedback">
                                                    @foreach($form->form_input as $fi)

                                                        <div id='exampleModal_edit{{$fi->id}}' class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">{{__('formbuilder.formbuilder_input_type')}}</h4>
                                                                    </div>
                                                                <div class="modal-body">
                                                                    <div class="form-check form-check-custom form-check-solid">
                                                                    <label class="fs-6 fw-bold form-label mt-3">
                                                                    <span class="required">{{__('formbuilder.formbuilder_required')}}</span>
                                                                    </label>
                                                                    <label class="switch m-3">
                                                                    <input name='required_edit{{$fi->id}}' class="form-check-input m-3" type="checkbox" @if($fi->required ==1) checked @endif value="1" id="flexCheckDefault"/>
                                                                    <span class="switch-indicator"></span>
                                                                    </label>
                                                                    </div>
                                                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                                                    <label class="fs-6 fw-bold form-label mt-3">
                                                                    <span class="required">{{__('global.name')}}</span>
                                                                    </label>
                                                                    <input type="text" name='name_input_edit{{$fi->id}}' id="task-textare" value="{{$fi->name}}" class="form-control form-control-solid">
                                                                </div>
                                                                                    <div id='' class="fv-row mb-7 fv-plugins-icon-container">
                                                                                    <label class="fs-6 fw-bold form-label mt-3">
                                                                                    <span class="required">{{__('formbuilder.formbuilder_default')}}</span>
                                                                                    </label>
                                                                                        @if($fi->input_type->loop == 1)
                                                                                    <input type="button" id='addvalue_edit{{$fi->id}}'  class="btn btn-warning m-lg-2  addvaluebutton_edit" data-value='{{$fi->id}}' value="{{__('formbuilder.formbuilder_add_value')}}" >
                                                                                    <div id='addvalues_edit{{$fi->id}}'></div>
                                                                                        @endif
                                                                                        <div class='mt-3'>

                                                                                            @foreach($fi->form_input_value_many as $val)
                                                                                            <input type="text" name='default_value_edit{{$fi->id}}_{{$val->id}}' value="{{$val->default_value}}" id="task-textare" class="form-control mt-3 form-control-solid value_mask{{$fi->id}}">
                                                                                            @endforeach
                                                                                        </div>
                                                                                    </div>
                                                                                <div class="form-check form-check-custom form-check-solid">
                                                                                    <label class="fs-6 fw-bold form-label mt-3">
                                                                                        <span class="required">{{__('formbuilder.placeholder_use')}}</span>
                                                                                    </label>
                                                                                       <label class="switch m-3">
                                                                                       <input name='placeholder_use_edit{{$fi->id}}' @if($fi->placeholder_use == 1) checked @endif  class="form-check-input m-3" type="checkbox" value="1" id="flexCheckDefault"/>
                                                                                       <span class="switch-indicator"></span>
                                                                                    </label>
                                                                                </div>
                                                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                                                            <label class="fs-6 fw-bold form-label mt-3">
                                                                                <span class="required">{{__('formbuilder.id_area')}}</span>
                                                                            </label>
                                                                            <input type="text" name='id_attr_edit{{$fi->id}}' value="{{$fi->id_attr}}" id="task-textare" class="form-control form-control-solid">
                                                                        </div>
                                                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                                                        <label class="fs-6 fw-bold form-label mt-3">
                                                                            <span class="required">{{__('formbuilder.class_area')}}</span>
                                                                        </label>
                                                                        <input type="text" name='class_attr_edit{{$fi->id}} value="{{$fi->class_attr}}"' id="task-textare" class="form-control form-control-solid">
                                                                    </div>
                                                            </div>
                                                    </div>
                                                             </div>


                                                        </div>
                                                    @endforeach
                                                </div>
                                                <!--end::Table-->
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-w-md btn-round btn-primary " form="form_edit">{{__('global.save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.main-content -->

@endsection

@section('JsContent')
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#form_feedback" ).sortable({
                axis: 'y',
                update : function(event ,ui){
                    $("#form_feedback tr").each(function(index){
                        $(this).find("#order").val(index+1);
                    })
                    var data = $(this).sortable('serialize');
                }
            });
        } );
    </script>
    <script src="{{asset('panel/assets/vendor/chartjs/Chart.min.js')}}"></script>
    <script src="{{asset('panel/assets/js/formbuilder/formbuilder.js')}}"></script>
    <script src="{{asset('panel/assets/js/formbuilder/formbuildercreate.js')}}"></script>
@endsection


