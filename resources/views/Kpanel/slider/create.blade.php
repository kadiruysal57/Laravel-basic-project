@extends('Kpanel.layouts.app')


@section('page-title') Slider @endsection <!-- Sayfa title'ı ayarlanıyor -->

@section('CssContent')
    <link href="{{asset('panel/assets/css/slider/slider.css')}}" rel="stylesheet" type="text/css" />
@endsection


@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <header class="card-header">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('slider.index')}}"><i class="fa fa-file-o"></i>{{__('slider.slider_page_title')}}</a></li>
                            <li class="breadcrumb-item active"><i class="fa fa-edit"></i> {{__('slider.slider_create_title')}}</li>
                        </ol>

                    </header>
                    <div class="card-body">
                        <form id="slider_create" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{route('slider.store')}}">
                            <input type="hidden" name="id" value="create">
                            <div class="form-group">
                                <label class="require">{{__('global.name')}}</label>
                                <input class="form-control " name="name" required type="text">
                            </div>
                            <div class="form-group">
                                <label class="require">{{__('global.title')}}</label>
                                <input class="form-control " name="title" required type="text">
                            </div>
                            <div class="form-group">
                                <label class="require">{{__('global.description')}}</label>
                                <input class="form-control " name="description" required type="text">
                            </div>
                            <div class="form-group">
                                <label class="require">{{__('global.status')}}</label>
                                <select name="status" class="form-control" tabindex="-98">
                                    <option>Lütfen Durum Seçiniz</option>
                                    <option value="1">Aktif</option>
                                    <option value="2">Pasif</option>
                                </select>
                            </div>

                            <input id="HiddenSlider" name="count" type="hidden" value="0"/>
                            <div class="fv-row mb-7 fv-plugins-icon-container text-center">
                                <input type="button" id="sliderbutton"  class="btn btn-warning m-lg-2 sliderbutton" value="{{__('slider.add_slider_image')}}">
                            </div>

                            <div id="slider_feedback">

                            </div>


                            <div class="text-center">
                                <button type="submit" class="btn btn-w-md btn-round btn-primary " form="slider_create">{{__('global.save')}}</button>
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
    <script src="{{asset('panel/assets/js/slider/slider.js')}}"></script>
    <script src="{{asset('panel/assets/js/slider/slider_create.js')}}"></script>
@endsection


