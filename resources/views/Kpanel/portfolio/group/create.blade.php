@extends('Kpanel.layouts.app')

@section('page-title') {{__('title.portfolio_group_add')}} @endsection
@section('CssContent')

@endsection

@section('content')

    <div class="main-content">
        <div class="col-12">
            <div class="card">
                <header class="card-header">
                    <h4 class="card-title">{{__('title.portfolio_group_add')}}</strong></h4>
                </header>
                <div class="card-body">
                    <form id="portfolio_group_create" action="{{route('portfolio-group.store')}}"
                          class="form fv-plugins-bootstrap5 fv-plugins-framework">
                        <input type="hidden" name="id" value="create">

                        <div class="form-group">
                            <label for="title">{{__('portfolio.title')}}</label>
                            <input type="text" class="form-control" id="title" name="title"
                                   placeholder="{{__('portfolio.title')}}">
                        </div>
                        <div class="form-group">
                            <label for="status">{{__('portfolio.status')}}</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">{{__('global.please_select')}}</option>
                                <option value="1">{{__('global.active')}}</option>
                                <option value="2">{{__('global.passive')}}</option>
                            </select>
                        </div>

                        <div class="form-group text-right">
                            <button type="button" data-table="#portfolio_image_table" data-action="{{route('portfolio-group.store')}}" class="btn btn-success btn-sm add_portfolio_image"><i class="fa fa-plus"></i></button>
                            <input type="hidden" name="count" class="count" value="1">
                        </div>

                        <div class="table-responsive">
                            <table class="table table-separated" id="portfolio_image_table">
                                <thead>
                                <th>#</th>
                                <th>{{__('portfolio.image')}}</th>
                                <th>{{__('portfolio.title')}}</th>
                                <th>{{__('portfolio.description')}}</th>
                                <th>{{__('portfolio.alt_title')}}</th>
                                <th>{{__('portfolio.order')}}</th>
                                <th class="text-right table-actions">{{__('global.action')}}</th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit"
                                    class="btn btn-w-md btn-round btn-primary ">{{__('global.save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('JsContent')
    <script src="{{asset('panel/assets/js/portfolio/portfolio_group.js')}}"></script>
@endsection
