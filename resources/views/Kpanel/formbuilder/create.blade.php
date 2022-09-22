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
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('form-builder.index')}}"><i class="fa fa-file-o"></i>{{__('formbuilder.formbuilder_page_title')}}</a></li>
                            <li class="breadcrumb-item active"><i class="fa fa-edit"></i> {{__('formbuilder.formbuilder_create_title')}}</li>
                        </ol>
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
                        <form id="form_create" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{route('form-builder.store')}}">
                            <input type="hidden" name="id" value="create">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="form">
                            <div class="form-group">
                                <label class="require">{{__('global.name')}}</label>
                                <input class="form-control " name="name" required type="text">
                            </div>
                            <div class="form-group">
                                <label class="require">{{__('global.title')}}</label>
                                <input class="form-control " name="title" required type="text">
                            </div>
                            <div class="form-group">
                                <label class="require">{{__('formbuilder.formbuilder_to')}}</label>
                                <input class="form-control " name="to" required type="text">
                            </div>
                            <div class="form-group">
                                <label class="require">{{__('formbuilder.formbuilder_from')}}</label>
                                <input class="form-control " name="from" required type="text">
                            </div>

                            <div class="form-group">
                                <label class="require">{{__('formbuilder.formbuilder_subject')}}</label>
                                <input class="form-control " name="subject" required type="text">
                            </div>

                            <div class="form-group">
                                <label class="require">{{__('formbuilder.formbuilder_file_attachment')}}</label>
                                <textarea class="form-control" name="file_attachment"></textarea>
                            </div>

                            <div class="form-group">
                                <label class="require">{{__('formbuilder.formbuilder_additional_headers')}}</label>
                                <textarea class="form-control" name="additional_headers"></textarea>
                            </div>

                            <div class="form-group">
                                <label class="require">{{__('formbuilder.formbuilder_message_body')}}</label>
                                <textarea class="form-control" name="message_body"></textarea>
                            </div>

                            <div class="form-group">
                                <label class="require">{{__('formbuilder.formbuilder_form_type')}}</label>
                                <select name="form_type" id="form_type" class="form-control" tabindex="-98">
                                    <option>{{__('formbuilder.formbuilder_form_type_select')}}</option>
                                    <option value="1">{{__('formbuilder.formbuilder_form_new_page')}}</option>
                                    <option value="2">{{__('formbuilder.formbuilder_form_information')}}</option>
                                </select>
                            </div>

                                    <div id="return_type">
                                        <div class="fv-row mb-7 fv-plugins-icon-container return_div" style="">
                                            <label class="fs-6 fw-bold form-label mt-3">
                                                <span >{{__('formbuilder.formbuilder_form_url')}}</span>
                                            </label>
                                            <input type="text" name="form_url" id="url-input" class="form-control form-control-solid">
                                        </div>
                                    </div>

                                    <div id="return_type2">

                                        <div class="fv-row mb-7 fv-plugins-icon-container return_div2" style="display:none;">
                                            <label class="fs-6 fw-bold form-label mt-3">
                                                <span >{{__('global.title')}}</span>
                                            </label>
                                            <input type="text" name="form_title" id="title-input" class="form-control form-control-solid">
                                        </div>

                                        <div class="fv-row mb-7 fv-plugins-icon-container return_div2" style="display:none;">
                                            <label class="fs-6 fw-bold form-label mt-3">
                                                <span >{{__('global.description')}}</span>
                                            </label>
                                            <input type="text" name="form_desc" id="desc-input" class="form-control form-control-solid">
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


                                                    </tbody>
                                                    <!--end::Table body-->
                                                </table>
                                                <div id="modelFeedback">

                                                </div>
                                                <!--end::Table-->
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>




                            <div class="text-center">
                                <button type="submit" class="btn btn-w-md btn-round btn-primary " form="form_create">{{__('global.save')}}</button>
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


