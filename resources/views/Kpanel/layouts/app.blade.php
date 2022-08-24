<html lang="en">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="TheAdmin - Responsive admin and web application ui kit">
    <meta name="keywords" content="admin, dashboard, web app, sass, ui kit, ui framework, bootstrap">

    <title>@yield('page-title') - KPanel</title>

    <!-- Styles -->
    <link href="{{asset('panel/assets/css/core.min.css')}}" rel="stylesheet">
    <link href="{{asset('panel/assets/vendor/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('panel/assets/vendor/bootstrap-select/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{asset('panel/assets/css/app.min.css')}}" rel="stylesheet">
    <link href="{{asset('panel/assets/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset("panel/assets/css/toastify.css")}}" type="text/css" />

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{asset('panel/assets/img/apple-touch-icon.png')}}">
    <link rel="icon" href="{{asset('panel/assets/img/favicon.png')}}">

    @yield('CssContent')

    <style type="text/css">/* Chart.js */
        @-webkit-keyframes chartjs-render-animation {
            from {
                opacity: 0.99
            }
            to {
                opacity: 1
            }
        }

        @keyframes chartjs-render-animation {
            from {
                opacity: 0.99
            }
            to {
                opacity: 1
            }
        }

        .chartjs-render-monitor {
            -webkit-animation: chartjs-render-animation 0.001s;
            animation: chartjs-render-animation 0.001s;
        }</style>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

</head>

<body class="pace-done sidebar-folded">
<div class="pace  pace-inactive">
    <div class="pace-progress" data-progress-text="100%" data-progress="99" style="width: 100%;">
        <div class="pace-progress-inner"></div>
    </div>
    <div class="pace-activity"></div>
</div>


<!-- Preloader -->
<div class="preloader" style="display: block;">
    <div class="spinner-dots spinner-dots min-h-fullscreen center-vh mx-auto">
        <span class="dot1"></span>
        <span class="dot2"></span>
        <span class="dot3"></span>
    </div>
</div>


<!-- Sidebar -->
<aside class="sidebar sidebar-expand-lg sidebar-light sidebar-sm sidebar-color-info">

    @include('Kpanel.layouts.aside')
</aside>
<!-- END Sidebar -->


<!-- Topbar -->
<header class="topbar">
    @include('Kpanel.layouts.topbar')
</header>
<!-- END Topbar -->


<!-- Main container -->
<main class="main-container">

    @yield('content')

    <!-- Footer -->
    <footer class="site-footer">
        <div class="row">
            <div class="col-md-6">
                <p class="text-center text-md-left">Copyright © 2019 <a href="http://thetheme.io/theadmin">TheAdmin</a>.
                    All rights reserved.</p>
            </div>

            <div class="col-md-6">
                <ul class="nav nav-primary nav-dotted nav-dot-separated justify-content-center justify-content-md-end">
                    <li class="nav-item">
                        <a class="nav-link" href="../help/articles.html">Documentation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../help/faq.html">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="../../../item/theadmin-responsive-bootstrap-4-admin-dashboard-webapp-template/20475359.html?license=regular&amp;open_purchase_for_item_id=20475359&amp;purchasable=source&amp;ref=thethemeio">Purchase
                            Now</a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
    <!-- END Footer -->

</main>
<!-- END Main container -->


<script src="{{asset('panel/assets/js/core.min.js')}}"></script>
<script src="{{asset('panel/assets/js/app.min.js')}}"></script>
<!-- Scripts -->
<script
    src="{{asset('panel/assets/vendor/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
<script
    src="{{asset('panel/assets/vendor/moment/moment.min.js')}}"></script>
<script src="{{asset('panel/assets/js/toastify.js')}}"></script>

<script src="{{asset('panel/assets/js/script.js')}}"></script>

@yield('JsContent')
</body>
</html>
