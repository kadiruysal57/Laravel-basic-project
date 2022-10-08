@extends('Kpanel.layouts.app')


@section('page-title') {{__('staff.staff_page_title')}} @endsection <!-- Sayfa title'ı ayarlanıyor -->

@section('CssContent')
    <!-- Bu sayfaya özel css dosyaları çekilecek -->
@endsection


@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title">{{__('staff.staff_update_title')}}</strong></h4>
                    </header>
                    <div class="card-body">
                        <form id="staff_update" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                              action="{{route('staff.store')}}">

                            <input type="hidden" name="id" value="update">
                            <input type="hidden" name="staff_id" value="{{$staff->id}}">
                            <div class="form-group">
                                <label class="require">{{__('global.name')}}</label>
                                <input class="form-control " name="name" required type="text" value="{{$staff->name}}">
                            </div>
                            <div class="form-group">
                                <label class="require">{{__('global.description')}}</label>
                                <input class="form-control " name="description" required type="text" value="{{$staff->description}}">
                            </div>
                            <div class="form-group">
                                <label class="require">{{__('global.status')}}</label>
                                <select name="status" class="form-control" tabindex="-98">
                                    <option>{{__('global.status')}}</option>
                                    <option @if($staff->status == 1) selected="" @endif value="1">{{__('global.active')}}</option>
                                    <option @if($staff->status == 2) selected="" @endif value="2">{{__('global.passive')}}</option>
                                </select>
                            </div>

                            <input id="HiddenStaff" name="count" type="hidden" value="0"/>
                            <div class="fv-row mb-7 fv-plugins-icon-container text-center">
                                <input type="button" id="staffbutton"  class="btn btn-primary m-lg-2 staffbutton" value="{{__('staff.staff_create_title')}}">
                            </div>

                            <div id="staff_feedback">

                                @foreach($staff->staff_many as $st)

                                    <div id="staffimage_edit{{$st->id}}" class="mt-5 bg-light"
                                         style="border-radius:30px; padding: 10px;">

                                        <div class="d-flex">
                                            <div class="col-6">

                                                <div style="height:210px;" class=" d-flex justify-content-center align-items-center" id="holder{{$st->id}}">
                                                    <img alt="staff-image" style="max-width:200px;" src="{{$st->url}}">
                                                </div>


                                                <div class="input-group d-grid justify-content-center">
                                                    <div class="d-flex justify-content-center">
                                                         <span class="input-group-btn">
                                                             <a id="lfm{{$st->id}}" data-input="thumbnail{{$st->id}}" data-preview="holder{{$st->id}}"
                                                                            class="btn btn-primary lfm">
                                                             <i class="fa fa-picture-o"></i>{{__('global.please_select')}}
                                                             </a>
                                                         </span>
                                                    </div>
                                                    <input id="thumbnail{{$st->id}}" class="form-control" type="hidden" name="filepath_edit{{$st->id}}" value="">
                                                </div>

                                            </div>



                                            <div class="col-6" style="text-align: -webkit-center">


                                                <div class="fv-row mb-7 fv-plugins-icon-container justify-content-center">
                                                     <label class="fs-6 fw-bold form-label">
                                                         <span>{{__('global.name')}}</span>
                                                         </label>
                                                     <input type="text" class="form-control form-control w-75 p-3" value="{{$st->name}}" name="staff_name_edit{{$st->id}}">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>


                                                <div class="fv-row mb-7 fv-plugins-icon-container justify-content-center">
                                                     <label class="fs-6 fw-bold form-label">
                                                         <span>{{__('staff.staff_title')}}</span>
                                                         </label>
                                                    <input type="text" class="form-control form-control w-75 p-3" value="{{$st->staff_title}}" name="staff_title_edit{{$st->id}}">

                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>

                                                <div class="fv-row mb-7 fv-plugins-icon-container ">
                                                    <label class="fs-6 fw-bold form-label ">
                                                        <span>{{__('global.description')}}</span>
                                                    </label>
                                                    <input type="text" class="form-control form-control w-75 p-3" value="{{$st->description}}" name="staff_desc_edit{{$st->id}}">
                                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                                </div>

                                            </div>





                                        </div>
                                    </div>
                                @endforeach

                            </div>


                            <div class="text-center mt-2">
                                <button type="submit" class="btn btn-w-md btn-round btn-primary " form="staff_update">{{__('global.save')}}</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('JsContent')
    <script>
        $('.lfm').filemanager('image');
    </script>

    <script src="{{asset('panel/assets/js/staff/staff.js')}}"></script>
    <script src="{{asset('panel/assets/js/staff/staff_create.js')}}"></script>
    <script src="{{asset('panel/assets/vendor/chartjs/Chart.min.js')}}"></script>

@endsection



