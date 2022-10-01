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
                    <form id="portfolio_group_update" action="{{route('portfolio-group.store')}}"
                          class="form fv-plugins-bootstrap5 fv-plugins-framework">
                        <input type="hidden" name="id" value="update">
                        <input type="hidden" name="portfolio_group_id" value="{{$portfolio_group->id}}">
                        <div class="form-group">
                            <label for="title">{{__('portfolio.title')}}</label>
                            <input type="text" class="form-control" id="title" name="title"
                                   placeholder="{{__('portfolio.title')}}" value="{{$portfolio_group->title}}">
                        </div>
                        <div class="form-group">
                            <label for="status">{{__('portfolio.status')}}</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">{{__('global.please_select')}}</option>
                                <option @if($portfolio_group->status == 1) selected=""
                                        @endif value="1">{{__('global.active')}}</option>
                                <option @if($portfolio_group->status == 2) selected=""
                                        @endif value="2">{{__('global.passive')}}</option>
                            </select>
                        </div>

                        <div class="form-group text-right">
                            <button type="button" data-table="#portfolio_image_table"
                                    data-action="{{route('portfolio-group.store')}}"
                                    class="btn btn-success btn-sm add_portfolio_image"><i class="fa fa-plus"></i>
                            </button>
                            <input type="hidden" name="count" class="count" value="1">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-separated" id="portfolio_image_table">
                                <thead>
                                <th>#</th>
                                <th>{{__('portfolio.image')}}</th>
                                <th>{{__('portfolio.title')}}</th>
                                <th>{{__('portfolio.description')}}</th>
                                <th>{{__('portfolio.order')}}</th>
                                <th class="text-right table-actions">{{__('global.action')}}</th>
                                </thead>
                                <tbody>
                                @foreach($portfolio_group->image as $im)
                                    <tr id="ImageTr{{$im->id}}">
                                        <td>
                                            <div id="portfolio_image_holders{{$im->id}}" class="image-content">
                                                <img src="{{asset($im->image_url)}}"
                                                     class="portfolio_image_holders{{$im->id}}" width="32px"
                                                     height="32px" alt="">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="input-group">
                                                                                   <span class="input-group-btn">
                                                                                     <a id="portfolio_images{{$im->id}}"
                                                                                        data-input="portfolio_image_inputs{{$im->id}}"
                                                                                        data-preview="portfolio_image_holders{{$im->id}}"
                                                                                        class="btn btn-primary lfm">
                                                                                       <i class="fa fa-picture-o"></i> {{__('global.please_select_image')}}
                                                                                     </a>
                                                                                   </span>
                                                <input id="portfolio_image_inputs{{$im->id}}" class="form-control portfolio_image"
                                                       type="text" name="portfolio_image_inputs{{$im->id}}" readonly="" value="{{$im->image_url}}">
                                            </div>
                                        </td>
                                        <td>
                                            <input type='text' class='form-control' name='image_titles{{$im->id}}' value="{{$im->title}}" placeholder='{{__('portfolio.title')}}'>
                                        </td>
                                        <td>
                                            <textarea class='form-control' name='image_descriptions{{$im->id}}' placeholder='{{__('portfolio.description')}}'>{{$im->description}}</textarea>
                                        </td>
                                        <td>
                                            <input type='number' class='form-control' name='image_orders{{$im->id}}' placeholder='{{__('portfolio.order')}}' value="{{$im->image_order}}">
                                        </td>
                                        <td class="text-right table-actions">
                                            <button type='button' class='btn btn-danger btn-sm deleteButtonImage mt-2' data-table="#portfolio_image_table" data-id='{{$im->id}}' data-action="{{route('portfolio-group.store')}}"><i class='fa fa-trash'></i></button>
                                        </td>
                                    </tr>
                                @endforeach
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
