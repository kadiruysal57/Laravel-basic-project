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

                        <form id="users_create" class="form fv-plugins-bootstrap5 fv-plugins-framework"
                              action="{{route('users.store')}}">
                            <input type="hidden" name="id" value="create">

                            <div class="form-group">
                                <label for="user_name">{{__('users.user_name')}}</label>
                                <input type="text" id="user_name" name="user_name" class="form-control" placeholder="{{__('users.user_name')}}">
                            </div>

                            <div class="form-group">
                                <label for="email">{{__('users.email')}}</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="{{__('users.email')}}">
                            </div>

                            <div class="form-group">
                                <label for="status">{{__('users.status')}}</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="">{{__('users.please_select')}}</option>
                                    <option value="1">{{__('users.active')}}</option>
                                    <option value="2">{{__('users.passive')}}</option>
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
                                        form="users_create">{{__('global.save')}}</button>
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


