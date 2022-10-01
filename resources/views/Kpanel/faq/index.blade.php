@extends('Kpanel.layouts.app')

@section('page-title') {{__('title.faq')}} @endsection
@section('CssContent')

@endsection

@section('content')

    <div class="main-content">
        <div class="col-12">
            <div class="card">
                <header class="card-header">
                    <h4 class="card-title">{{__('title.faq')}}</strong></h4>

                    <a class="btn btn-success btn-sm" href="{{route('faq.create')}}"><i
                            class="fa fa-plus"></i></a>
                </header>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-separated dataTables" id="faq_table">
                            <thead>
                            <th>#</th>
                            <th>{{__('faq.title')}}</th>
                            <th>{{__('faq.status')}}</th>
                            <th class="text-right table-actions">{{__('global.action')}}</th>
                            </thead>
                            <tbody>
                            @foreach($faq_category as $faq)
                                <tr>
                                    <td>{{$faq->id}}</td>
                                    <td>{{$faq->title}}</td>
                                    <td>{{statusView($faq->status)}}</td>
                                    <td class="text-right table-actions">
                                        <a class="table-action hover-primary" href="{{route('faq.show',[$faq->id])}}"><i class="ti-pencil"></i></a>
                                        <button type="button" class="table-action btn btn-pure deleteButton hover-danger" data-id="{{$faq->id}}" data-action = "{{route('faq.destroy',[$faq->id])}}" data-table="#faq_table"><i class="ti-trash"></i></button>

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

@endsection

@section('JsContent')
@endsection
