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
                        <h4 class="card-title">{{__('contents.contents_create_title')}}</strong></h4>

                    </header>
                    <div class="card-body">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#contents-genel-info">Home</a>
                            </li>

                        </ul>
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
        src="{{asset('panel/assets/vendor/chartjs/Chart.min.js')}}"></script>
@endsection


