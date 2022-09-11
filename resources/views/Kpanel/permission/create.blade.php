@extends('Kpanel.layouts.app')


@section('page-title') İzin Listesi @endsection <!-- Sayfa title'ı ayarlanıyor -->

@section('CssContent')

@endsection


@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <header class="card-header">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('permission.index')}}"><i class="fa fa-file-o"></i>{{__('permission.permission_page_title')}}</a></li>
                            <li class="breadcrumb-item active"><i class="fa fa-edit"></i> {{__('permission.permission_create_title')}}</li>
                        </ol>
                    </header>

                    <div class="card-body">
                        <div class="d-flex ">

                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#role">{{__('permission.role')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#permission">{{__('permission.permission')}}</a>
                                </li>
                            </ul>

                        </div>
                        <form id="permission_create" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="{{route('permission.store')}}">
                            <input type="hidden" name="id" value="create">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="role">
                                    <div class="form-group">
                                        <label class="require">{{__('global.name')}}</label>
                                        <input class="form-control " name="name" required type="text">
                                    </div>
                                    <div class="form-group">
                                        <label class="require">{{__('global.status')}}</label>
                                        <select name="status" class="form-control" tabindex="-98">
                                            <option>Lütfen Durum Seçiniz</option>
                                            <option value="1">Aktif</option>
                                            <option value="2">Pasif</option>
                                        </select>
                                    </div>


                                </div>





                                <div class="tab-pane fade " id="permission">

                                    <div class="card-body">
                                        <div class="row">
                                            @foreach($roles_table as $rt)
                                                <div class="d-grid col-3">
                                                    <label class="fs-6 fw-bold form-label mt-3">
                                                        <span>{{$rt->roles_name}}</span>
                                                    </label>
                                                    <label class="switch">
                                                        <input class="form-check-input " name="role_permission{{$rt->id}}" checked type="checkbox" value="1" id="flexSwitchDefault">
                                                        <span class="switch-indicator"></span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>




                            <div class="text-center">
                                <button type="submit" class="btn btn-w-md btn-round btn-primary " form="permission_create">{{__('global.save')}}</button>
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
    <script src="{{asset('panel/assets/js/permission/permission.js')}}"></script>
@endsection


