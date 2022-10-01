@extends('Kpanel.layouts.app')


@section('page-title') Users @endsection <!-- Sayfa title'ı ayarlanıyor -->

@section('CssContent')
    <!-- Bu sayfaya özel css dosyaları çekilecek -->
@endsection


@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title">{{__('users.page_title')}}</strong></h4>
                        <div class="text-right">
                            <a class="btn btn-success btn-sm" href="{{route('users.create')}}"><i
                                    class="fa fa-plus"></i></a>
                        </div>
                    </header>

                    <div class="card-body">
                        <div class="col">

                            <div class="">
                                <table class="table table-separated dataTables" id="users_table">
                                    <thead>
                                    <tr>
                                        <th>{{__('users.user_name')}}</th>
                                        <th>{{__('users.email')}}</th>
                                        <th>{{__('users.status')}}</th>
                                        <th class="text-center w-100px">{{__('users.actions')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $u)
                                        <tr>
                                            <td>{{$u->name}}</td>
                                            <td>{{$u->email}}</td>
                                            <td>{{statusView($u->status)}}</td>
                                            <td class="text-right table-actions">
                                                <a class="table-action hover-primary" href="{{route('users.show',[$u->id])}}"><i class="ti-pencil"></i></a>
                                                <button type="button" class="table-action btn btn-pure deleteButton hover-danger" data-id="{{$u->id}}" data-action = "{{route('users.destroy',[$u->id])}}" data-table="#users_table"><i class="ti-trash"></i></button>
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


