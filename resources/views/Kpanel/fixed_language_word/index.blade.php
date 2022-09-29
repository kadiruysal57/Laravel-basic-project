@extends('Kpanel.layouts.app')

@section('page-title') {{__('title.fixed_word')}} @endsection
@section('CssContent')

@endsection

@section('content')

    <div class="main-content">
        <div class="col-12">
            <div class="card">
                <header class="card-header">
                    <h4 class="card-title">{{__('fixed_word.fixed_word')}}</strong></h4>
                </header>
                <div class="card-body">
                    <div class="col-lg-12 col-md-12 col-sm-12 text-right">
                        <button type="button" class="btn btn-success btn-sm add_word"
                                data-table="#fixed_word_table"
                                data-action="{{route('fixed-word.store')}}"><i class="fa fa-plus"></i></button>
                    </div>
                    <form id="fixed_language_edit" data-table="#fixed_word_table"
                          class="form fv-plugins-bootstrap5 fv-plugins-framework"
                          action="{{route('fixed-word.store')}}">
                        <input type="hidden" name="id" value="update">
                        <input type="hidden" name="count" class="count" value="1">
                        <div class="table-responsive">
                            <table class="table table-separated" id="fixed_word_table">
                                <thead>
                                <th>{{__('fixed_word.code_name')}}</th>
                                <th>{{__('fixed_word.word')}}</th>
                                <th>{{__('fixed_word.language')}}</th>
                                <th>{{__('global.actions')}}</th>
                                </thead>
                                <tbody>
                                @foreach($word as $w)
                                    @php
                                        $readonly = null;
                                        if($w->lock == 1){
                                            $readonly = "readonly=''";
                                        }
                                    @endphp
                                    <tr>
                                        <td>
                                            <input type='text' class='form-control' name='code_names{{$w->id}}'
                                                   value='{{$w->code_name}}' {{$readonly}}
                                                   placeholder='{{__('fixed_word.code_name')}}'>
                                        </td>
                                        <td>
                                            <input type='text' class='form-control' name='fixed_words{{$w->id}}'
                                                   value='{{$w->word}}'
                                                   placeholder='{{__('fixed_word.word')}}'>
                                        </td>
                                        <td>
                                            <select name='languages_s{{$w->id}}' class='form-control' {{$readonly}}>
                                                @foreach($languages as $l)
                                                    <option @if($l->id == $w->lang_id) selected=""
                                                            @endif value="{{$l->id}}">{{$l->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            @if($w->lock == 2)
                                                <button type='button' class='btn btn-danger btn-sm deleteButton mt-2'
                                                        data-id='{{$w->id}}'
                                                        data-action='{{route('fixed-word.destroy',[$w->id])}}'
                                                        data-table='#fixed_word_table'><i class='fa fa-trash'></i>
                                                </button>
                                            @endif

                                            <button type='submit' class='btn btn-primary btn-sm mt-2'><i
                                                    class='fa fa-save'></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('JsContent')
    <script src="{{asset('panel/assets/js/fixed_language_word/fixed_language_word.js')}}"></script>
@endsection
