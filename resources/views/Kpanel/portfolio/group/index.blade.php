@extends('Kpanel.layouts.app')

@section('page-title') {{__('title.portfolio_group')}} @endsection
@section('CssContent')

@endsection

@section('content')

    <div class="main-content">
        <div class="col-12">
            <div class="card">
                <header class="card-header">
                    <h4 class="card-title">{{__('title.portfolio_group')}}</strong></h4>

                    <a class="btn btn-success btn-sm" href="{{route('portfolio-group.create')}}"><i
                            class="fa fa-plus"></i></a>
                </header>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-separated" id="portfolio_group_table">
                            <thead>
                            <th>#</th>
                            <th>{{__('portfolio.title')}}</th>
                            <th>{{__('portfolio.status')}}</th>
                            <th class="text-right table-actions">{{__('global.action')}}</th>
                            </thead>
                            <tbody>
                                @foreach($portfolio_group as $key => $p)
                                    <tr>
                                        <td>{{++$key}}</td>
                                        <td>{{$p->title}}</td>
                                        <td>{{statusView($p->status)}}</td>
                                        <td class="text-right table-actions">
                                            <a class="table-action hover-primary" href="{{route('portfolio-group.show',[$p->id])}}"><i class="ti-pencil"></i></a>
                                            <button type="button" class="table-action btn btn-pure deleteButton hover-danger" data-id="{{$p->id}}" data-action = "{{route('portfolio-group.destroy',[$p->id])}}" data-table="#portfolio_group_table"><i class="ti-trash"></i></button>
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
