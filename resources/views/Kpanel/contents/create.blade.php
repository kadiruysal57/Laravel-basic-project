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
    </style>
@endsection


@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <header class="card-header">

                            <h4 class="card-title">{{__('contents.contents_create_title')}}</strong></h4>

                    </header>
                    <div class="card-body">
                        <div class="d-flex ">

                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab"
                                       href="#contents-genel-info">{{__('contents.general_information')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab"
                                       href="#contents-seo">{{__('contents.seo')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab"
                                       href="#contents-gallery">{{__('contents.content_gallery')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab"
                                       href="#contents-blok">{{__('contents.blok_manager')}}</a>
                                </li>

                            </ul>

                        </div>
                        <form id="contents_create" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                              action="{{route('contents.store')}}">
                            <input type="hidden" name="id" value="create">

                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="contents-genel-info">
                                    <div class="form-group">
                                        <label class="">{{__('global.name')}}</label>
                                        <input class="form-control content_name" name="name"  type="text">
                                    </div>
                                    <div class="form-group">
                                        <label class="">{{__('global.title')}}</label>
                                        <input class="form-control " name="title"  type="text">
                                    </div>
                                    <div class="form-group">
                                        <label class="" for="language_id">{{__('global.language')}}</label>
                                        <select name="language_id" id="language_id" class="auto-search form-control">
                                            <option value="">{{__('global.please_select')}}</option>
                                            @foreach($language as $l)
                                                <option @if($l->main_language == 1) selected @endif value="{{$l->id}}">{{$l->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="justify-content-center text-center">
                                    <button type='button' id='modal'
                                            data-toggle='modal'
                                            data-target='#selected-modal'
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                                <span class="svg-icon svg-icon-3"> {{__('global.contents_modal_text')}}
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z"
                                                    fill="currentColor"></path>
                                                <path opacity="0.3"
                                                      d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z"
                                                      fill="currentColor"></path>
                                                </svg>
                                                </span>
                                    </button>
                                    </div>

                                    <div id='selected-modal' class="modal fade"
                                         tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">{{__('global.modal_title')}}</h4>
                                                </div>
                                                <div class="modal-body row">

                                                    <div class="form-group col-6">
                                                        <label for="main_page">{{__('contents.main_page')}}</label>
                                                        <select name="main_page" id="main_page"  data-live-search="true" title="{{__('global.please_select')}}" style="height: 46px !important; background-color: #fcfcfc !important; overflow-y: auto"
                                                                class="form-control">
                                                            <option selected="" value="0">{{__('global.main_page')}}</option>
                                                            @foreach($main_pages as $m)
                                                                <option value="{{$m->id}}">{{$m->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="slider_id">{{__('global.slider')}}</label>
                                                        <select name="slider_id" data-provide="selectpicker" data-live-search="true" title="{{__('global.please_select')}}" id="slider_id" class="auto-search form-control">
                                                            @foreach($slider as $s)
                                                                <option value="{{$s->id}}">{{$s->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div><div class="form-group col-6">
                                                        <label for="gallery_id">{{__('global.gallery')}}</label>
                                                        <select name="gallery_id" data-live-search="true" id="gallery_id" class="auto-search form-control">
                                                            <option value="">{{__('global.please_select')}}</option>
                                                            @foreach($gallery as $g)
                                                                <option value="{{$g->id}}">{{$g->name}}({{$g->id}})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="services_id">{{__('services.services_page_title')}}</label>
                                                        <select name="services_id" data-live-search="true" id="services_id" class="auto-search form-control">
                                                            <option value="">{{__('global.please_select')}}</option>
                                                            @foreach($services as $s)
                                                                <option value="{{$s->id}}">{{$s->name}}({{$s->id}})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="portfolio_id">{{__('title.portfolio')}}</label>
                                                        <select name="portfolio_id" data-live-search="true" id="portfolio_id" class="auto-search form-control">
                                                            <option value="">{{__('global.please_select')}}</option>
                                                            @foreach($portfolio as $p)
                                                                <option value="{{$p->id}}">{{$p->name}}({{$p->id}})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="comments_id">{{__('title.comments')}}</label>
                                                        <select name="comments_id" data-live-search="true" id="comments_id" class="auto-search form-control">
                                                            <option value="">{{__('global.please_select')}}</option>
                                                            @foreach($comments as $c)
                                                                <option value="{{$c->id}}">{{$c->name}}({{$c->id}})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="staff_id">{{__('title.staff')}}</label>
                                                        <select name="staff_id" data-live-search="true" id="staff_id" class="auto-search form-control">
                                                            <option value="">{{__('global.please_select')}}</option>
                                                            @foreach($staff as $s)
                                                                <option value="{{$s->id}}">{{$s->name}}({{$s->id}})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="form_id">{{__('global.form')}}</label>
                                                        <select name="form_id" data-provide="selectpicker" data-live-search="true" title="{{__('global.please_select')}}" id="form_id" class="auto-search form-control">
                                                            @foreach($form as $f)
                                                                <option value="{{$f->id}}">{{$f->name}}({{$f->id}})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="faq_id">{{__('global.faq')}}</label>
                                                        <select name="faq_id" data-live-search="true" id="faq_id" class="auto-search form-control">
                                                            <option value="">{{__('global.please_select')}}</option>
                                                            @foreach($faq as $f)
                                                                <option value="{{$f->id}}">{{$f->name}}(Id:{{$f->id}})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-6">
                                                        <label for="category_id">{{__('global.category')}}</label>
                                                        <select name="category_id" data-provide="selectpicker" data-live-search="true" title="{{__('global.please_select')}}" id="category_id" class="auto-search form-control">
                                                            @foreach($category as $c)
                                                                <option value="{{$c->id}}">{{$c->name}}(Id:{{$c->id}})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                    <div class="form-group">
                                        <label class="">{{__('global.short_desc')}}</label>
                                        <textarea name="short_desc" class="ckeditor form-control" id="short_desc"></textarea>
                                    </div>

                                    <div class="form-group">
                                                    <label class="">{{__('global.content_page')}}</label>
                                                    <textarea class="ckeditor form-control" name="description"
                                                              id="description"></textarea>
                                    </div>
                                </div>

                                <div class="tab-pane fade " id="contents-seo">
                                    <div class="form-group">
                                        <label class="">{{__('contents.seo_title')}}</label>
                                        <input class="form-control " name="seo_title" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label class="">{{__('contents.keywords')}}</label>
                                        <input class="form-control " name="keywords" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label class="">{{__('contents.seo_description')}}</label>
                                        <textarea name="seo_description" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="">{{__('contents.focus_keywords')}}</label>
                                        <input class="form-control " name="focus_keywords"  type="text">
                                    </div>
                                    <div class="form-group">
                                        <label class="require">{{__('global.link_q')}}</label>
                                        <select name="seo_q1" class="form-control" tabindex="-98">
                                            <option value="">{{__('global.please_select')}}</option>
                                            <option value="1">{{__('global.yes')}}</option>
                                            <option value="2">{{__('global.no')}}</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="">{{__('global.slug')}}</label>
                                        <input class="form-control " name="seo_url"  type="text">
                                    </div>

                                    <label class="">{{__('global.feature')}}</label>
                                    <div
                                        class='col-lg-12 text-center feature_image_deletes'>
                                        <div id='content_feature_holders'
                                             class='image-content'>

                                        </div>
                                    </div>

                                    <div class='input-group mt-3'>

                                        <span class='input-group-btn'>
                                            <a id='feature_adds'
                                               data-input='feature_add_inputs'
                                               data-preview='content_feature_holders'
                                               class='btn btn-primary gallery_adds'>
                                                <i class='fa fa-picture-o'></i> {{__('contents.gallery_select')}}
                                            </a>
                                        </span>
                                        <input id='feature_add_inputs'
                                               class='form-control'
                                               type='text'
                                               name='feature_url'
                                               readonly
                                               value=''>
                                        <button type='button'
                                                class='btn btn-danger btn-sm deleteCreateFeature'
                                                data-id=""
                                                data-action=""
                                                style=''><i class='fa fa-trash'></i>
                                        </button>
                                    </div>


                                </div>

                                <div class="tab-pane fade" id="contents-gallery">
                                    <input id="count_gallery" name="count_gallery" type="hidden" value="0"/>
                                    <div class="fv-row mb-7 fv-plugins-icon-container text-right">
                                        <button type="button" id="gallery_add_button" data-action="{{route('contents.update',['gallery_add'])}}" data-table="#content_gallery_add_table" class="btn btn-success m-lg-2 gallery_add_button">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-separated" id="content_gallery_add_table">
                                            <thead>
                                                <tr>
                                                    <th>{{__('contents.image')}}</th>
                                                    <th></th>
                                                    <th>{{__('contents.order')}}</th>
                                                    <th>{{__('contents.actions')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane fade " id="contents-blok">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <label for="">{{__('contents.default_blok')}}</label>
                                        <select name="default_blok" class="form-control" id="default_blok">
                                            <option value="">{{__('global.special')}}</option>
                                            @foreach($default_bloks as $db)
                                                <option value="{{$db->id}}">{{$db->default_blok_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 blok_manager_content" id="blok_manager_content">
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
                                    <div class="col-lg-12 col-md-12 col-sm-12 blok_manager_content">

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
                                                <textarea class="footer_blok_data"
                                                          name="footer_blok_data"></textarea>
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
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 mt-3 float-left text-center">
                                <button type="submit" class="btn btn-w-md btn-round btn-primary "
                                        form="contents_create">{{__('global.save')}}</button>
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
                    <button type="button" class="btn btn-bold btn-pure btn-primary html_blok_save">{{__('global.save')}}</button>
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
    <script src="{{asset('panel/assets/js/contents/content.js')}}"></script>
    <script src="{{asset('panel/assets/js/jquery.nestable.min.js')}}"></script>
    <script>
        var editor_blok_management = CKEDITOR.replace('html_blok_edit', options);

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


