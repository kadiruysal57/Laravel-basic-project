@extends('Kpanel.layouts.app')


@section('page-title') {{__('language.language_page_title')}} @endsection <!-- Sayfa title'ı ayarlanıyor -->

@section('CssContent')
    <style>
        td {
            text-align: center;
        }
    </style>
@endsection


@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title">{{__('language.language_page_title')}}</strong></h4>
                        <div class="text-right">
                            <button class="btn btn-success btn-sm" data-toggle="modal"
                                    data-target="#language-add-modal"><i
                                    class="fa fa-plus"></i></button>
                        </div>
                    </header>

                    <div class="card-body">
                        <table class="table table-separated language_table">
                            <thead>
                            <tr>
                                <th class="text-center w-100px">#</th>
                                <th class="text-center w-100px">{{__('global.name')}}</th>
                                <th class="text-center w-100px">{{__('global.short_name')}}</th>
                                <th class="text-center w-100px">{{__('global.slug')}}</th>
                                <th class="text-center w-100px">{{__('language.main_language')}}</th>
                                <th class="text-center w-100px">{{__('global.actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($language as $l)

                                <tr>
                                    <th class="text-center w-100px" scope="row">{{$l->id}}</th>
                                    <td class="text-center w-100px">{{$l->name}}</td>
                                    <td class="text-center w-100px">{{$l->short_name}}</td>
                                    <td class="text-center w-100px">{{$l->slug}}</td>
                                    <td class="text-center w-100px">
                                        @if($l->main_language == 1)
                                            <button type="button"
                                                    class="btn btn-gray btn-sm ">{{__('language.current_mother_language')}}</button>
                                        @else
                                            <button type="button"
                                                    class="btn btn-success btn-sm button_main_language"
                                                    data-id="{{$l->id}}"
                                                    data-action="{{route('language.store')}}">{{__('language.change_mother_language')}}</button>
                                        @endif
                                    </td>
                                    <td class="text-center table-actions">
                                        <button class="table-action hover-primary btn btn-pure updateButtonLanguage"
                                                data-id="{{$l->id}}" data-action="{{route('language.store')}}"><i
                                                class="ti-pencil"></i></button>
                                        @if($l->type != 1)
                                            <button class="table-action hover-danger btn btn-pure deleteButton" data-id="{{$l->id}}" data-action = "{{route('language.destroy',[$l->id])}}" data-table=".language_table" ><i class="ti-trash"></i></button>

                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div><!--/.main-content -->
    <div class="modal modal-center fade" id="language-add-modal" tabindex="-1" style="display: none;"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('language.language_add')}}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="card" id="language_add" action="{{route('language.store')}}">
                        <div class="card-body">
                            <input type="hidden" name="id" value="create">
                            <div class="form-group">
                                <label class="require">{{__('global.name')}}</label>
                                <input class="form-control" name="name" required type="text">
                            </div>

                            <div class="form-group">
                                <label class="require">{{__('global.short_name')}}</label>
                                <input class="form-control get_slug" focus_input=".slug_input" name="short_name"
                                       required type="text">
                            </div>
                            <div class="form-group">
                                <label>{{__('global.slug')}}</label>
                                <input class="form-control slug_input" name="slug" type="text">
                            </div>
                            <div class="form-group">
                                <label class="require">{{__('language.main_language')}}</label>
                                <select name="main_language" id="main_language" class="form-control">
                                    <option value="2" selected>{{__('global.no')}}</option>
                                    <option value="1">{{__('global.yes')}}</option>
                                </select>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-bold btn-pure btn-secondary"
                            data-dismiss="modal">{{__('global.close')}}
                    </button>
                    <button type="submit" form="language_add"
                            class="btn btn-bold btn-pure btn-primary">{{__('global.save')}}</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-center fade" id="language-edit-modal" tabindex="-1" style="display: none;"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('language.language_edit')}}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="card" id="language_update" action="{{route('language.store')}}">
                        <div class="card-body">
                            <input type="hidden" name="id" value="update">
                            <input type="hidden" class="id_input" name="id_input" value="update">
                            <div class="form-group">
                                <label class="require">{{__('global.name')}}</label>
                                <input class="form-control name_input" name="name" required type="text">
                            </div>

                            <div class="form-group">
                                <label class="require">{{__('global.short_name')}}</label>
                                <input class="form-control get_slug short_name_input" focus_input=".slug_input"
                                       name="short_name" required type="text">
                            </div>
                            <div class="form-group">
                                <label>{{__('global.slug')}}</label>
                                <input class="form-control slug_input" name="slug" type="text">
                            </div>
                            <div class="form-group">
                                <label class="require">{{__('language.main_language')}}</label>
                                <select name="main_language" id="main_language"
                                        class="form-control main_language_input">
                                    <option value="2" selected>{{__('global.no')}}</option>
                                    <option value="1">{{__('global.yes')}}</option>
                                </select>
                            </div>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-bold btn-pure btn-secondary"
                            data-dismiss="modal">{{__('global.close')}}
                    </button>
                    <button type="submit" form="language_update"
                            class="btn btn-bold btn-pure btn-primary">{{__('global.save')}}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('JsContent')

    <script
        src="{{asset('panel/assets/js/language/language.js')}}"></script>
@endsection


