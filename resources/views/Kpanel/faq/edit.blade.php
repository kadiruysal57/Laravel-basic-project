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
                    <form id="faq_edit" action="{{route('faq.store')}}" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                        <input type="hidden" value="update" name="id">
                        <input type="hidden" value="{{$faq->id}}" name="faq_id">
                        <div class="form-group">
                            <label for="title">{{__('faq.title')}}</label>
                            <input type="text" value="{{$faq->title}}" class="form-control" id="title" name="title" placeholder="{{__('faq.title')}}">
                        </div>
                        <div class="form-group">
                            <label for="description">{{__('faq.description')}}</label>
                            <input type="text" value="{{$faq->description}}" class="form-control" id="description" name="description" placeholder="{{__('faq.description')}}">
                        </div>
                        <div class="form-group">
                            <label for="status">{{__('faq.status')}}</label>
                            <select name="status" class="form-control" id="status">
                                <option value="">{{__('global.please_select')}}</option>
                                <option @if($faq->status == 1) selected='' @endif value="1">{{__('global.active')}}</option>
                                <option @if($faq->status == 2) selected='' @endif value="1">{{__('global.passive')}}</option>
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
                                    @foreach($faq->faq as $f)
                                        <tr id="faqs{{$f->id}}">
                                            <td>
                                                <input id='faqs_td{{$f->id}}' type="text" class="form-control" name="questions{{$f->id}}" value="{{$f->question}}" placeholder="{{__('faq.question')}}">
                                            </td>
                                            <td>
                                                <textarea name="answers{{$f->id}}" class="form-control" placeholder="{{__('faq.answer')}}">{{$f->answer}}</textarea>
                                            </td>
                                            <td class="text-right table-actions">
                                                <button type="button" class="btn btn-danger mt-2 btn-sm deleteButtonFaq " data-id="{{$f->id}}" data-action = "{{route('faq.store')}}" data-table="#faq_table"><i class="ti-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
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
