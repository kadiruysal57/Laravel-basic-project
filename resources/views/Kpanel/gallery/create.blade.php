@extends('Kpanel.layouts.app')


@section('page-title') {{__('title.gallery_add')}} @endsection <!-- Sayfa title'ı ayarlanıyor -->

@section('CssContent')
    <!-- Bu sayfaya özel css dosyaları çekilecek -->
@endsection


@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title">{{__('gallery.gallery_add_page_title')}}</strong></h4>

                    </header>

                    <div class="card-body">
                        <form id="gallery_create" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                              action="{{route('gallery.store')}}">
                            <input type="hidden" name="id" value="create">
                            <div class="form-group">
                                <label class="require">{{__('global.name')}}</label>
                                <input class="form-control " name="name" placeholder="{{__('global.name')}}"
                                       type="text">
                            </div>

                            <div class="form-group">
                                <label class="require">{{__('global.title')}}</label>
                                <input class="form-control " name="title" placeholder="{{__('global.title')}}"
                                       type="text">
                            </div>
                            <div class="form-group">
                                <label class="require">{{__('global.description')}}</label>
                                <textarea name="description" class="form-control"
                                          placeholder="{{__('global.description')}}"></textarea>
                            </div>
                            <div>
                                <label class="require">{{__('global.status')}}</label>
                                <select name="status" class="form-control">
                                    <option value="">{{__('global.please_select')}}</option>
                                    <option value="1">{{__('global.active')}}</option>
                                    <option value="2">{{__('global.passive')}}</option>
                                </select>
                            </div>
                            <input type="hidden" value="0" name="gallery_count" class="gallery_count">
                            <table class="table table-separated " id="gallery_image">
                                <thead>
                                <tr>

                                    <th colspan="3" class="text-right w-100px">
                                        <button type="button" class="btn btn-success gallery_image_add"
                                                data-table="#gallery_image" data-action="{{route('gallery.store')}}"><i
                                                class="fa fa-plus"></i></button>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <div class="col-lg-12 col-md-12 col-sm-12 mt-3 float-left text-center">
                                <button type="submit" class="btn btn-w-md btn-round btn-primary "
                                       >{{__('global.save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div><!--/.main-content -->

@endsection

@section('JsContent')
    <script
        src="{{asset('panel/assets/js/gallery/gallery.js')}}"></script>
@endsection


