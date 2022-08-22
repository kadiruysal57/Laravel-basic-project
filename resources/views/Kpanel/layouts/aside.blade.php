<header class="sidebar-header bg-info">
        <span class="logo">
          <a href="{{route('dashboard')}}"><img src="{{asset('panel/assets/img/logo-light.png')}}" alt="logo"></a>
        </span>
    <span class="sidebar-toggle-fold"></span>
</header>

<nav class="sidebar-navigation ps-container ps-theme-default" data-ps-id="0664ac42-8a4a-9a44-9c66-9a141163124b">
    <ul class="menu menu-sm menu-bordery">

        <li class="menu-item active">
            <a class="menu-link" href="{{route('dashboard')}}">
                <span class="icon ti-home"></span>
                <span class="title">Dashboard</span>
            </a>
        </li>

        <li class="menu-item">
            <a class="menu-link" href="clients.html">
                <span class="icon ti-user"></span>
                <span class="title">Clients</span>
            </a>
        </li>

        <li class="menu-item">
            <a class="menu-link" href="products.html">
                <span class="icon ti-briefcase"></span>
                <span class="title">Products</span>
            </a>
        </li>

        <li class="menu-item">
            <a class="menu-link" href="invoices.html">
                <span class="icon ti-receipt"></span>
                <span class="title">Invoices</span>
                <span class="badge badge-pill badge-info">2</span>
            </a>
        </li>

        <li class="menu-item">
            <a class="menu-link" href="settings.html">
                <span class="icon ti-settings"></span>
                <span class="title">Settings</span>
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
