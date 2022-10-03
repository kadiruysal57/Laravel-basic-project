@extends('Kpanel.layouts.app')


@section('page-title') {{__('services.services_page_title')}} @endsection <!-- Sayfa title'ı ayarlanıyor -->

@section('CssContent')
    <link href="{{asset('panel/assets/css/slider/slider.css')}}" rel="stylesheet" type="text/css" />
@endsection


@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title">{{__('services.services_create_title')}}</strong></h4>
                    </header>
                    <div class="card-body">
                        <form id="services_create" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{route('services.store')}}">
                            <input type="hidden" name="id" value="create">
                            <div class="form-group">
                                <label class="require">{{__('global.name')}}</label>
                                <input class="form-control " name="name" required type="text">
                            </div>
                            <div class="form-group">
                                <label class="require">{{__('global.description')}}</label>
                                <input class="form-control " name="description" required type="text">
                            </div>
                            <div class="form-group">
                                <label class="require">{{__('global.status')}}</label>
                                <select name="status" class="form-control" tabindex="-98">
                                    <option>{{__('global.select_status')}}</option>
                                    <option value="1">{{__('global.active')}}</option>
                                    <option value="2">{{__('global.passive')}}</option>
                                </select>
                            </div>

                            <input id="Hiddenservices" name="count" type="hidden" value="0"/>
                            <div class="fv-row mb-7 fv-plugins-icon-container text-center">
                                <input type="button" id="servicesbutton"  class="btn btn-primary m-lg-2 servicesbutton" value="{{__('services.services_create_title')}}">
                            </div>

                            <div id="services_feedback">

                            </div>


                            <div class="text-center">
                                <button type="submit" class="btn btn-w-md btn-round btn-primary " form="services_create">{{__('global.save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.main-content -->

@endsection

@section('JsContent')

    <script src="{{asset('panel/assets/vendor/chartjs/Chart.min.js')}}"></script>
    <script src="{{asset('panel/assets/js/services/services.js')}}"></script>
    <script src="{{asset('panel/assets/js/services/services_create.js')}}"></script>

@endsection


