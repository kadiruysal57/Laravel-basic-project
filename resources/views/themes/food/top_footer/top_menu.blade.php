<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

        <a href="{{url('/')}}" class="logo d-flex align-items-center me-auto me-lg-0">
            @if(!empty($site_setting->logo))
                <img src="{{asset($site_setting->logo)}}" alt="{{$site_setting->site_name}}">
            @else
                <h1>{{$site_setting->site_name}}<span>.</span></h1>
            @endif

        </a>

        <nav id="navbar" class="navbar">
            <ul>
                @foreach($menu_top->menu_item_top as $m)
                    {!! $menu_item_model->yummyMenu($m) !!}
                @endforeach
                <li class='dropdown language-dropdown'>
                    <a href="">{{strtoupper(getLangName(getLangId($active_lang)))}}</a>
                    <ul>
                        @foreach($languages as $la)
                            @if($la->slug != $active_lang)
                            <li>
                                @if($la->main_language == 1)
                                    <a href="{{url('/')}}">{{strtoupper($la->short_name)}}</a>
                                @else
                                    <a href="{{url('/'.$la->slug)}}">{{strtoupper($la->short_name)}}</a>
                                @endif

                            </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            </ul>
        </nav>
        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
</header>
