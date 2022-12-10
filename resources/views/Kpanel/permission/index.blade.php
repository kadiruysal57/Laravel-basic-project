@extends('Kpanel.layouts.app')


@section('page-title') İzin Ayarları @endsection <!-- Sayfa title'ı ayarlanıyor -->

@section('CssContent')
    <!-- Bu sayfaya özel css dosyaları çekilecek -->
@endsection


@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title">{{__('permission.permission_page_title')}}</strong></h4>
                        <div class="text-right">
                            <a class="btn btn-success btn-sm" href="{{route('permission.create')}}"><i
                                    class="fa fa-plus"></i></a>
                        </div>
                    </header>

                    <div class="card-body">
                        <div class="col">

                            <div class="">
                                <table class="table table-separated dataTables">
                                    <thead>
                                    <tr>
                                        <th class="min-w-100px">{{__('global.name_')}}</th>
                                        <th class="min-w-100px">{{__('global.status')}}</th>
                                        <th class="min-w-100px text-right">{{__('global.action')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($permission as $p)
                                        <tr>
                                            <td>
                                                {{$p->name}}
                                            </td>
                                            <td>@if($p->status == 1) {{__('global.active')}} @else {{__('global.passive')}} @endif</td>
                                            <td class="text-right table-actions">
                                                <a class="table-action hover-primary" href="{{route('permission.show',[$p->id])}}"><i class="ti-pencil"></i></a>
                                                <a class="table-action hover-danger" href="#"><i class="ti-trash"></i></a>
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


