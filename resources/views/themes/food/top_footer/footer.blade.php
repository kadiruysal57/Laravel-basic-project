<footer id="footer" class="footer">

    <div class="container">
        <div class="row gy-3">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="row gy-3">
                    <div class="col-lg-6 col-md-6 d-flex">
                        <i class="bi bi-geo-alt icon"></i>
                        <div>
                            <h4>{{getFixedWord('address',$active_lang)}}</h4>
                            @foreach(getAllAddress() as $address)
                                <p>
                                    {{$address}}<br>
                                </p>
                            @endforeach
                        </div>

                    </div>

                    <div class="col-lg-6 col-md-6 footer-links d-flex">
                        <i class="bi bi-telephone icon"></i>
                        <div>
                            <h4>{{getFixedWord('reservations',$active_lang)}}</h4>
                            <p>
                                @foreach(getAllPhone() as $e)
                                    <strong>{{getFixedWord('reservations',$active_lang)}}:</strong> {{$e}}<br>
                                @endforeach

                                @foreach(getAllEmail() as $e)
                                    <strong>{{getFixedWord('email',$active_lang)}}:</strong> {{$e}}<br>
                                @endforeach
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 footer-links d-flex">
                        <i class="bi bi-clock icon"></i>
                        <div>
                            <h4>{{getFixedWord('opening_hours',$active_lang)}}</h4>
                            @if(!empty(getAllOffice()))

                                @foreach(getAllOffice() as $address)
                                    @if(!empty($address->open_hourse))
                                        <p>
                                            @foreach($address->open_hourse as $open_hourse)
                                                @if($open_hourse->start_time != $open_hourse->finish_time)
                                                    <strong>{{getFixedWord($open_hourse->start_day_name->name,$active_lang)}}
                                                        - {{getFixedWord($open_hourse->finish_day_name->name,$active_lang)}}
                                                        : {{date('H:i',strtotime($open_hourse->start_time))}}</strong>
                                                    - {{date('H:i',strtotime($open_hourse->finish_time))}}<br>
                                                @else
                                                    <strong>{{getFixedWord($open_hourse->start_day_name->name,$active_lang)}}
                                                        - {{getFixedWord($open_hourse->finish_day_name->name,$active_lang)}}
                                                        : </strong> {{getFixedWord('closed',$active_lang)}}<br>
                                                @endif
                                            @endforeach
                                        </p>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 footer-links">
                <h4>{{getFixedWord('quick_page',$active_lang)}}</h4>
                <div class="quick-links d-flex">
                    <ul>
                        @if(!empty($menu_footer->menu_item_top))
                            @foreach($menu_footer->menu_item_top as $m)
                                {!! $menu_item_model->yummyFooter($m) !!}
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 footer-links">
                <h4>{{getFixedWord('follow_us',$active_lang)}}</h4>
                <div class="social-links d-flex">
                    @foreach(getAllSocial() as $social)
                        <a href="{{$social->link}}" @if($social->link_target == 2) target="_blank"
                           @endif class="{{$social->name}}"><i class="bi {{$social->icon}}"></i></a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="copyright">
            &copy; Copyright <strong><span>{{getSiteSetting('site_name')}}</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="#">Kuark Yazılım</a>
        </div>
    </div>

</footer>
