@extends('Kpanel.layouts.app')


@section('page-title') Slider @endsection <!-- Sayfa title'ı ayarlanıyor -->

@section('CssContent')
    <!-- Bu sayfaya özel css dosyaları çekilecek -->
@endsection


@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title">{{__('slider.slider_update_title')}}</strong></h4>
                    </header>
                    <div class="card-body">
                        <form id="slider_update" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                              action="{{route('slider.store')}}">

                            <input type="hidden" name="id" value="update">
                            <input type="hidden" name="slider_id" value="{{$slider->id}}">
                            <div class="form-group">
                                <label class="require">{{__('global.name')}}</label>
                                <input class="form-control " name="name" required type="text" value="{{$slider->name}}">
                            </div>
                            <div class="form-group">
                                <label class="require">{{__('global.title')}}</label>
                                <input class="form-control " name="title" required type="text" value="{{$slider->title}}">
                            </div>
                            <div class="form-group">
                                <label class="require">{{__('global.description')}}</label>
                                <input class="form-control " name="description" required type="text" value="{{$slider->description}}">
                            </div>
                            <div class="form-group">
                                <label class="require">{{__('global.status')}}</label>
                                <select name="status" class="form-control" tabindex="-98">
                                    <option>{{__('global.status')}}</option>
                                    <option @if($slider->status == 1) selected="" @endif value="1">{{__('global.active')}}</option>
                                    <option @if($slider->status == 2) selected="" @endif value="2">{{__('global.passive')}}</option>
                                </select>
                            </div>

                            <input id="HiddenSlider" name="count" type="hidden" value="0"/>
                            <div class="fv-row mb-7 fv-plugins-icon-container text-center">
                                <input type="button" id="sliderbutton"  class="btn btn-warning m-lg-2 sliderbutton" value="{{__('slider.add_slider_image')}}">
                            </div>

                            <div id="slider_feedback">

                                @foreach($slider->slider_image_many as $si)

                                    <div id="sliderimage_edit{{$si->id}}" class="mt-5 bg-light"
                                         style="border-radius:30px; padding: 10px;">

                                        <button data-src="{{$si->id}}"
                                                data-action="{{route('slider.store')}}"
                                                id="delete"
                                                class="btn btn-icon btn-active-color-primary btn-sm me-1 sliderimagedelete_edit">
                                            <a class="fa fa-trash"></a>

                                        </button>


                                        <div class="d-flex">
                                            <div class="col-4 ">
                                                <div class="input-group d-grid justify-content-center">
                                                    <div class="d-flex justify-content-center">
                                                         <span class="input-group-btn">
                                                             <a id="lfm{{$si->id}}" data-input="thumbnail{{$si->id}}" data-preview="holder{{$si->id}}"
                                                                            class="btn btn-warning lfm">
                                                             <i class="fa fa-picture-o"></i>{{__('global.please_select')}}
                                                             </a>
                                                         </span>
                                                    </div>
                                                    <input id="thumbnail{{$si->id}}" class="form-control" type="hidden" name="filepath_edit{{$si->id}}" value="http://127.0.0.1:8000/storage/photos/shares/deneme.jpg">
                                                </div>


                                                <div class=" d-flex justify-content-center align-items-center mt-5" id="holder{{$si->id}}">
                                                    <img style="max-height:130px; max-width:130px;" src="http://127.0.0.1:8000/storage/photos/shares/deneme.jpg">
                                                </div>
                                            </div>



                                            <div class="col-4" style="text-align: -webkit-center">


                                                <div class="fv-row mb-7 fv-plugins-icon-container justify-content-center">
                                                     <label class="fs-6 fw-bold form-label">
                                                         <span>{{__('global.title')}}</span>
                                                         </label>
                                                     <input type="text" class="form-control form-control w-75 p-3" value="{{$si->title}}" name="slider_title_edit{{$si->id}}">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>




                                                <div class="fv-row mb-7 fv-plugins-icon-container ">
                                                     <label class="fs-6 fw-bold form-label ">
                                                         <span>{{__('global.description')}}</span>
                                                         </label>
                                                     <input type="text" class="form-control form-control w-75 p-3" value="{{$si->description}}" name="slider_desc_edit{{$si->id}}">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>




                                                <div class="fv-row mb-7 fv-plugins-icon-container justify-content-center">
                                                     <label class="fs-6 fw-bold form-label">
                                                         <span>{{__('global.text')}}</span>
                                                         </label>
                                                     <textarea class="form-control form-control w-75 p-3"  name="slider_text_edit{{$si->id}}">{{$si->text}}</textarea>

                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>
                                            </div>




                                            <div class="col-4 last" style="text-align: -webkit-center">


                                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                                     <label class="fs-6 fw-bold form-label mt-3">
                                                         <span>{{__('slider.button_text')}}</span>
                                                         </label>
                                                     <input type="text" class="form-control form-control w-75 p-3" value="{{$si->button_text}}" name="button_text_edit{{$si->id}}">

                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>




                                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                                     <label class="fs-6 fw-bold form-label mt-3">
                                                         <span>{{__('slider.button_colour')}}</span>
                                                         </label>
                                                     <input type="text" class="form-control form-control w-75 p-3" value="{{$si->button_colour}}" name="button_colour_edit{{$si->id}}">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>

                                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                                    <label class="fs-6 fw-bold form-label mt-3">
                                                        <span>{{__('slider.order')}}</span>
                                                    </label>
                                                    <input id='order' name='order_edit{{$si->id}}' class="form-control form-control w-75 p-3" type='number' value='{{$si->order_input}}'>
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>


                            <div class="text-center mt-2">
                                <button type="submit" class="btn btn-w-md btn-round btn-primary " form="slider_update">{{__('global.save')}}</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('JsContent')
    <script>
        $('.lfm').filemanager('image');
    </script>

    <script src="{{asset('panel/assets/js/slider/slider.js')}}"></script>
    <script src="{{asset('panel/assets/js/slider/slider_create.js')}}"></script>

    <script src="{{asset('panel/assets/vendor/chartjs/Chart.min.js')}}"></script>

@endsection



