@extends('Kpanel.layouts.app')


@section('page-title') {{__('title.gallery_edit')}} @endsection <!-- Sayfa title'ı ayarlanıyor -->

@section('CssContent')
    <style>
        .gallery_image_content img {
            margin-right: 15px;
            max-width: 80px;
            max-height: 80px;
        }
    </style>
@endsection


@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title">{{__('gallery.gallery_edit_page_title')}}</strong></h4>

                    </header>

                    <div class="card-body">
                        <form id="gallery_update" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                              action="{{route('gallery.store')}}">
                            <input type="hidden" name="id" value="update">
                            <input type="hidden" name="gallery_id" value="{{$gallery->id}}">
                            <div class="form-group">
                                <label class="require">{{__('global.name')}}</label>
                                <input class="form-control " value="{{$gallery->name}}" name="name"
                                       placeholder="{{__('global.name')}}"
                                       type="text">
                            </div>

                            <div class="form-group">
                                <label class="require">{{__('global.title')}}</label>
                                <input class="form-control " name="title" value="{{$gallery->title}}"
                                       placeholder="{{__('global.title')}}"
                                       type="text">
                            </div>
                            <div class="form-group">
                                <label class="require">{{__('global.description')}}</label>
                                <textarea name="description" class="form-control"
                                          placeholder="{{__('global.description')}}">{{$gallery->description}}</textarea>
                            </div>
                            <div>
                                <label class="require">{{__('global.status')}}</label>
                                <select name="status" class="form-control">
                                    <option value="">{{__('global.please_select')}}</option>
                                    <option @if($gallery->status == 1) selected=""
                                            @endif value="1">{{__('global.active')}}</option>
                                    <option @if($gallery->status == 1) selected=""
                                            @endif value="2">{{__('global.passive')}}</option>
                                </select>
                            </div>
                            <input type="hidden" value="0" name="gallery_count" class="gallery_count">
                            <table class="table table-separated " id="gallery_image">
                                <thead>
                                <tr>

                                    <th colspan="3" class="text-right w-100px">
                                        <button type="button" class="btn btn-success gallery_image_add"
                                                data-table="#gallery_image" data-action="{{route('gallery.store')}}"><i
                                                class="fa fa-plus"></i></button>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($gallery->gallery_image as $gi)
                                    <tr id="deleteTr{{$gi->id}}">
                                        <td>
                                            <div class='d-flex justify-content-center gallery_image_content' id='gallery_image_contents{{$gi->id}}'>

                                                <div class='float-left' id='holder{{$gi->id}}'>
                                                    <img style='height: 5rem;' src='{{asset($gi->url)}}'>
                                                </div>
                                                <div class='mt-4 mb-4 float-left'>
                                                         <span class='input-group-btn'>
                                                             <a id='lfm{{$gi->id}}' data-input='thumbnail{{$gi->id}}' data-preview='holder{{$gi->id}}'
                                                                class='btn btn-info text-white lfm'>
                                                             <i class='fa fa-picture-o'></i> {{__('global.please_select_image')}}
                                                             </a>
                                                         </span>
                                                </div>
                                                <input id='thumbnail{{$gi->id}}' class='form-control' type='hidden' name='filepath_edits{{$gi->id}}' value='{{$gi->url}}'>
                                            </div>
                                        </td>
                                        <td>
                                            <label>{{__('global.order')}}</label><input name='orders{{$gi->id}}' type='number' value="{{$gi->image_order}}" class='form-control' placeholder='{{__('global.order')}}' min='0'>
                                        </td>
                                        <td>
                                            <div class='d-flex justify-content-center align-items-center' style='height: 75px'><button type='button' class='btn btn-danger deleteGalleryImages' data-action="{{route('gallery.store')}}" data-id='{{$gi->id}}'><i class='fa fa-trash'></i></button></div>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <div class="col-lg-12 col-md-12 col-sm-12 mt-3 float-left text-center">
                                <button type="submit" class="btn btn-w-md btn-round btn-primary "
                                >{{__('global.save')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div><!--/.main-content -->

@endsection

@section('JsContent')
    <script
        src="{{asset('panel/assets/js/gallery/gallery.js')}}"></script>
    <script>
        $('.lfm').filemanager('image');

    </script>
@endsection


