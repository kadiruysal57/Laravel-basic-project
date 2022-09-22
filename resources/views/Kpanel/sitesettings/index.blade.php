@extends('Kpanel.layouts.app')


@section('page-title') {{__('title.sitesettings')}} @endsection <!-- Sayfa title'ı ayarlanıyor -->

@section('CssContent')
    <style>
        .image-content {
            max-width: 130px;
            height: 130px;
            text-align: center;
            margin: 0 auto;
        }

        tbody tr td {
            text-align: center;
        }
    </style>
    <link href="{{asset('panel/assets/css/select2.min.css')}}" rel="stylesheet" />
@endsection


@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12  float-left">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title">{{__('title.sitesettings')}}</strong></h4>
                    </header>

                    <form action="{{route('site-settings.store')}}" id="sitesettingsform">
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
                                <div class="row">


                                    <!-- Tab panes -->
                                    <div class="tab-content col-lg-12  float-left">
                                        @foreach($language as $key => $l)

                                            @foreach($l->site_settings as $sitesettings)
                                                <div class="tab-pane fade @if($key == 0) active show @endif "
                                                     id="language-id-{{$l->id}}">
                                                    <ul class="nav nav-tabs nav-justified nav-tabs-info">
                                                        <li class="nav-item active">
                                                            <a class="nav-link active" data-toggle="tab"
                                                               href="#general-settings{{$l->id}}">Genel Ayarlar</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link " data-toggle="tab"
                                                               href="#social-media{{$l->id}}">Sosyal Medya Ayarları</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="tab-pane fade active show"
                                                             id="general-settings{{$l->id}}">

                                                            <div class="col-lg-12">
                                                                <div class="row">
                                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="site_name{{$sitesettings->id}}"> {{__('sitesettings.site_name')}} </label>
                                                                            <input type="text" id="site_name{{$l->id}}"
                                                                                   class="form-control"
                                                                                   placeholder="{{__('sitesettings.site_name')}}"
                                                                                   name="site_name{{$sitesettings->id}}"
                                                                                   value="{{$sitesettings->site_name}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="site_slogan{{$sitesettings->id}}"> {{__('sitesettings.site_slogan')}}</label>
                                                                            <input type="text"
                                                                                   id="site_slogan{{$l->id}}"
                                                                                   class="form-control"
                                                                                   placeholder="{{__('sitesettings.site_slogan')}}"
                                                                                   name="site_slogan{{$sitesettings->id}}"
                                                                                   value="{{$sitesettings->site_slogan}}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12">
                                                                <div class="row">
                                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                                        <div class="col-lg-12 text-center">
                                                                            <div id="site_logo_holder{{$l->id}}"
                                                                                 class="image-content">
                                                                                @if(!empty($sitesettings->logo))
                                                                                    <img
                                                                                        src="{{asset($sitesettings->logo)}}"
                                                                                        alt="">
                                                                                @else
                                                                                    <img
                                                                                        src="{{asset('panel/assets/img/no-pictures.png')}}"
                                                                                        alt="">
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="site_logo{{$l->id}}">{{__('sitesettings.site_logo')}}</label>

                                                                            <div class="input-group">
                                                                                   <span class="input-group-btn">
                                                                                     <a id="site_logo{{$l->id}}"
                                                                                        data-input="thumbnail{{$l->id}}"
                                                                                        data-preview="site_logo_holder{{$l->id}}"
                                                                                        class="btn btn-primary">
                                                                                       <i class="fa fa-picture-o"></i> Choose
                                                                                     </a>
                                                                                   </span>
                                                                                <input id="thumbnail{{$l->id}}"
                                                                                       class="form-control"
                                                                                       type="text"
                                                                                       name="site_logo{{$l->id}}"
                                                                                       readonly
                                                                                       value="{{$sitesettings->logo}}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                                        <div class="col-lg-12 text-center">
                                                                            <div id="site_favicon_holder{{$l->id}}"
                                                                                 class="image-content">
                                                                                @if($sitesettings->fav_icon)

                                                                                    <img
                                                                                        src="{{asset($sitesettings->fav_icon)}}"
                                                                                        alt="">
                                                                                @else
                                                                                    <img
                                                                                        src="{{asset('panel/assets/img/no-pictures.png')}}"
                                                                                        alt="">
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label
                                                                                for="site_favicon{{$l->id}}">{{__('sitesettings.site_favicon')}}</label>

                                                                            <div class="input-group">
                                                                                   <span class="input-group-btn">
                                                                                     <a id="site_favicon{{$l->id}}"
                                                                                        data-input="site_favicon_thumbnail{{$l->id}}"
                                                                                        data-preview="site_favicon_holder{{$l->id}}"
                                                                                        class="btn btn-primary">
                                                                                       <i class="fa fa-picture-o"></i> Choose
                                                                                     </a>
                                                                                   </span>
                                                                                <input
                                                                                    id="site_favicon_thumbnail{{$l->id}}"
                                                                                    class="form-control"
                                                                                    type="text"
                                                                                    name="site_favicon{{$l->id}}"
                                                                                    readonly
                                                                                    value="{{$sitesettings->fav_icon}}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="social-media{{$l->id}}">
                                                            <button type="button"
                                                                    class="btn btn-success social_media_add_modal"
                                                                    data-settingsid="{{$sitesettings->id}}"

                                                            >
                                                                <i class="fa fa-plus"></i> {{__('global.socail_add')}}
                                                            </button>
                                                            <table
                                                                class="table table-separated social_media_{{$l->id}}"
                                                                id="social_media_table{{$sitesettings->id}}">
                                                                <thead>
                                                                <tr>
                                                                    <th class="text-center w-100px">{{__('global.icon')}}</th>
                                                                    <th class="text-center w-100px">{{__('global.name')}}</th>
                                                                    <th class="text-center w-100px">{{__('global.link')}}</th>
                                                                    <th class="text-center w-100px">{{__('global.target')}}</th>
                                                                    <th class="text-center w-100px">#</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($sitesettings->social_media as $sc)
                                                                    <tr>
                                                                        <td>
                                                                            <i class='fa {{$sc->icon}}'></i>

                                                                        </td>
                                                                        <td>
                                                                            {{$sc->name}}
                                                                        </td>
                                                                        <td>
                                                                            {{$sc->link}}
                                                                        </td>
                                                                        <td>
                                                                            @if($sc->link_target == 1)
                                                                                _SELF
                                                                            @else
                                                                                _BLANK
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            <button type="button"
                                                                                    class="table-action hover-primary btn btn-pure social_media_add_modal"
                                                                                    data_socialmediaid="{{$sc->id}}"
                                                                                    data-settingsid="{{$sc->sitesettings_id}}"
                                                                                    data-action="{{route('social-media.update',['show_social'])}}">
                                                                                <i class="ti-pencil"></i></button>
                                                                            <button type="button"
                                                                                    class="table-action hover-danger btn btn-pure deleteButton"
                                                                                    data-id="{{$sc->id}}"
                                                                                    data-action="{{route('social-media.destroy',[$sc->id])}}"
                                                                                    data-table="#social_media_table{{$sc->sitesettings_id}}">
                                                                                <i class="ti-trash"></i></button>

                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>


                                                        </div>
                                                    </div>

                                                </div>
                                            @endforeach
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12 col-md-12 col-sm-12 text-center  float-left">
                                <button type="submit" class="btn btn-w-md btn-round btn-primary ">{{__('global.save')}}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div><!--/.main-content -->

    <div class="modal modal-center fade" id="socail_media_add" tabindex="-1" style="display: none;"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('global.socail_add')}}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('social-media.store')}}" class="card social_media_add" id="social_media_add">
                        <div class="card-body">
                            <input type="hidden" id="site_settings_id" name="site_settings_id" value="">
                            <input type="hidden" id="social_media_id" name="social_media_id" value="">
                            <div class="form-group">

                                <div class="form-group">
                                    <label
                                        for="socail_media">{{__('global.icon')}}</label>
                                        <select name="icon" class="icon_select" id="icon_select">
                                            <option  value="">{{Lang::get('global.please_select')}}</option>
                                            @foreach(getIcon() as $i)
                                                <option data-icon="fa {{$i}}" value="{{trim($i)}}">{{$i}}</option>
                                            @endforeach
                                        </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="social_media_name">{{__('sitesettings.social_media_name')}}</label>
                                <input type="text" required class="form-control" id="social_media_name"
                                       name="social_media_name">
                            </div>
                            <div class="form-group">
                                <label for="social_media_link">{{__('sitesettings.social_media_link')}}</label>
                                <input type="text" required class="form-control" id="social_media_link"
                                       name="social_media_link">
                            </div>
                            <div class="form-group">
                                <label for="social_media_target">{{__('sitesettings.social_media_target')}}</label>
                                <select required name="social_media_target" id="social_media_target"
                                        class="form-control">
                                    <option value="1">_SELF</option>
                                    <option value="2">_BLANK</option>
                                </select>
                            </div>
                            <div class="form-group">

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-bold btn-pure btn-secondary"
                            data-dismiss="modal">{{__('global.close')}}
                    </button>
                    <button type="submit" form="social_media_add"
                            class="btn btn-bold btn-pure btn-primary">{{__('global.save')}}</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('JsContent')
    <script src="{{asset('panel/assets/js/select2.min.js')}}"></script>
    <script src="{{asset('panel/assets/js/sitesettings/sitesettings.js')}}"></script>
    <script>

        function formatText(icon) {
            return $('<span><i class=" ' + $(icon.element).data('icon') + '"></i> ' + icon.text + '</span>');
        };
        $('.icon_select').select2({
            templateSelection: formatText,
            templateResult: formatText,
            dropdownParent:$('#socail_media_add')
        });
        @foreach($language as $l)
        $('#site_logo{{$l->id}}').filemanager('image');

        $('#site_favicon{{$l->id}}').filemanager('image');
        @endforeach
        $('#socail_media').filemanager('image');
    </script>
@endsection


