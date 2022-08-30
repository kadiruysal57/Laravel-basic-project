@extends('Kpanel.layouts.app')


@section('page-title') Contents @endsection <!-- Sayfa title'ı ayarlanıyor -->

@section('CssContent')
    <!-- Bu sayfaya özel css dosyaları çekilecek -->
@endsection


@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <header class="card-header">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('contents.index')}}"><i class="fa fa-file-o"></i>{{__('contents.contents_page_title')}}</a></li>
                            <li class="breadcrumb-item active"><i class="fa fa-edit"></i> {{__('contents.contents_create_title')}}</li>
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

                        </ul>

                        </div>
                        <form id="contents_create" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                              action="{{route('contents.store')}}">
                            <input type="hidden" name="id" value="create">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="contents-genel-info">
                                <div class="form-group">
                                    <label class="require">{{__('global.name')}}</label>
                                    <input class="form-control " name="name" required type="text">
                                </div>
                                <div class="form-group">
                                    <label class="require">{{__('global.title')}}</label>
                                    <input class="form-control " name="title" required type="text">
                                </div>
                                <div class="form-group">
                                    <label class="require">{{__('global.short_desc')}}</label>
                                    <textarea name="short_desc" class="form-control"></textarea>
                                </div>
                                <div class="text-center">
                                <button type="submit" class="btn btn-w-md btn-round btn-primary " form="contents_create">{{__('global.save')}}</button>
                                </div>
                            </div>




                            <div class="tab-pane fade " id="contents-seo">
                                <div class="form-group">
                                    <label class="require">{{__('contents.seo_title')}}</label>
                                    <input class="form-control " name="seo_title" required type="text">
                                </div>
                                <div class="form-group">
                                    <label class="require">{{__('contents.keywords')}}</label>
                                    <input class="form-control " name="keywords" required type="text">
                                </div>
                                <div class="form-group">
                                    <label class="require">{{__('contents.seo_description')}}</label>
                                    <textarea name="seo_description" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label class="require">{{__('contents.focus_keywords')}}</label>
                                    <input class="form-control " name="focus_keywords" required type="text">
                                </div>

                                <div class="form-group">
                                    <label class="require">{{__('global.slug')}}</label>
                                    <input class="form-control " name="seo_url" required type="text">
                                </div>


                                <div class="text-center">
                                    <button type="submit" class="btn btn-w-md btn-round btn-primary " form="contents_create">{{__('global.save')}}</button>
                                </div>
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
    <script src="{{asset('panel/assets/vendor/chartjs/Chart.min.js')}}"></script>
    <script src="{{asset('panel/assets/js/contents/content.js')}}"></script>
@endsection


