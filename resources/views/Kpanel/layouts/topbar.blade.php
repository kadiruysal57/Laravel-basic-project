
<div class="topbar-left">

</div>

<div class="topbar-right">

    <ul class="topbar-btns">
        <li class="dropdown">
                <span class="topbar-btn" data-toggle="dropdown"><img class="avatar"
                                                                     src="{{asset('panel/assets/img/logo-thetheme.png')}}"
                                                                     alt="..."></span>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#"><i class="ti-user"></i> {{__('global.profile')}}</a>
                <a class="dropdown-item" href="#"><i class="ti-settings"></i> {{__('formbuilder.formbuilder_settings')}}</a>
                <a class="dropdown-item" href="#"><i class="ti-help"></i> {{__('global.help')}}</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{route('logout')}}"><i class="ti-power-off"></i> {{__('global.logout')}}</a>
            </div>
        </li>
    </ul>


</div>
