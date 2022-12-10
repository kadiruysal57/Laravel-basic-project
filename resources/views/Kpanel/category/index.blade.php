@extends('Kpanel.layouts.app')

@section('page-title') {{__('title.category')}} @endsection
@section('CssContent')

@endsection

@section('content')

    <div class="main-content">
        <div class="col-12">
            <div class="card">
                <header class="card-header">
                    <h4 class="card-title">{{__('title.category')}}</strong></h4>

                    <a class="btn btn-success btn-sm" href="{{route('category.create')}}"><i
                            class="fa fa-plus"></i></a>
                </header>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-separated dataTables" id="category_table">
                            <thead>
                            <th>{{__('portfolio.title')}}</th>
                            <th>{{__('portfolio.description')}}</th>
                            <th>{{__('portfolio.status')}}</th>
                            <th class="text-right table-actions">{{__('global.action')}}</th>
                            </thead>
                            <tbody>
                            @foreach($category as $key => $c)
                                <tr>
                                    <td>
                                        {{$c->name}}
                                    </td>
                                    <td>
                                        {{$c->description}}
                                    </td>
                                    <td>
                                        {{statusView($c->status)}}
                                    </td>
                                    <td class="text-right table-actions">
                                        <a class="table-action hover-primary" href="{{route('category.show',[$c->id])}}"><i class="ti-pencil"></i></a>
                                        <button type="button" class="table-action btn btn-pure deleteButton hover-danger" data-id="{{$c->id}}" data-action = "{{route('category.destroy',[$c->id])}}" data-table="#category_table"><i class="ti-trash"></i></button>
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
