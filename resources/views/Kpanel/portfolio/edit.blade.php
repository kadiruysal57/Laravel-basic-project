@extends('Kpanel.layouts.app')

@section('page-title') {{__('title.portfolio_add')}} @endsection
@section('CssContent')

@endsection

@section('content')

    <div class="main-content">
        <div class="col-12">
            <div class="card">
                <header class="card-header">
                    <h4 class="card-title">{{__('title.portfolio_add')}}</strong></h4>
                </header>
                <div class="card-body">
                    <form id="portfolio_update" action="{{route('portfolio.store')}}"
                          class="form fv-plugins-bootstrap5 fv-plugins-framework">
                        <input type="hidden" name="id" value="update">
                        <input type="hidden" name="portfolio_id" value="{{$portfolio->id}}" >
                        <div class="form-group">
                            <label for="title">{{__('portfolio.title')}}</label>
                            <input type="text" class="form-control" id="title" name="title"
                                   placeholder="{{__('portfolio.title')}}" value="{{$portfolio->title}}">
                        </div>
                        <div class="form-group">
                            <label for="description">{{__('portfolio.description')}}</label>
                            <textarea name="description" class="form-control" id="description" placeholder="{{__('portfolio.description')}}">{{$portfolio->description}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">{{__('portfolio.status')}}</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">{{__('global.please_select')}}</option>
                                <option @if($portfolio->status == 1) selected="" @endif value="1">{{__('global.active')}}</option>
                                <option @if($portfolio->status == 2) selected="" @endif value="2">{{__('global.passive')}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="portfolio_groups">{{__('portfolio.portfolio_groups')}}</label>
                            <select name="portfolio_groups[]" class="form-control" id="portfolio_groups" multiple>
                                @foreach($portfolio_group as $pg)
                                    <option @if(in_array($pg->id,$select_array)) selected="" @endif value="{{$pg->id}}">{{$pg->title}}</option>
                                @endforeach
                            </select>
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
    <script src="{{asset('panel/assets/js/portfolio/portfolio.js')}}"></script>
@endsection
