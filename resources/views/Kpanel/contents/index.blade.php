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
                        <h4 class="card-title">{{__('contents.contents_page_title')}}</strong></h4>
                        <div class="text-right">
                            <a class="btn btn-success btn-sm" href="{{route('contents.create')}}"><i
                                    class="fa fa-plus"></i></a>
                        </div>
                    </header>

                    <div class="card-body">
                        <div class="col">

                                <div class="table-responsive">
                                    <table class="table table-separated" id="contents_table">
                                        <thead>
                                        <tr>
                                            <th>{{__('contents.pagesname')}}</th>
                                            <th class="text-center w-100px">{{__('contents.actions')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($contents as $c)
                                        <tr>
                                            <td>{{$c->name}}</td>
                                            <td>{{$c->language->name}}</td>
                                            <td class="text-right table-actions">
                                                <a class="table-action hover-primary" href="{{route('contents.show',[$c->id])}}"><i class="ti-pencil"></i></a>
                                                <button type="button" class="table-action btn btn-pure deleteButton hover-danger" data-id="{{$c->id}}" data-action = "{{route('contents.destroy',[$c->id])}}" data-table="#contents_table"><i class="ti-trash"></i></button>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
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


