@extends('Kpanel.layouts.app')


@section('page-title') {{__('blokmanagement.blok_page_title')}} @endsection <!-- Sayfa title'ı ayarlanıyor -->

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
    </style>
@endsection


@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title">{{__('blokmanagement.blok_page_title_create')}}</strong></h4>


                    </header>
                    <div class="card-body">
                        <form id="default_blok_create" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                              action="{{route('blok-management.store')}}">
                            <input type="hidden" name="id" value="create">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="blok_name">{{__('blokmanagement.blok_management_name')}}</label>
                                    <input type="text" name="blok_name" class="form-control" id="blok_name"
                                           placeholder="{{__('blokmanagement.blok_management_name')}}">
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-6 " style="border-radius: 10px;">
                                        <label for="">{{__('contents.active_bloks')}}</label>
                                        <div class="form-group">
                                            <label class="switch switch-success col-lg-5">
                                                <input type="checkbox" checked="" class="left_blok"
                                                       name="left_blok">
                                                <span class="switch-indicator"></span>
                                                <span
                                                    class="switch-description">{{__('contents.left_blok')}}</span>
                                            </label>
                                            <label class="switch switch-success col-lg-5">
                                                <input type="checkbox" checked="" class="right_blok"
                                                       name="right_blok">
                                                <span class="switch-indicator"></span>
                                                <span
                                                    class="switch-description">{{__('contents.right_blok')}}</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">

                                <div
                                    class="col-lg-3 col-md-3 col-sm-12 bg-lighter  border border-cyan float-left"
                                    style="min-height: 450px;">


                                    <div class="row">

                                        <div
                                            class="col-lg-12 col-md-12 col-sm-12 border-bottom border-cyan">
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
                                                    <div
                                                        class="tab-pane fade @if($key == 0) active show @endif"
                                                        id="{{$b->name}}">
                                                        <div class="dd" id="{{$b->name}}_nestable">
                                                            <ol class="dd-list">
                                                                @foreach($b->group_file as $bf)
                                                                    <li class="dd-item html_blok{{$bf->id}}"
                                                                        data-groupid="{{$bf->group_id}}"
                                                                        data-id="{{$bf->id}}"
                                                                        data-idattr=""
                                                                        data-classattr=""
                                                                        data-html=""
                                                                        data-colorattr="">
                                                                        @if($bf->type == 2)
                                                                            <button type="button" data-id="{{$bf->id}}"
                                                                                    class="btn btn-outline-primary btn-sm html_blok_edit">
                                                                                <i class="fa fa-gears"></i>
                                                                            </button>
                                                                        @elseif($bf->type == 1)
                                                                            <button type="button" data-id="{{$bf->id}}" class="btn btn-outline-primary btn-sm blok_edit">
                                                                                <i class="fa fa-gears"></i>
                                                                            </button>
                                                                        @endif
                                                                        <div class="dd-handle" style="padding: 3px">
                                                                            {{__('contents.'.$bf->name)}}
                                                                        </div>

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
                                >{{__('global.save')}}</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div><!--/.main-content -->

    <div class="modal modal-center fade" id="html-blok-modal" tabindex="-1" style="display: none;"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('contents.html_blok')}}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="idattr form-control" name="idattr" placeholder="{{__('blokmanagement.blok_idattr')}}">
                        </div>
                        <div class="form-group">
                            <input type="text" class="classattr form-control" name="classattr" placeholder="{{__('blokmanagement.blok_classattr')}}">
                        </div>
                        <div class="form-group">
                            <input type="text" class="colorattr form-control" data-control="wheel" data-provide="colorpicker" name="colorattr" placeholder="{{__('blokmanagement.colorattr')}}">
                        </div>
                        <textarea name="html_blok_edit" id="html_blok_edit"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-bold btn-pure btn-secondary"
                            data-dismiss="modal">{{__('global.close')}}
                    </button>
                    <button type="button"
                            class="btn btn-bold btn-pure btn-primary html_blok_save">{{__('global.save')}}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal modal-center fade" id="blok-modal" tabindex="-1" style="display: none;"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('blokmanagement.blok_settings')}}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="idattr2 form-control" name="idattr" placeholder="{{__('blokmanagement.blok_idattr')}}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="classattr2 form-control" name="classattr" placeholder="{{__('blokmanagement.blok_classattr')}}">
                    </div>
                    <div class="form-group">
                        <input type="text" class="colorattr2 form-control" data-control="wheel" data-provide="colorpicker" name="colorattr" placeholder="{{__('blokmanagement.colorattr')}}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-bold btn-pure btn-secondary"
                            data-dismiss="modal">{{__('global.close')}}
                    </button>
                    <button type="button"
                            class="btn btn-bold btn-pure btn-primary blok_edit_save">{{__('global.save')}}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('JsContent')

    <script src="{{asset('panel/assets/ckeditor/ckeditor.js')}}"></script>
    <script src="{{asset('panel/assets/js/defaultblok/defaultblok.js')}}"></script>
    <script src="{{asset('panel/assets/js/jquery.nestable.min.js')}}"></script>


    <script>
        var options = {
            filebrowserImageBrowseUrl: '/Kpanel/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/Kpanel/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/Kpanel/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/Kpanel/laravel-filemanager/upload?type=Files&_token='
        };
        var editor_blok_management = CKEDITOR.replace('html_blok_edit', options);
        CKEDITOR.config.toolbar = [
            ['Styles', 'Format', 'Font', 'FontSize'],
            '/',
            ['Bold', 'Italic', 'Underline', 'StrikeThrough', '-', 'Undo', 'Redo', '-', 'Cut', 'Copy', 'Paste', 'Find', 'Replace', '-', 'Outdent', 'Indent', '-', 'Print'],
            '/',
            ['NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
            ['Image', 'Table', '-', 'Link', 'Flash', 'Smiley', 'TextColor', 'BGColor', 'Source']
        ]
        var updateOutput = function (e) {

            var list = e.length ? e : $(e.target),
                output = list.data('output');
            if (window.JSON) {
                console.log(list);
                output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
            } else {
                output.val('JSON browser support required for this demo.');
            }
        };

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
        $(document).ready(function(){
            $('.html_blok_edit').click(function () {
                Loader_toggle('show');
                $('#html-blok-modal').modal('show');
                var id = $(this).attr('data-id');

                var idattr = $('.html_blok' + id).attr('data-idattr');
                var classattr = $('.html_blok' + id).attr('data-classattr');
                var colorattr = $('.html_blok' + id).attr('data-colorattr');
                $('.idattr').val(idattr);
                $('.classattr').val(classattr);
                $('.colorattr').val(colorattr);
                var html = $('.html_blok' + id).attr('data-html');
                CKEDITOR.instances['html_blok_edit'].setData(html)
                $('.html_blok_save').attr('data-id', id);

                Loader_toggle('hide');
            });

            $('.html_blok_save').click(function () {

                Loader_toggle('show');
                var id = $(this).attr('data-id');
                var idattr = $('.idattr').val();
                var classattr = $('.classattr').val();
                var colorattr = $('.colorattr').val();
                $('.html_blok'+id).attr('data-idattr',idattr);
                $('.html_blok'+id).attr('data-classattr',classattr);
                $('.html_blok'+id).attr('data-colorattr',colorattr);
                var textareaValue = CKEDITOR.instances.html_blok_edit.getData();
                $('.html_blok' + id).attr('data-html', textareaValue);
                $('#html-blok-modal').modal('hide');
                Loader_toggle('hide');
            })


            $('.blok_edit').click(function () {
                Loader_toggle('show');
                $('#blok-modal').modal('show');
                var id = $(this).attr('data-id');
                var idattr = $('.html_blok' + id).attr('data-idattr');
                var classattr = $('.html_blok' + id).attr('data-classattr');
                var colorattr = $('.html_blok' + id).attr('data-colorattr');
                $('.idattr2').val(idattr);
                $('.classattr2').val(classattr);
                $('.colorattr2').val(colorattr);
                $('.blok_edit_save').attr('data-id', id);
                Loader_toggle('hide');
            });

            $('.blok_edit_save').click(function () {

                Loader_toggle('show');
                var id = $(this).attr('data-id');
                var idattr = $('.idattr2').val();
                var classattr = $('.classattr2').val();
                var colorattr = $('.colorattr2').val();
                $('.html_blok'+id).attr('data-idattr',idattr);
                $('.html_blok'+id).attr('data-classattr',classattr);
                $('.html_blok'+id).attr('data-colorattr',colorattr);
                $('#blok-modal').modal('hide');
                Loader_toggle('hide');
            })
        })
    </script>
@endsection


