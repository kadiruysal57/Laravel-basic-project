@extends('Kpanel.layouts.app')


@section('page-title') {{__('blokmanagement.blok_page_title')}} @endsection <!-- Sayfa title'ı ayarlanıyor -->

@section('CssContent')
    <!-- Bu sayfaya özel css dosyaları çekilecek -->
@endsection


@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title">{{__('blokmanagement.blok_page_title')}}</strong></h4>
                        <div class="text-right">
                            <a class="btn btn-success btn-sm" href="{{route('blok-management.create')}}"><i
                                    class="fa fa-plus"></i></a>
                        </div>
                    </header>

                    <div class="card-body">
                        <div class="col">

                            <div class="">
                                <table class="table table-separated" id="default_bloks_table">
                                    <thead>
                                    <tr>
                                        <th>{{__('blokmanagement.blok_management_name')}}</th>
                                        <th class="text-center w-100px">{{__('global.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($default_bloks as $d)
                                        <tr>
                                            <td>
                                                {{$d->default_blok_name}}
                                            </td>
                                            <td class="text-right table-actions">
                                                <a class="table-action hover-primary" href="{{route('blok-management.show',[$d->id])}}"><i class="ti-pencil"></i></a>
                                                <button type="button" class="table-action btn btn-pure deleteButton hover-danger" data-id="{{$d->id}}" data-action = "{{route('blok-management.destroy',[$d->id])}}" data-table="#default_bloks_table"><i class="ti-trash"></i></button>
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


