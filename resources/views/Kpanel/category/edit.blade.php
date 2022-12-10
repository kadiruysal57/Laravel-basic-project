@extends('Kpanel.layouts.app')

@section('page-title') {{__('title.category_add')}} @endsection
@section('CssContent')

@endsection

@section('content')

    <div class="main-content">
        <div class="col-12">
            <div class="card">
                <header class="card-header">
                    <h4 class="card-title">{{__('title.category_add')}}</strong></h4>
                </header>
                <div class="card-body">
                    <form id="category_update" action="{{route('category.store')}}"
                          class="form fv-plugins-bootstrap5 fv-plugins-framework">
                        <input type="hidden" name="id" value="update">
                        <input type="hidden" name="category_id" value="{{$category->id}}">
                        <div class="form-group">
                            <label for="title">{{__('category.title')}}</label>
                            <input type="text" class="form-control" id="title" value="{{$category->name}}" name="title"
                                   placeholder="{{__('category.title')}}">
                        </div>
                        <div class="form-group">
                            <label for="description">{{__('category.description')}}</label>
                            <textarea name="description" class="form-control" value="{{$category->description}}" id="description"
                                      placeholder="{{__('category.description')}}"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">{{__('category.status')}}</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">{{__('global.please_select')}}</option>
                                <option @if($category->status == 1) selected="" @endif value="1">{{__('global.active')}}</option>
                                <option @if($category->status == 2) selected="" @endif value="2">{{__('global.passive')}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="contents">{{__('category.contents')}}</label>
                            <select name="contents[]" class="form-control" id="contents" multiple>
                                @foreach($contents as $c)
                                    <option @if(in_array($c->id,$select_array)) selected="" @endif value="{{$c->id}}">{{$c->name}}</option>
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
    <script src="{{asset('panel/assets/js/category/category.js')}}"></script>
@endsection
