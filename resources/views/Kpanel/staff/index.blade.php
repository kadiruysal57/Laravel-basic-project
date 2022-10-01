@extends('Kpanel.layouts.app')


@section('page-title') {{__('staff.staff_page_title')}} @endsection <!-- Sayfa title'ı ayarlanıyor -->

@section('CssContent')
    <!-- Bu sayfaya özel css dosyaları çekilecek -->
@endsection


@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title">{{__('staff.staff_page_title')}}</strong></h4>
                        <div class="text-right">
                            <a class="btn btn-success btn-sm" href="{{route('staff.create')}}"><i
                                    class="fa fa-plus"></i></a>
                        </div>
                    </header>

                    <div class="card-body">
                        <div class="col">

                                <div class="">
                                    <table class="table table-separated dataTables">
                                        <thead>
                                        <tr>
                                            <th>{{__('global.image')}}</th>
                                            <th>{{__('global.description')}}</th>
                                            <th class="text-center w-100px">{{__('global.action')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($staff as $s)
                                                <tr>
                                                    <td>
                                                        <div class="media">
                                                            @if(empty($s->staff_one))

                                                                <span class="svg-icon svg-icon-muted svg-icon-2hx m-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24" viewBox="0 0 24 24" fill="none">
                                                                        <path opacity="0.3"
                                                                              d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z"
                                                                              fill="currentColor"/>
                                                                        <path opacity="0.3"
                                                                              d="M12 14.4L9.89999 16.5C9.69999 16.7 9.39999 16.8 9.19999 16.8C8.99999 16.8 8.7 16.7 8.5 16.5C8.1 16.1 8.1 15.5 8.5 15.1L10.6 13L12 14.4ZM13.4 13L15.5 10.9C15.9 10.5 15.9 9.90001 15.5 9.50001C15.1 9.10001 14.5 9.10001 14.1 9.50001L12 11.6L13.4 13Z"
                                                                              fill="currentColor"/>
                                                                        <path
                                                                            d="M10.4 3.60001L12 6H21C21.6 6 22 6.4 22 7V19C22 19.6 21.6 20 21 20H3C2.4 20 2 19.6 2 19V4C2 3.4 2.4 3 3 3H9.2C9.7 3 10.2 3.20001 10.4 3.60001ZM13.4 13L15.5 10.9C15.9 10.5 15.9 9.9 15.5 9.5C15.1 9.1 14.5 9.1 14.1 9.5L12 11.6L9.89999 9.5C9.49999 9.1 8.9 9.1 8.5 9.5C8.1 9.9 8.1 10.5 8.5 10.9L10.6 13L8.5 15.1C8.1 15.5 8.1 16.1 8.5 16.5C8.7 16.7 9 16.8 9.2 16.8C9.4 16.8 9.69999 16.7 9.89999 16.5L12 14.4L14.1 16.5C14.3 16.7 14.6 16.8 14.8 16.8C15 16.8 15.3 16.7 15.5 16.5C15.9 16.1 15.9 15.5 15.5 15.1L13.4 13Z"
                                                                            fill="currentColor"/>
                                                                    </svg>
                                                                </span>
                                                            @endif
                                                            @if(!empty($s->staff_one))
                                                                <img class="avatar" src="{{$s->staff_one->url}}"
                                                                     alt="staff image">
                                                            @endif
                                                            <div class="media-body">
                                                                <p class="lh-1">{{$s->name}}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{$s->description}}</td>
                                                    <td class="text-right table-actions">
                                                        <a class="table-action hover-primary" href="{{route('staff.show',[$s->id])}}"><i class="ti-pencil"></i></a>
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


