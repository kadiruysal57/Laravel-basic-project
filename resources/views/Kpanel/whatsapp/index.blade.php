@extends('Kpanel.layouts.app')

@section('page-title') {{__('themes.themes_settings')}} @endsection
@section('CssContent')

@endsection

@section('content')

    <div class="main-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12  float-left">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title">{{__('title.whatsapp')}}</strong></h4>
                    </header>

                    <form id="whatsapp_form" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                          action="{{route('whatsapp.store')}}">
                        <div class="card-body">
                            <div class="col-lg-1 col-md-3 col-sm-12 float-left">
                                <div class="row">

                                    <div class="nav-tabs-left">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-tabs-success float-left">
                                            @foreach($language as $key => $l)
                                                <li class="nav-item">
                                                    <a class="nav-link @if($key == 0) active @endif" data-toggle="tab"
                                                       href="#language-id-{{$l->id}}">{{$l->name}}</a>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-11 col-md-11 col-sm-12  float-left">
                                <div class="tab-content col-lg-12  float-left">
                                    @foreach($language as $key => $l)
                                        <div class="tab-pane fade @if($key == 0) active show @endif "
                                             id="language-id-{{$l->id}}">
                                            @foreach($l->whatsapp_icon as $whatsapp_icon)
                                                <div class="col-lg-12 col-md-12 col-sm-12 p-0">
                                                    <div class="col-lg-12 text-center">
                                                        <div id="whatsapp_icon{{$l->id}}" class="image-content">
                                                            <img src="{{asset($whatsapp_icon->image)}}" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label
                                                            for="whatsapp_icon{{$l->id}}">{{__('whatsapp.image')}}</label>

                                                        <div class="input-group">
                                                                                       <span class="input-group-btn">
                                                                                         <a id="whatsapp_icon{{$l->id}}"
                                                                                            data-input="whatsapp_icon_input{{$l->id}}"
                                                                                            data-preview="whatsapp_icon{{$l->id}}"
                                                                                            class="btn btn-primary lfm">
                                                                                           <i class="fa fa-picture-o"></i> Choose
                                                                                         </a>
                                                                                       </span>
                                                            <input id="whatsapp_icon_input{{$l->id}}"
                                                                   value="{{$whatsapp_icon->image}}"
                                                                   class="form-control" type="text"
                                                                   name="whatsapp_icon_input{{$l->id}}"
                                                                   readonly="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label
                                                        for="phone{{$l->id}}">{{__('whatsapp.phone')}}</label>
                                                    <input type="text" class="form-control"
                                                           name="phone{{$l->id}}" id="phone{{$l->id}}"
                                                           value="{{$whatsapp_icon->phone}}">
                                                </div>
                                                <div class="form-group">
                                                    <label
                                                        for="wp_text{{$l->id}}">{{__('whatsapp.text')}}</label>
                                                    <input type="text" class="form-control"
                                                           name="wp_text{{$l->id}}" id="wp_text{{$l->id}}"
                                                           value="{{$whatsapp_icon->wp_text}}">
                                                </div>
                                                <div class="form-group">
                                                    <label
                                                        for="default_text{{$l->id}}">{{__('whatsapp.default_text')}}</label>
                                                    <input type="text" class="form-control"
                                                           name="default_text{{$l->id}}"
                                                           id="default_text{{$l->id}}"
                                                           value="{{$whatsapp_icon->default_text}}">
                                                </div>
                                                <div class="form-group">
                                                    <label
                                                        for="button_position{{$l->id}}">{{__('whatsapp.button_position')}}</label>
                                                    <select name="button_position{{$l->id}}"
                                                            class="form-control" id="button_position{{$l->id}}">
                                                        <option
                                                            @if($whatsapp_icon->button_position == 1) selected=""
                                                            @endif value="1">{{__('whatsapp.left_mid')}}</option>
                                                        <option
                                                            @if($whatsapp_icon->button_position == 2) selected=""
                                                            @endif  value="2">{{__('whatsapp.left_bottom')}}</option>
                                                        <option
                                                            @if($whatsapp_icon->button_position == 3) selected=""
                                                            @endif  value="3">{{__('whatsapp.right_mid')}}</option>
                                                        <option
                                                            @if($whatsapp_icon->button_position == 4) selected=""
                                                            @endif  value="4">{{__('whatsapp.right_bottom')}}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label
                                                        for="status{{$l->id}}">{{__('whatsapp.status')}}</label>
                                                    <select name="status{{$l->id}}" class="form-control"
                                                            id="status{{$l->id}}">
                                                        <option @if($whatsapp_icon->status == 1) selected=""
                                                                @endif value="1">{{__('whatsapp.active')}}</option>
                                                        <option @if($whatsapp_icon->status == 2) selected=""
                                                                @endif  value="2">{{__('whatsapp.passive')}}</option>
                                                    </select>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12 col-md-12 col-sm-12 text-center  float-left">
                                <button type="submit" form="whatsapp_form"
                                        class="btn btn-w-md btn-round btn-primary ">{{__('global.save')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!--/.main-content -->

@endsection

@section('JsContent')
    <script src="{{asset('panel/assets/js/whatsapp/whatsapp.js')}}"></script>
    <script>
        $('.lfm').filemanager('image');
    </script>
@endsection
