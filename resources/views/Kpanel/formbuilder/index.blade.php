@extends('Kpanel.layouts.app')


@section('page-title') Form @endsection <!-- Sayfa title'ı ayarlanıyor -->

@section('CssContent')
    <!-- Bu sayfaya özel css dosyaları çekilecek -->
@endsection


@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title">{{__('formbuilder.formbuilder_page_title')}}</strong></h4>
                        <div class="text-right">
                            <a class="btn btn-success btn-sm" href="{{route('form-builder.create')}}"><i
                                    class="fa fa-plus"></i></a>
                        </div>
                    </header>

                    <div class="card-body">
                        <div class="col">

                            <div class="">
                                <table class="table table-separated" id="form-builder-form">
                                    <thead>
                                    <tr>

                                        <th>{{__('formbuilder.formbuilder_name')}}</th>
                                        <th class="text-center w-100px">{{__('formbuilder.action')}}</th>
       
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($form as $f)
                                        <tr>
                                            <td>{{$f->name}}</td>

                                            <td class="text-right table-actions">
                                                <a class="table-action hover-primary" href="{{route('form-builder.show',[$f->id])}}"><i class="ti-pencil"></i></a>
                                                <a class="table-action hover-danger deleteButton"
                                                   data-id="{{$f->id}}"
                                                   data-action="{{route('form-builder.destroy',[$f->id])}}"
                                                   data-table="#form-builder-form"
                                                   href="#"><i class="ti-trash"></i></a>
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


