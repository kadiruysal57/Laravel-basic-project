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
                    <form id="category_create" action="{{route('category.store')}}"
                          class="form fv-plugins-bootstrap5 fv-plugins-framework">
                        <input type="hidden" name="id" value="create">

                        <div class="form-group">
                            <label for="title">{{__('category.title')}}</label>
                            <input type="text" class="form-control" id="title" name="title"
                                   placeholder="{{__('category.title')}}">
                        </div>
                        <div class="form-group">
                            <label for="description">{{__('category.description')}}</label>
                            <textarea name="description" class="form-control" id="description"
                                      placeholder="{{__('category.description')}}"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">{{__('category.status')}}</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">{{__('global.please_select')}}</option>
                                <option value="1">{{__('global.active')}}</option>
                                <option value="2">{{__('global.passive')}}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="contents">{{__('category.contents')}}</label>
                            <select name="contents[]" class="form-control" id="contents" multiple>
                                @foreach($contents as $c)
                                    <option value="{{$c->id}}">{{$c->name}}</option>
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
