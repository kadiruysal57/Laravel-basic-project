@extends('Kpanel.layouts.app')


@section('page-title') Menu Show  @endsection <!-- Sayfa title'ı ayarlanıyor -->

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
    @php
        $nestableArray= array();
    @endphp
    <div class="main-content">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title">{{__('menu.pages')}}</strong></h4>

                    </header>
                    <div class="card-body">
                        @foreach($collapseData as $key => $collaps)
                            @php
                                array_push($nestableArray,$key);
                            @endphp
                            <div class="dd" id="nestable{{$key}}">
                                @if(count($collaps['data']) > 0)

                                    <ol class="dd-list">
                                        @foreach($collaps['data'] as $collapsdata)
                                            <li class="dd-item" data-dbtableid="" data-real_link=""
                                                data-name="{{$collapsdata->id}}" data-id="{{$menu_id}}"
                                                data-tableid="{{$collaps['type']}}">
                                                <div class="dd-handle dd3-handle"></div>
                                                <div class="dd3-content">{{$collapsdata->name}}</div>
                                            </li>
                                        @endforeach
                                    </ol>
                                @else
                                    <div class="dd-empty"></div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title">{{__('menu.custom_link')}}</strong></h4>

                    </header>
                    <div class="card-body">
                        <form id="custom-link-add" action="{{route('menu.store')}}">
                            <input type="hidden" name="id" value="custom_link_add">
                            <input type="hidden" name="menu_id" value="{{$menu_id}}">

                            <div class="form-group">
                                <label for="custom_link_name">{{__('menu.custom_link_name')}}</label>
                                <input id="custom_link_name" type="text" name="custom_link_name" required
                                       class="form-control" placeholder="{{__('menu.custom_link_name')}}">
                            </div>
                            <div class="form-group">
                                <label for="custom_link_url">{{__('menu.custom_link_url')}}</label>
                                <input id="custom_link_url" type="text" name="custom_link_url" class="form-control"
                                       placeholder="{{__('menu.custom_link_url')}}">
                            </div>
                            <div class="form-group">
                                <label for="custom_link_target">{{__('menu.custom_link_target')}}</label>
                                <select name="custom_link_target" id="custom_link_target" class="form-control" required>
                                    <option value="1">_Self</option>
                                    <option value="2">_Blank</option>
                                </select>
                            </div>
                            <div class="col-lg-12 text-center">
                                <div class="row">
                                    <button type="submit" class="form-control text-white btn btn-success">
                                        <i class="fa fa-save"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title">{{__('menu.menu_details')}}</strong></h4>
                        <button type="button" class="btn btn-success menu_item_save" data-menuid="{{$menu_id}}" data-action="{{route('menu.store')}}"><i class="fa fa-save"></i></button>
                    </header>
                    <div class="card-body">
                        <div class="dd" id="menu_nestable">
                            {!! $menus !!}
                        </div>
                    </div>
                </div>
            </div>

            <!--/.main-content -->
            <div class="modal modal-center fade" id="menu-custom-modal" tabindex="-1" style="display: none;"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{__('menu.custom_link_edit')}}</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="card" id="custom_link_edit" action="">
                                <div class="card-body">
                                    <input type="hidden" name="id" value="custom_link_edit">
                                    <input type="hidden" name="menu_id" id="menu_id" value="{{$menu_id}}">
                                    <input type="hidden" name="custom_link_id" id="custom_link_id" value="">
                                    <div class="form-group">
                                        <label for="custom_link_name_edit" class="require">{{__('menu.custom_link_name')}}</label>
                                        <input id="custom_link_name_edit" type="text" name="custom_link_name" required
                                               class="form-control" placeholder="{{__('menu.custom_link_name')}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="custom_link_url_edit" class="require">{{__('menu.custom_link_url')}}</label>
                                        <input id="custom_link_url_edit" type="text" name="custom_link_url" class="form-control"
                                               placeholder="{{__('menu.custom_link_url')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="custom_link_target_edit">{{__('menu.custom_link_target')}}</label>
                                        <select name="custom_link_target" id="custom_link_target_edit" class="form-control" required>
                                            <option value="1">_Self</option>
                                            <option value="2">_Blank</option>
                                        </select>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-bold btn-pure btn-secondary"
                                    data-dismiss="modal">{{__('global.close')}}
                            </button>
                            <button type="submit" form="custom_link_edit"
                                    class="btn btn-bold btn-pure btn-primary">{{__('global.save')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.main-content -->
    <div class="d-none">
        <textarea id="nestable-output" name="nestable-output" class="form-control"></textarea>
    </div>
@endsection

@section('JsContent')

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
        $('#menu_nestable').nestable({
            group: 1,
            maxDepth: '3', // controllerdan geliyor alt alta kaç tane menü olduğu belli etiyor
        }).on('change', updateOutput);
        updateOutput($('#menu_nestable').data('output', $('#nestable-output')));

        @foreach($nestableArray as $nes)
            $('#nestable{{$nes}}').nestable({
                group: 1,
                maxDepth: 1, // yan menüler olduğu için alt alta geçmemesi lazım
            });
        @endforeach
    </script>

    <script src="{{asset('panel/assets/js/menu/menu.js')}}"></script>
@endsection


