<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Flatkit - HTML Version | Bootstrap 4 Web App Kit with AngularJS</title>
    <meta name="description" content="Admin, Dashboard, Bootstrap, Bootstrap 4, Angular, AngularJS" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- for ios 7 style, multi-resolution icon of 152x152 -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
    <link rel="apple-touch-icon" href="{{asset('panel/assets/images/logo.png')}}">
    <meta name="apple-mobile-web-app-title" content="Flatkit">
    <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="shortcut icon" sizes="196x196" href="{{asset('panel/assets/images/logo.png')}}">

    <!-- style -->
    <link rel="stylesheet" href="{{asset("panel/assets/animate.css/animate.min.css")}}" type="text/css" />
    <link rel="stylesheet" href="{{asset("panel/assets/glyphicons/glyphicons.css")}}" type="text/css" />
    <link rel="stylesheet" href="{{asset("panel/assets/font-awesome/css/font-awesome.min.css")}}" type="text/css" />
    <link rel="stylesheet" href="{{asset("panel/assets/material-design-icons/material-design-icons.css")}}" type="text/css" />

    <link rel="stylesheet" href="{{asset("panel/assets/bootstrap/dist/css/bootstrap.min.css")}}" type="text/css" />
    <link rel="stylesheet" href="{{asset("panel/assets/styles/app.min.css")}}">
    <link rel="stylesheet" href="{{asset("panel/assets/styles/font.css")}}" type="text/css" />
    <link rel="stylesheet" href="{{asset("panel/assets/styles/style.css")}}" type="text/css" />
    <link rel="stylesheet" href="{{asset("panel/assets/styles/toastify.css")}}" type="text/css" />

    <meta name="csrf-token" content="{{ csrf_token() }}"/>

</head>
<body class="overflow-hidden">
<div class="loader_body" >
    <div class="loader"></div>
</div>
<div class="app" id="app">

    <!-- ############ LAYOUT START-->
    <div class="center-block w-xxl w-auto-xs p-y-md">

        <div class="p-a-md box-color r box-shadow-z1 text-color m-a">
            <div class="m-b text-sm">
                Sign up to your Flatkit Account
            </div>
            <form id="sing-up-form" action="{{route('sign_up_post')}}">
                <div class="md-form-group">
                    <input type="text" name="name"  class="md-input" required>
                    <label>Name</label>
                </div>
                <div class="md-form-group">
                    <input type="email" name="email" class="md-input" required>
                    <label>Email</label>
                </div>
                <div class="md-form-group">
                    <input type="password" name="password" class="md-input" required>
                    <label>Password</label>
                </div>
                <div class="md-form-group">
                    <input type="password" name="password_confirmation" class="md-input" required>
                    <label>Password Confirmation</label>
                </div>
                <div class="m-b-md">
                    <label class="md-check">
                        <input type="checkbox" name="term_and_policy" required><i class="primary"></i> Agree the <a href>terms and policy</a>
                    </label>
                </div>
                <button type="submit" class="btn primary btn-block p-x-md">Sign up</button>
            </form>
        </div>

        <div class="p-v-lg text-center">
            <div>Already have an account? <a ui-sref="access.signin" href="{{route('sign_in')}}" class="text-primary _600">Sign in</a></div>
        </div>
    </div>

    <!-- ############ LAYOUT END-->

</div>

<script src="{{asset("panel/assets/scripts/app.html.js")}}"></script>
<script src="{{asset("panel/assets/scripts/toastify.js")}}"></script>
<script src="{{asset("panel/assets/scripts/authentication/signup.js")}}"></script>

</body>
</html>
