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
    <link href="{{asset('panel/assets/css/select2.min.css')}}" rel="stylesheet"/>
@endsection


@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12  float-left">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title">{{__('title.sitesettings')}} </strong></h4>
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

                                            <div class="tab-pane fade @if($key == 0) active show @endif "
                                                 id="language-id-{{$l->id}}">

                                                @foreach($l->site_settings as $sitesettings)

                                                    <ul class="nav nav-tabs nav-justified nav-tabs-info">
                                                        <li class="nav-item active">
                                                            <a class="nav-link active" data-toggle="tab"
                                                               href="#general-settings{{$l->id}}">{{__('sitesettings.general_info')}}</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link " data-toggle="tab"
                                                               href="#social-media{{$l->id}}">{{__('sitesettings.social_media_settings')}}</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link " data-toggle="tab"
                                                               href="#site-settings-address{{$l->id}}">{{__('sitesettings.address_settings')}}</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link " data-toggle="tab"
                                                               href="#open-hourse{{$l->id}}">{{__('sitesettings.open_hourse')}}</a>
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
                                                        <div class="tab-pane fade" id="site-settings-address{{$l->id}}">
                                                            <button type="button"
                                                                    class="btn btn-success address_add_button"
                                                                    data-settingsid="{{$sitesettings->id}}">
                                                                <i class="fa fa-plus"></i> {{__('sitesettings.address_add_button')}}
                                                            </button>
                                                            <table
                                                                class="table table-separated address{{$l->id}}"
                                                                id="address_table{{$sitesettings->id}}">
                                                                <thead>
                                                                <tr>
                                                                    <th class="text-center w-100px">{{__('sitesettings.address_name')}}</th>
                                                                    <th class="text-center w-100px">{{__('sitesettings.address')}}</th>
                                                                    <th class="text-center w-100px">{{__('sitesettings.gsm')}}</th>
                                                                    <th class="text-center w-100px">{{__('sitesettings.gsm')}} 2</th>
                                                                    <th class="text-center w-100px">{{__('global.email')}}</th>
                                                                    <th class="text-center w-100px">{{__('sitesettings.maps')}}</th>
                                                                    <th class="text-center w-100px">#</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody class="csshidden">
                                                                @foreach($sitesettings->address as $address)
                                                                    <tr>
                                                                        <td>{{$address->name}}</td>
                                                                        <td>{{$address->address}}</td>
                                                                        <td>{{$address->gsm}}</td>
                                                                        <td>{{$address->gsm2}}</td>
                                                                        <td>{{$address->email}}</td>
                                                                        <td>{{$address->maps}}</td>
                                                                        <td>
                                                                            <button type="button"
                                                                                    class="table-action hover-primary btn btn-pure address_add_button"
                                                                                    data_address_id="{{$address->id}}"
                                                                                    data-settingsid="{{$address->site_settings_id}}"
                                                                                    data-action="{{route('address.update',['show_address'])}}">
                                                                                <i class="ti-pencil"></i></button>
                                                                            <button type="button"
                                                                                    class="table-action hover-danger btn btn-pure deleteButton"
                                                                                    data-id="{{$address->id}}"
                                                                                    data-action="{{route('address.destroy',[$address->id])}}"
                                                                                    data-table="#address_table{{$address->site_settings_id}}">
                                                                                <i class="ti-trash"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="tab-pane fade" id="open-hourse{{$l->id}}">
                                                            <button type="button"
                                                                    class="btn btn-success open_hourse_add"
                                                                    data-settingsid="{{$sitesettings->id}}"
                                                                    data-openhouseid="">
                                                                <i class="fa fa-plus"></i> {{__('sitesettings.open_hourse_add')}}
                                                            </button>

                                                            <table
                                                                class="table table-separated open_hourse_table{{$l->id}}"
                                                                id="open_hourse_table{{$sitesettings->id}}">
                                                                <thead>
                                                                <tr>
                                                                    <th class="text-center w-100px">{{__('sitesettings.start_day')}}</th>
                                                                    <th class="text-center w-100px">{{__('sitesettings.finish_day')}}</th>
                                                                    <th class="text-center w-100px">{{__('sitesettings.address_name')}}</th>
                                                                    <th class="text-center w-100px">{{__('sitesettings.start_time')}}</th>
                                                                    <th class="text-center w-100px">{{__('sitesettings.finish_time')}}</th>
                                                                    <th class="text-center w-100px">#</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody class="csshidden">
                                                                @foreach($sitesettings->open_hourse as $open_hourse)
                                                                    <tr>
                                                                        <td>
                                                                            {{__('global.'.$open_hourse->start_day_name->name)}}
                                                                        </td>
                                                                        <td>
                                                                            {{__('global.'.$open_hourse->finish_day_name->name)}}
                                                                        </td>
                                                                        <td>
                                                                            {{$open_hourse->office_name->name}}
                                                                        </td>
                                                                        <td>
                                                                            {{$open_hourse->start_time}}
                                                                        </td>
                                                                        <td>
                                                                            {{$open_hourse->finish_time}}
                                                                        </td>
                                                                        <td>
                                                                            <button type="button" class="table-action hover-primary btn btn-pure open_hourse_add" data_openhouseid="{{$open_hourse->id}}" data-settingsid="{{$sitesettings->id}}" data-action="{{route('open-hourse.update',['show_open_hourse'])}}" ><i class="ti-pencil"></i></button>
                                                                            <button type="button" class="table-action hover-danger btn btn-pure deleteButton" data-id="{{$open_hourse->id}}" data-action = "{{route('open-hourse.destroy',[$open_hourse->id])}}" data-table="#open_hourse_table{{$sitesettings->id}}" ><i class="ti-trash"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
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
                                        <option value="">{{Lang::get('global.please_select')}}</option>
                                        @foreach(getIcon() as $i)
                                            <option data-icon="fa {{$i}}" value="{{trim($i)}}">{{$i}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="social_media_name">{{__('sitesettings.social_media_name')}}</label>
                                <input type="text"  class="form-control" id="social_media_name"
                                       name="social_media_name">
                            </div>
                            <div class="form-group">
                                <label for="social_media_link">{{__('sitesettings.social_media_link')}}</label>
                                <input type="text"  class="form-control" id="social_media_link"
                                       name="social_media_link">
                            </div>
                            <div class="form-group">
                                <label for="social_media_target">{{__('sitesettings.social_media_target')}}</label>
                                <select  name="social_media_target" id="social_media_target"
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

    <div class="modal modal-center fade" id="address_add" tabindex="-1" style="display: none;"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('sitesettings.address_add_button')}}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('address.store')}}" class="card address_add" id="address_ad">
                        <div class="card-body">
                            <input type="hidden" id="address_site_settings_id" name="site_settings_id" value="">
                            <input type="hidden" id="address_id" name="address_id" value="">
                            <div class="form-group">
                                <label
                                    for="address_name">{{__('sitesettings.address_name')}}</label>
                                <input type="text" name="address_name" id="address_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label
                                    for="address">{{__('sitesettings.address')}}</label>
                                <textarea name="address" id="address" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="gsm">{{__('sitesettings.gsm')}}</label>
                                <input type="text"  class="form-control" id="gsm"
                                       name="gsm">
                            </div>
                            <div class="form-group">
                                <label for="gsm2">{{__('sitesettings.gsm')}} 2</label>
                                <input type="text"  class="form-control" id="gsm2"
                                       name="gsm2">
                            </div>
                            <div class="form-group">
                                <label for="email">{{__('global.email')}}</label>
                                <input type="text"  class="form-control" id="email"
                                       name="email">
                            </div>

                            <div class="form-group">

                                <div class="form-group">
                                    <label
                                        for="maps">{{__('sitesettings.maps')}}</label>
                                    <textarea name="maps" id="maps" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-bold btn-pure btn-secondary"
                            data-dismiss="modal">{{__('global.close')}}
                    </button>
                    <button type="submit" form="address_ad"
                            class="btn btn-bold btn-pure btn-primary">{{__('global.save')}}</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal modal-center fade" id="open_hourse_modal" tabindex="-1" style="display: none;"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('sitesettings.open_hourse_add')}}</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('open-hourse.store')}}" class="card open_hourse_form" id="open_hourse_form">
                        <div class="card-body">
                            <input type="hidden" id="open_hourse_site_settings_id" name="open_hourse_site_settings_id"
                                   value="">
                            <input type="hidden" id="open_hourse_id" name="open_hourse_id" value="">
                            <div class="form-group">
                                <label
                                    for="start_day">{{__('sitesettings.start_day')}}</label>
                                <select name="start_day" class="form-control start_day" id="start_day">
                                    <option value="">{{__('global.please_select')}}</option>
                                    @foreach($days as $d)
                                        <option value="{{$d->id}}">{{__('global.'.$d->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label
                                    for="finish_day">{{__('sitesettings.finish_day')}}</label>
                                <select name="finish_day" class="form-control finish_day" id="finish_day">
                                    <option value="">{{__('global.please_select')}}</option>
                                    @foreach($days as $d)
                                        <option value="{{$d->id}}">{{__('global.'.$d->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label
                                    for="office_id">{{__('sitesettings.address_settings')}}</label>
                                <select name="office_id" class="form-control office_id" id="office_id">
                                    <option value="">{{__('global.please_select')}}</option>

                                    @foreach($offices as $o)
                                        <option value="{{$o->id}}">{{$o->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="start_time">{{__('sitesettings.start_time')}}</label>
                                <input type="text" autocomplete="off" data-show-meridian="false"
                                       data-provide="timepicker" data-autoclose="true" name="start_time" id="start_time"
                                       class="form-control">
                                ,
                            </div>
                            <div class="form-group">
                                <label for="finish_time">{{__('sitesettings.finish_time')}}</label>
                                <input type="text" autocomplete="off" data-show-meridian="false"
                                       data-provide="timepicker" data-autoclose="true" name="finish_time"
                                       id="finish_time" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-bold btn-pure btn-secondary"
                            data-dismiss="modal">{{__('global.close')}}
                    </button>
                    <button type="submit" form="open_hourse_form"
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
            dropdownParent: $('#socail_media_add')
        });
        @foreach($language as $l)
        $('#site_logo{{$l->id}}').filemanager('image');

        $('#site_favicon{{$l->id}}').filemanager('image');
        @endforeach
    </script>
@endsection


