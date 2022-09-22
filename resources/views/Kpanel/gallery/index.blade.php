@extends('Kpanel.layouts.app')


@section('page-title') {{__('title.gallery')}} @endsection <!-- Sayfa title'ı ayarlanıyor -->

@section('CssContent')
    <!-- Bu sayfaya özel css dosyaları çekilecek -->
@endsection


@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title">{{__('gallery.gallery_page_title')}}</strong></h4>
                        <div class="text-right">
                            <a class="btn btn-success btn-sm" href="{{route('gallery.create')}}"><i
                                    class="fa fa-plus"></i></a>
                        </div>
                    </header>

                    <div class="card-body">
                        <div class="col">

                                <div class="">
                                    <table class="table table-separated" id="gallery_table">
                                        <thead>
                                        <tr>
                                            <td>#</td>
                                            <th>{{__('global.name')}}</th>
                                            <th>{{__('global.title')}}</th>
                                            <th>{{__('global.description')}}</th>
                                            <th class="text-center w-100px">{{__('global.actions')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($gallery as $key => $g)
                                                <tr>
                                                    <td>
                                                        {{++$key}}
                                                    </td>
                                                    <td>
                                                        {{$g->name}}
                                                    </td>
                                                    <td>
                                                        {{$g->title}}
                                                    </td>
                                                    <td>
                                                        {{$g->description}}
                                                    </td>
                                                    <td class="text-right table-actions">
                                                        <a class="table-action hover-primary" href="{{route('gallery.show',[$g->id])}}"><i class="ti-pencil"></i></a>
                                                        <button type="button" class="table-action btn btn-pure deleteButton hover-danger" data-id="{{$g->id}}" data-action = "{{route('gallery.destroy',[$g->id])}}" data-table="#gallery_table"><i class="ti-trash"></i></button>
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


