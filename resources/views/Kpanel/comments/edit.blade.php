@extends('Kpanel.layouts.app')


@section('page-title') {{__('comments.comments_page_title')}} @endsection <!-- Sayfa title'ı ayarlanıyor -->

@section('CssContent')
    <!-- Bu sayfaya özel css dosyaları çekilecek -->
@endsection


@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title">{{__('comments.comments_update_title')}}</strong></h4>
                    </header>
                    <div class="card-body">
                        <form id="comments_update" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                              action="{{route('comments.store')}}">

                            <input type="hidden" name="id" value="update">
                            <input type="hidden" name="comments_id" value="{{$comments->id}}">
                            <div class="form-group">
                                <label class="require">{{__('global.name')}}</label>
                                <input class="form-control " name="name" required type="text" value="{{$comments->name}}">
                            </div>
                            <div class="form-group">
                                <label class="require">{{__('global.description')}}</label>
                                <input class="form-control " name="description" required type="text" value="{{$comments->description}}">
                            </div>
                            <div class="form-group">
                                <label class="require">{{__('global.status')}}</label>
                                <select name="status" class="form-control" tabindex="-98">
                                    <option>{{__('global.status')}}</option>
                                    <option @if($comments->status == 1) selected="" @endif value="1">{{__('global.active')}}</option>
                                    <option @if($comments->status == 2) selected="" @endif value="2">{{__('global.passive')}}</option>
                                </select>
                            </div>

                            <input id="Hiddencomments" name="count" type="hidden" value="0"/>
                            <div class="fv-row mb-7 fv-plugins-icon-container text-center">
                                <input type="button" id="commentsbutton"  class="btn btn-primary m-lg-2 commentsbutton" value="{{__('comments.comments_create_title')}}">
                            </div>

                            <div id="comments_feedback">

                                @foreach($comments->comments_many as $sm)

                                    <div id="commentsimage_edit{{$sm->id}}" class="mt-5 bg-light"
                                         style="border-radius:30px; padding: 10px;">

                                        <div class="d-flex">
                                            <div class="col-6">

                                                <div style="height:210px;" class=" d-flex justify-content-center align-items-center" id="holder_edit{{$sm->id}}">
                                                    <img alt="comments-image" style="max-width:200px;" src="">
                                                </div>


                                                <div class="input-group d-grid justify-content-center">
                                                    <div class="d-flex justify-content-center">
                                                         <span class="input-group-btn">
                                                             <a  data-input="thumbnail_edit{{$sm->id}}" data-preview="holder_edit{{$sm->id}}"
                                                                            class="btn btn-primary lfm">
                                                             <i class="fa fa-picture-o"></i>{{__('global.please_select')}}
                                                             </a>
                                                         </span>
                                                    </div>
                                                    <input id="thumbnail_edit{{$sm->id}}" class="form-control" type="hidden" name="filepath_edit{{$sm->id}}" value="">
                                                </div>

                                            </div>



                                            <div class="col-6" style="text-align: -webkit-center">


                                                <div class="fv-row mb-7 fv-plugins-icon-container justify-content-center">
                                                     <label class="fs-6 fw-bold form-label">
                                                         <span>{{__('comments.name')}}</span>
                                                         </label>
                                                     <input type="text" class="form-control form-control w-75 p-3" value="{{$sm->name}}" name="comments_name_edit{{$sm->id}}">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>


                                                <div class="fv-row mb-7 fv-plugins-icon-container justify-content-center">
                                                     <label class="fs-6 fw-bold form-label">
                                                         <span>{{__('comments.comments_job_title')}}</span>
                                                         </label>
                                                    <input type="text" class="form-control form-control w-75 p-3" value="{{$sm->job_title}}" name="comments_job_title_edit{{$sm->id}}">

                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>

                                                <div class="fv-row mb-7 fv-plugins-icon-container ">
                                                    <label class="fs-6 fw-bold form-label ">
                                                        <span>{{__('comments.comments')}}</span>
                                                    </label>
                                                    <input type="text" class="form-control form-control w-75 p-3" value="{{$sm->comments}}" name="comments_edit{{$sm->id}}">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>

                                                <div class="fv-row mb-7 fv-plugins-icon-container w-75">
                                                    <label class="fs-6 fw-bold form-label ">
                                                        <span>{{__('comments.rate')}}</span>
                                                        </label>
                                                    <select name="rate_edit{{$sm->id}}" class="form-control" tabindex="-98">
                                                        <option>{{__('comments.comments_rate_select')}}</option>
                                                        <option @if($sm->rate == 5) selected @endif value="5">5</option>
                                                        <option @if($sm->rate == 4.5) selected @endif value="4.5">4.5</option>
                                                        <option @if($sm->rate == 4) selected @endif value="4">4</option>
                                                        <option @if($sm->rate == 3.5) selected @endif value="3.5">3.5</option>
                                                        <option @if($sm->rate == 3) selected @endif value="3">3</option>
                                                        </select>

                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                    </div>

                                            </div>





                                        </div>
                                    </div>
                                @endforeach

                            </div>


                            <div class="text-center mt-2">
                                <button type="submit" class="btn btn-w-md btn-round btn-primary " form="comments_update">{{__('global.save')}}</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('JsContent')


    <script src="{{asset('panel/assets/js/comments/comments.js')}}"></script>
    <script src="{{asset('panel/assets/js/comments/comments_create.js')}}"></script>
    <script>
        $('.lfm').filemanager('image');
    </script>
    <script src="{{asset('panel/assets/vendor/chartjs/Chart.min.js')}}"></script>

@endsection



