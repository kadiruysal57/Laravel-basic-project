@extends('Kpanel.layouts.app')


@section('page-title') {{__('services.services_page_title')}} @endsection <!-- Sayfa title'ı ayarlanıyor -->

@section('CssContent')
    <!-- Bu sayfaya özel css dosyaları çekilecek -->
@endsection


@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title">{{__('services.services_update_title')}}</strong></h4>
                    </header>
                    <div class="card-body">
                        <form id="services_update" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                              action="{{route('services.store')}}">

                            <input type="hidden" name="id" value="update">
                            <input type="hidden" name="services_id" value="{{$services->id}}">
                            <div class="form-group">
                                <label class="require">{{__('global.name')}}</label>
                                <input class="form-control " name="name"  type="text" value="{{$services->name}}">
                            </div>
                            <div class="form-group">
                                <label class="">{{__('global.description')}}</label>
                                <input class="form-control " name="description"  type="text" value="{{$services->description}}">
                            </div>
                            <div class="form-group">
                                <label class="require">{{__('global.status')}}</label>
                                <select name="status" class="form-control" tabindex="-98">
                                    <option>{{__('global.status')}}</option>
                                    <option @if($services->status == 1) selected="" @endif value="1">{{__('global.active')}}</option>
                                    <option @if($services->status == 2) selected="" @endif value="2">{{__('global.passive')}}</option>
                                </select>
                            </div>

                            <input id="Hiddenservices" name="count" type="hidden" value="0"/>
                            <div class="fv-row mb-7 fv-plugins-icon-container text-center">
                                <input type="button" id="servicesbutton"  class="btn btn-primary m-lg-2 servicesbutton" value="{{__('services.services_create_title')}}">
                            </div>

                            <div id="services_feedback">

                                @foreach($services->services_many as $sm)

                                    <div id="servicesimage_edit{{$sm->id}}" class="mt-5 bg-light"
                                         style="border-radius:30px; padding: 10px;">
                                        <button type="button" class="btn btn-danger mt-2 btn-sm deleteButtonServices " data-id="{{$sm->id}}" data-action = "{{route('services.store')}}" data-table="#services_table"><i class="ti-trash"></i></button>

                                        <div class="d-flex">
                                            <div class="col-6">

                                                <div style="height:210px;" class=" d-flex justify-content-center align-items-center" id="holder_edit{{$sm->id}}">
                                                    <img alt="services-image" style="max-width:200px;" src="{{$sm->url}}">
                                                </div>


                                                <div class="input-group d-grid justify-content-center">
                                                    <div class="d-flex justify-content-center">
                                                         <span class="input-group-btn">
                                                             <a  data-input="thumbnail_edit{{$sm->id}}" data-preview="holder_edit{{$sm->id}}"
                                                                 class="btn btn-primary lfm">
                                                             <i class="fa fa-picture-o"></i> {{__('global.please_select')}}
                                                             </a>
                                                         </span>
                                                    </div>
                                                    <input id="thumbnail_edit{{$sm->id}}" class="form-control" type="hidden" name="filepath_edit{{$sm->id}}" value="{{$sm->url}}">
                                                </div>

                                            </div>



                                            <div class="col-6" style="text-align: -webkit-center">


                                                <div class="fv-row mb-7 fv-plugins-icon-container justify-content-center">
                                                    <label class="fs-6 fw-bold form-label require">
                                                        <span>{{__('services.services_title')}}</span>
                                                    </label>
                                                    <input type="text" class="form-control form-control w-75 p-3" value="{{$sm->title}}" name="services_title_edit{{$sm->id}}">

                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>

                                                <div class="fv-row mb-7 fv-plugins-icon-container justify-content-center">
                                                    <label class="fs-6 fw-bold form-label">
                                                        <span>{{__('services.link')}}</span>
                                                    </label>
                                                    <input type="text" class="form-control form-control w-75 p-3" value="{{$sm->link}}" name="services_link_edit{{$sm->id}}">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>

                                                <div class="fv-row mb-7 fv-plugins-icon-container ">
                                                    <label class="fs-6 fw-bold form-label ">
                                                        <span>{{__('global.description')}}</span>
                                                    </label>
                                                    <input type="text" class="form-control form-control w-75 p-3" value="{{$sm->description}}" name="services_desc_edit{{$sm->id}}">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                                    <label class="fs-6 fw-bold form-label mt-3">
                                                        <span>{{__('services.order')}}</span>
                                                    </label>
                                                    <input id='order' name='order_edit{{$sm->id}}' class="form-control form-control w-75 p-3" type='number' value='{{$sm->list_order}}'>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>

                                                </div>

                                            </div>





                                        </div>
                                    </div>
                                @endforeach

                            </div>


                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-w-md btn-round btn-primary " form="services_update">{{__('global.save')}}</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('JsContent')


    <script src="{{asset('panel/assets/js/services/services.js')}}"></script>
    <script src="{{asset('panel/assets/js/services/services_create.js')}}"></script>
    <script>
        $('.lfm').filemanager('image');
    </script>
    <script src="{{asset('panel/assets/vendor/chartjs/Chart.min.js')}}"></script>

@endsection



