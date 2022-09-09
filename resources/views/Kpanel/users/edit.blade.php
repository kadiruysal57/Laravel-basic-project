@extends('Kpanel.layouts.app')


@section('page-title') Contents @endsection <!-- Sayfa title'ı ayarlanıyor -->

@section('CssContent')

@endsection


@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <header class="card-header">
                        <h4 class="card-title">{{__('users.add_user')}}</strong></h4>
                    </header>
                    <div class="card-body">

                        <form id="users_edit" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                              action="{{route('users.store')}}">
                            <input type="hidden" name="id" value="update">
                            <input type="hidden" name="user_id" value="{{$user->id}}">

                            <div class="form-group">
                                <label for="user_name">{{__('users.user_name')}}</label>
                                <input type="text" id="user_name" name="user_name" class="form-control" value="{{$user->name}}" placeholder="{{__('users.user_name')}}">
                            </div>

                            <div class="form-group">
                                <label for="email">{{__('users.email')}}</label>
                                <input type="email" id="email" name="email" class="form-control"  value="{{$user->email}}" placeholder="{{__('users.email')}}">
                            </div>

                            <div class="form-group">
                                <label for="status">{{__('users.status')}}</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">{{__('users.please_select')}}</option>
                                    <option @if($user->status == 1) selected="" @endif value="1">{{__('users.active')}}</option>
                                    <option @if($user->status == 2) selected="" @endif value="2">{{__('users.passive')}}</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="password">{{__('users.password')}}</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="{{__('users.password')}}">
                            </div>

                            <div class="form-group">
                                <label for="password_same">{{__('users.password_same')}}</label>
                                <input type="password" id="password" name="password_same" class="form-control" placeholder="{{__('users.password_same')}}">
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 mt-3 float-left text-center">
                                <button type="submit" class="btn btn-w-md btn-round btn-primary "
                                        form="users_edit">{{__('global.save')}}</button>
                            </div>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    </div><!--/.main-content -->
@endsection

@section('JsContent')
    <script src="{{asset('panel/assets/js/users/users.js')}}"></script>

@endsection


