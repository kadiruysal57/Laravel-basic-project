@extends('Kpanel.layouts.app')

@section('page-title') {{__('faq.faq_create')}} @endsection
@section('CssContent')

@endsection

@section('content')

    <div class="main-content">
        <div class="col-12">
            <div class="card">
                <header class="card-header">
                    <h4 class="card-title">{{__('faq.faq_create')}}</strong></h4>
                </header>
                <div class="card-body">
                    <form id="faq_create" action="{{route('faq.store')}}" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                        <input type="hidden" value="create" name="id">
                        <div class="form-group">
                            <label for="title">{{__('faq.title')}}</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="{{__('faq.title')}}">
                        </div>
                        <div class="form-group">
                            <label for="description">{{__('faq.description')}}</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="{{__('faq.description')}}">
                        </div>
                        <div class="form-group">
                            <label for="status">{{__('faq.status')}}</label>
                            <select name="status" class="form-control" id="status">
                                <option value="">{{__('global.please_select')}}</option>
                                <option value="1">{{__('global.active')}}</option>
                                <option value="1">{{__('global.passive')}}</option>
                            </select>
                        </div>
                        <div class="form-group text-right">
                            <button type="button" class="btn btn-success btn-sm add_faq_new" data-action="{{route('faq.store')}}" data-table="#faq_table"><i class="fa fa-plus"></i></button>
                        </div>
                        <input type="hidden" class="count" name="count" value="1">
                        <div class="table-responsive">
                            <table class="table table-separated" id="faq_table">
                                <thead>
                                    <th>{{__('faq.question')}}</th>
                                    <th>{{__('faq.answer')}}</th>
                                    <th class="text-right table-actions">{{__('global.action')}}</th>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-w-md btn-round btn-primary ">{{__('global.save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('JsContent')
    <script src="{{asset('panel/assets/js/faq/faq.js')}}"></script>
@endsection
