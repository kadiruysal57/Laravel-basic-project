@extends('Kpanel.layouts.app')

@section('page-title') {{__('themes.themes_settings')}} @endsection
@section('CssContent')

@endsection

@section('content')

    <div class="main-content">
        <div class="col-12">
            <div class="card">
                <header class="card-header">
                    <h4 class="card-title">{{__('themes.themes_settings')}}</strong></h4>
                </header>
                <div class="card-body">
                    <form id="themes_edit" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                          action="{{route('themes.store')}}">
                        <input type="hidden" name="id" value="update">
                        <input type="hidden" name="themes_id" value="{{$themes_customize->id}}">
                        <div class="form-group">
                            <label for="themes">{{__('themes.themes')}}</label>
                            <select class="form-control" name="themes" id="themes">
                                <option value="">{{__('global.please_select')}}</option>
                                @foreach($themes as $t)
                                    <option @if($themes_customize->themes_id == $t->id) selected=""
                                            @endif value="{{$t->id}}">{{$t->themes_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="themes_color_id">{{__('themes.themes_color')}}</label>
                            <select class="form-control" name="themes_color_id" id="themes_color_id">
                                <option value="">{{__('global.please_select')}}</option>
                                @foreach($themes_color as $t)
                                    <option @if($themes_customize->themes_color_id == $t->id) selected=""
                                            @endif value="{{$t->id}}">{{$t->color_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-w-md btn-round btn-primary ">{{__('global.save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('JsContent')
    <script src="{{asset('panel/assets/js/themes/themes.js')}}"></script>
@endsection
