<header class="sidebar-header bg-info">
        <span class="logo">
          <a href="{{route('dashboard')}}"><img src="{{asset('panel/assets/img/logo-light.png')}}" alt="logo"></a>
        </span>
    <span class="sidebar-toggle-fold"></span>
</header>

<nav class="sidebar-navigation ps-container ps-theme-default" data-ps-id="0664ac42-8a4a-9a44-9c66-9a141163124b">
    <ul class="menu menu-sm menu-bordery">

        <li class="menu-item @if(Illuminate\Support\Facades\Route::getCurrentRoute()->getName() == "dashboard") active @endif">
            <a class="menu-link" href="{{route('dashboard')}}">
                <span class="icon ti-home"></span>
                <span class="title">Dashboard</span>
            </a>
        </li>

        <li class="menu-item @if(strpos(Illuminate\Support\Facades\Route::getCurrentRoute()->getName(),"users") !== false) active @endif">
            <a class="menu-link" href="{{route('users.index')}}">
                <span class="icon fa fa-users"></span>
                <span class="title">{{__('global.users')}}</span>
            </a>
        </li>


        <li class="menu-item @if(strpos(Illuminate\Support\Facades\Route::getCurrentRoute()->getName(),"language") !== false) active @endif">
            <a class="menu-link" href="{{route('language.index')}}">
                <span class="icon fa fa-language"></span>
                <span class="title">{{__('global.language')}}</span>
            </a>
        </li>
        <li class="menu-item @if(strpos(Illuminate\Support\Facades\Route::getCurrentRoute()->getName(),'menu') !== false) active @endif">
            <a class="menu-link" href="{{route('menu.index')}}">
                <span class="icon fa fa-bars"></span>
                <span class="title">{{__('global.menu')}}</span>
            </a>
        </li>
        <li class="menu-item @if(strpos(Illuminate\Support\Facades\Route::getCurrentRoute()->getName(),'blok-management') !== false) active @endif">
            <a class="menu-link" href="{{route('blok-management.index')}}">
                <span class="icon fa fa-th"></span>
                <span class="title">{{__('blokmanagement.index')}}</span>
            </a>
        </li>
        <li class="menu-item=">
            <span style="cursor: pointer" onclick="window.open('{{url('laravel-filemanager')}}','', 'width=700,height=700'); " class="menu-link">
                <span class="icon fa fa-file"></span>
                <span class="title">{{__('global.file-manager')}}</span>
            </span>
        </li>


        <li class="menu-item @if(strpos(Illuminate\Support\Facades\Route::getCurrentRoute()->getName(),'contents') !== false) active @endif">
            <a class="menu-link" href="{{route('contents.index')}}">
                <span class="icon fa fa-file-o"></span>
                <span class="title">{{__('contents.contents_page_title')}}</span>
            </a>
        </li>


        <li class="menu-item">
            <a class="menu-link" href="{{route('slider.index')}}">
                <span class="icon fa fa-file-image-o"></span>
                <span class="title">{{__('slider.slider_page_title')}}</span>
            </a>
        </li>


        <li class="menu-item @if(strpos(Illuminate\Support\Facades\Route::getCurrentRoute()->getName(),'site-settings') !== false) active @endif">
            <a class="menu-link" href="{{route('site-settings.index')}}">
                <span class="icon fa fa-gear"></span>
                <span class="title">{{__('sitesettings.sitesettings')}}</span>
            </a>
        </li>



    </ul>
    <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
        <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
    </div>
    <div class="ps-scrollbar-y-rail" style="top: 0px; right: 2px;">
        <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div>
    </div>
</nav>
