@extends('Kpanel.layouts.app')


@section('page-title') Menu @endsection <!-- Sayfa title'ı ayarlanıyor -->

@section('CssContent')
    <!-- Bu sayfaya özel css dosyaları çekilecek -->
@endsection


@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title">{{__('menu.menu_page_title')}}</strong></h4>

                    </header>

                    <div class="card-body">
                        <table class="table table-separated language_table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('global.name')}}</th>
                                <th>{{__('global.status')}}</th>
                                <th>{{__('global.language')}}</th>
                                <th>{{__('global.action')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($menus as $m)
                                <tr>
                                    <td>{{$m->id}}</td>
                                    <td>{{$m->name}}</td>
                                    <td>{{$m->status}}</td>
                                    <td>{{$m->language->name}}</td>
                                    <td>
                                        <a class="table-action hover-primary btn btn-pure updateButtonLanguage"
                                                href = "{{route('menu.show',[$m->id])}}"><i
                                                class="ti-pencil"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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


