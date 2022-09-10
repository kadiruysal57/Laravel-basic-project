@extends('Kpanel.layouts.app')


@section('page-title') Contents @endsection <!-- Sayfa title'ı ayarlanıyor -->

@section('CssContent')
    <link href="{{asset('panel/assets/css/jquery.nestable.min.css')}}" rel="stylesheet">
    <style>
        .dd-deletebutton {
            padding: 5px;
            cursor: pointer;

        }

        button.dd-collapse {
            display: none;
        }

        button.dd-expand {
            display: none;
        }

        span.dd-settingbutton.btn-info.btn-hover-scale.me-5.float-right {
            padding: 5px;
            margin-right: 5px;
        }
        .dd-handetrash {
            position: absolute;
            right: 10px;
            top: 10px;
            color: red;
            cursor: pointer;
        }

        li.dd-item {
            position: relative;
        }
    </style>
@endsection


@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <header class="card-header">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('contents.index')}}"><i
                                        class="fa fa-file-o"></i>{{__('contents.contents_page_title')}}</a></li>
                            <li class="breadcrumb-item active"><i
                                    class="fa fa-edit"></i> {{__('contents.contents_update_title')}}</li>
                        </ol>
                    </header>
                    <div class="card-body">
                        <div class="d-flex ">

                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#contents-genel-info">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#contents-seo">Seo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab"
                                       href="#contents-blok">{{__('contents.blok_manager')}}</a>
                                </li>

                            </ul>

                        </div>
                        <form id="contents_update" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                              action="{{route('contents.store')}}">
                            <input type="hidden" name="id" value="update">
                            <input type="hidden" name="contents_id" value="{{$contents->id}}">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="contents-genel-info">
                                    <div class="form-group">
                                        <label class="require">{{__('global.name')}}</label>
                                        <input class="form-control " name="name" required type="text"
                                               value="{{$contents->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label class="require">{{__('global.title')}}</label>
                                        <input class="form-control " name="title" required type="text"
                                               value="{{$contents->title}}">
                                    </div>
                                    <div class="form-group">
                                        <label class="require" for="language_id">{{__('global.language')}}</label>
                                        <select name="language_id" id="language_id" class="form-control">
                                            <option value="">{{__('global.please_select')}}</option>
                                            @foreach($language as $l)
                                                <option @if($l->id == $contents->language_id) selected="" @endif value="{{$l->id}}">{{$l->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="require">{{__('global.short_desc')}}</label>
                                        <textarea name="short_desc"
                                                  class="form-control">{{$contents->short_desc}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <textarea class="ckeditor form-control" name="description">{{$contents->description}}</textarea>
                                    </div>
                                </div>
                                <div class="tab-pane fade " id="contents-seo">
                                    <div class="form-group">
                                        <label class="require">{{__('contents.seo_title')}}</label>
                                        <input class="form-control " name="seo_title" required type="text"
                                               value="{{$contents->seo_title}}">

                                    </div>
                                    <div class="form-group">
                                        <label class="require">{{__('contents.keywords')}}</label>
                                        <input class="form-control " name="keywords" required type="text"
                                               value="{{$contents->keywords}}">
                                    </div>
                                    <div class="form-group">
                                        <label class="require">{{__('contents.seo_description')}}</label>
                                        <textarea name="seo_description"
                                                  class="form-control">{{$contents->seo_description}}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="require">{{__('contents.focus_keywords')}}</label>
                                        <input class="form-control " name="focus_keywords" required type="text"
                                               value="{{$contents->focus_keywords}}">
                                    </div>

                                    <div class="form-group">
                                        <label class="require">{{__('global.slug')}}</label>
                                        <input class="form-control " name="seo_url" required type="text"
                                               value="{{$contents->seo_url}}">
                                    </div>



                                </div>

                                <div class="tab-pane fade" id="contents-blok">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="">{{__('contents.default_blok')}}</label>
                                        <select name="default_blok" class="form-control" id="default_blok">
                                            <option value="">{{__('global.special')}}</option>
                                            @foreach($default_bloks as $db)
                                                <option @if($db->id == $contents->default_blok_id) selected="" @endif value="{{$db->id}}">{{$db->default_blok_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 blok_manager_content" @if($contents->default_blok_id != 0) style="display: none" @endif>
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-sm-6 " style="border-radius: 10px;">
                                                <label for="">{{__('contents.active_bloks')}}</label>
                                                <div class="form-group">
                                                    <label class="switch switch-success col-lg-5">
                                                        <input type="checkbox" @if($contents->left_blok_active == 1) checked="" @endif class="left_blok"
                                                               name="left_blok">
                                                        <span class="switch-indicator"></span>
                                                        <span
                                                            class="switch-description">{{__('contents.left_blok')}}</span>
                                                    </label>
                                                    <label class="switch switch-success col-lg-5">
                                                        <input type="checkbox" @if($contents->right_blok_active == 1) checked="" @endif class="right_blok"
                                                               name="right_blok">
                                                        <span class="switch-indicator"></span>
                                                        <span
                                                            class="switch-description">{{__('contents.right_blok')}}</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 blok_manager_content" @if($contents->default_blok_id != 0) style="display: none" @endif>

                                        <div
                                            class="col-lg-3 col-md-3 col-sm-12 bg-lighter  border border-cyan float-left"
                                            style="min-height: 450px;">


                                            <div class="row">

                                                <div class="col-lg-12 col-md-12 col-sm-12 border-bottom border-cyan">
                                                    <label for="">{{__('contents.bloks')}}</label>
                                                    <div class="row">
                                                        <div
                                                            class="col-lg-12 col-md-12 col-sm-12 bg-white border-top border-cyan">

                                                            <ul class="nav nav-tabs"
                                                                style="border-bottom: none !important; margin-bottom: 3px">
                                                                @foreach($blok_groups as $key => $b)

                                                                    <li class="nav-item">
                                                                        <a class="nav-link @if($key == 0) active @endif "
                                                                           data-toggle="tab"
                                                                           href="#{{$b->name}}"
                                                                           style="font-size: 11px;padding: 5px;background: none !important;">{{__('contents.'.$b->name)}}</a>
                                                                    </li>
                                                                @endforeach


                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12 bg-white "
                                                     style="min-height: 450px;">
                                                    <div class="tab-content mt-3">
                                                        @foreach($blok_groups as $key => $b)

                                                            <div class="tab-pane fade @if($key == 0) active show @endif"
                                                                 id="{{$b->name}}">
                                                                <div class="dd" id="{{$b->name}}_nestable">
                                                                    <ol class="dd-list">
                                                                        @foreach($b->group_file->whereNotIn('id',array_only($contents->blok_file->where('group_id',$b->id)->toArray(),'blok_files_id')) as $bf)
                                                                            <li class="dd-item"
                                                                                data-groupid="{{$bf->group_id}}"
                                                                                data-pagefileid ="0"
                                                                                data-id="{{$bf->id}}">
                                                                                <div
                                                                                    class="dd-handle">{{__('contents.'.$bf->name)}}</div>
                                                                            </li>
                                                                        @endforeach
                                                                    </ol>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12  float-right">
                                            <div class="nestable-data d-none">
                                                <textarea class="top_blok_data" name="top_blok_data"></textarea>
                                                <textarea class="left_blok_data" name="left_blok_data"></textarea>
                                                <textarea class="mid_blok_data" name="mid_blok_data"></textarea>
                                                <textarea class="right_blok_data" name="right_blok_data"></textarea>
                                                <textarea class="footer_blok_data" name="footer_blok_data"></textarea>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="row">
                                                    <div
                                                        class="col-lg-12 col-md-12 col-sm-12 bg-lighter  border border-cyan">

                                                        <div class="row">

                                                            <div
                                                                class="col-lg-12 col-md-12 col-sm-12 border-bottom border-cyan">
                                                                <label for="">{{__('contents.top_blok')}}</label>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 bg-white"
                                                                 style="min-height: 120px;">
                                                                <div class="dd" id="top_blok_nestable">
                                                                    @if($contents->blok_file->where('main_blok_id',1)->count() > 0)
                                                                    <ol class="dd-list">
                                                                        @foreach($contents->blok_file->where('main_blok_id',1) as $tp)
                                                                            <li class="dd-item"
                                                                                data-groupid="{{$tp->group_id}}"
                                                                                data-pagefileid ="{{$tp->id}}"
                                                                                data-id="{{$tp->blok_files_id}}">
                                                                                <div
                                                                                    class="dd-handle">{{__('contents.'.$tp->file_name->name)}}
                                                                                </div>
                                                                                <div class="dd-handetrash" data-contentsid="{{$contents->id}}" data-id="{{$tp->id}}" action="{{route('contents.store')}}">
                                                                                     <i class="fa fa-trash"></i>
                                                                                </div>
                                                                            </li>
                                                                        @endforeach
                                                                    </ol>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="col-lg-3 col-md-3 col-sm-12 bg-lighter  border border-cyan mt-3">

                                                        <div class="row">
                                                            <div
                                                                class="col-lg-12 col-md-12 col-sm-12 border-bottom border-cyan">
                                                                <label for="">{{__('contents.left_blok')}}</label>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 bg-white"
                                                                 style="min-height: 215px;">

                                                                <div class="dd" id="left_blok_nestable">
                                                                    @if($contents->blok_file->where('main_blok_id',2)->count() > 0)
                                                                        <ol class="dd-list">
                                                                            @foreach($contents->blok_file->where('main_blok_id',2) as $tp)
                                                                                <li class="dd-item"
                                                                                    data-groupid="{{$tp->group_id}}"
                                                                                    data-pagefileid ="{{$tp->id}}"
                                                                                    data-id="{{$tp->blok_files_id}}">
                                                                                    <div
                                                                                        class="dd-handle">{{__('contents.'.$tp->file_name->name)}}
                                                                                    </div>
                                                                                    <div class="dd-handetrash" data-contentsid="{{$contents->id}}" data-id="{{$tp->id}}" action="{{route('contents.store')}}">
                                                                                        <i class="fa fa-trash"></i>
                                                                                    </div>
                                                                                </li>
                                                                            @endforeach
                                                                        </ol>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-lg-6 col-md-6 col-sm-12 bg-lighter  border border-cyan mt-3">
                                                        <div class="row">

                                                            <div
                                                                class="col-lg-12 col-md-12 col-sm-12 border-bottom border-cyan">
                                                                <label for="">{{__('contents.mid_blok')}}</label>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 bg-white"
                                                                 style="min-height: 215px;">

                                                                <div class="dd" id="mid_blok_fix_nestable">
                                                                        @if($contents->blok_file->where('main_blok_id',3)->count() > 0)
                                                                            <ol class="dd-list">
                                                                                @foreach($contents->blok_file->where('main_blok_id',3) as $tp)
                                                                                    <li class="dd-item"
                                                                                        data-groupid="{{$tp->group_id}}"
                                                                                        data-pagefileid ="{{$tp->id}}"
                                                                                        data-id="{{$tp->blok_files_id}}">
                                                                                        <div
                                                                                            class="dd-handle">{{__('contents.'.$tp->file_name->name)}}
                                                                                        </div>
                                                                                        <div class="dd-handetrash" data-contentsid="{{$contents->id}}" data-id="{{$tp->id}}" action="{{route('contents.store')}}">
                                                                                            <i class="fa fa-trash"></i>
                                                                                        </div>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ol>
                                                                        @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="col-lg-3 col-md-3 col-sm-12 bg-lighter  border border-cyan mt-3">
                                                        <div class="row">

                                                            <div
                                                                class="col-lg-12 col-md-12 col-sm-12 border-bottom border-cyan">
                                                                <label for="">{{__('contents.right_blok')}}</label>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 bg-white"
                                                                 style="min-height: 215px;">
                                                                <div class="dd" id="right_blok_nestable">
                                                                        @if($contents->blok_file->where('main_blok_id',4)->count() > 0)

                                                                            <ol class="dd-list">
                                                                                @foreach($contents->blok_file->where('main_blok_id',4) as $tp)
                                                                                    <li class="dd-item"
                                                                                        data-groupid="{{$tp->group_id}}"
                                                                                        data-pagefileid ="{{$tp->id}}"
                                                                                        data-id="{{$tp->blok_files_id}}">
                                                                                        <div
                                                                                            class="dd-handle">{{__('contents.'.$tp->file_name->name)}}
                                                                                        </div>
                                                                                        <div class="dd-handetrash" data-contentsid="{{$contents->id}}" data-id="{{$tp->id}}" action="{{route('contents.store')}}">
                                                                                            <i class="fa fa-trash"></i>
                                                                                        </div>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ol>
                                                                        @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-lg-12 col-md-12 col-sm-12 bg-lighter  border border-cyan mt-3">

                                                        <div class="row">

                                                            <div
                                                                class="col-lg-12 col-md-12 col-sm-12 border-bottom border-cyan">
                                                                <label for="">{{__('contents.footer_blok')}}</label>
                                                            </div>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 bg-white"
                                                                 style="min-height: 120px;">
                                                                <div class="dd" id="footer_blok_nestable">
                                                                        @if($contents->blok_file->where('main_blok_id',5)->count() > 0)
                                                                            <ol class="dd-list">
                                                                                @foreach($contents->blok_file->where('main_blok_id',5) as $tp)
                                                                                    <li class="dd-item"
                                                                                        data-groupid="{{$tp->group_id}}"
                                                                                        data-pagefileid ="{{$tp->id}}"
                                                                                        data-id="{{$tp->blok_files_id}}">
                                                                                        <div
                                                                                            class="dd-handle">{{__('contents.'.$tp->file_name->name)}}
                                                                                        </div>
                                                                                        <div class="dd-handetrash" data-contentsid="{{$contents->id}}" data-id="{{$tp->id}}" action="{{route('contents.store')}}">
                                                                                            <i class="fa fa-trash"></i>
                                                                                        </div>
                                                                                    </li>
                                                                                @endforeach
                                                                            </ol>
                                                                        @endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mt-3 float-left text-center">
                                    <button type="submit" class="btn btn-w-md btn-round btn-primary "
                                            form="contents_update">{{__('global.save')}}</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div><!--/.main-content -->

@endsection

@section('JsContent')

    <script src="{{asset('panel/assets/js/jquery.nestable.min.js')}}"></script>
    <script src="{{asset('panel/assets/js/contents/content.js')}}"></script>
    <script src="{{asset('panel/assets/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">
        var options = {
            filebrowserImageBrowseUrl: '/Kpanel/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/Kpanel/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/Kpanel/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/Kpanel/laravel-filemanager/upload?type=Files&_token='
        };
        var editor = CKEDITOR.replace('description', options);
    </script>
    <script>
        var updateOutput = function (e) {

            var list = e.length ? e : $(e.target),
                output = list.data('output');
            if (window.JSON) {
                output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
            } else {
                output.val('JSON browser support required for this demo.');
            }
        };
        nestableCall();
        function nestableCall(){
            @foreach($blok_groups as $key => $b)
            $('#{{$b->name}}_nestable').nestable({
                group: {{$b->id}},
                maxDepth: '1',
            });
            @endforeach




            $('#top_blok_nestable').nestable({
                group: 1,
                maxDepth: '1',
            });
            $('#right_blok_nestable').nestable({
                group: 2,
                maxDepth: '1',
            });
            $('#left_blok_nestable').nestable({
                group: 2,
                maxDepth: '1',
            });
            $('#mid_blok_fix_nestable').nestable({
                group: 3,
                maxDepth: '1',
            });
            $('#footer_blok_nestable').nestable({
                group: 1,
                maxDepth: '1',
            });
        }
    </script>
@endsection



