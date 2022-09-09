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
                                                                    <li class="dd-item"
                                                                        data-groupid="{{$bf->group_id}}"
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
@endsection

@section('JsContent')
    <script src="{{asset('panel/assets/js/defaultblok/defaultblok.js')}}"></script>
    <script src="{{asset('panel/assets/js/jquery.nestable.min.js')}}"></script>


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
    </script>
@endsection

