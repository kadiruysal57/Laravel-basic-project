<footer id="footer" class="footer">

    <div class="container">
        <div class="row gy-3">
            <div class="col-lg-9 col-md-9 col-sm-12">
                <div class="row gy-3">
                    <div class="col-lg-4 col-md-6 d-flex">
                        <i class="bi bi-geo-alt icon"></i>
                        <div>
                            <h4>{{getFixedWord('address')}}</h4>
                            @foreach(getAllAddress() as $address)
                                <p>
                                    {{$address}}<br>
                                </p>
                            @endforeach
                        </div>

                    </div>

                    <div class="col-lg-4 col-md-6 footer-links d-flex">
                        <i class="bi bi-telephone icon"></i>
                        <div>
                            <h4>{{getFixedWord('reservations')}}</h4>
                            <p>
                                @foreach(getAllPhone() as $e)
                                    <strong>{{getFixedWord('reservations')}}:</strong> {{$e}}<br>
                                @endforeach

                                @foreach(getAllEmail() as $e)
                                    <strong>{{getFixedWord('email')}}:</strong> {{$e}}<br>
                                @endforeach
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-links d-flex">
                        <i class="bi bi-clock icon"></i>
                        <div>
                            <h4>{{getFixedWord('opening_hours')}}</h4>
                            @if(!empty(getAllOffice()))

                                @foreach(getAllOffice() as $address)
                                    @if(!empty($address->open_hourse))
                                        <p>
                                        @foreach($address->open_hourse as $open_hourse)
                                                @if($open_hourse->start_time != $open_hourse->finish_time)
                                                <strong>{{getFixedWord($open_hourse->start_day_name->name)}} - {{getFixedWord($open_hourse->finish_day_name->name)}} : {{date('H:i',strtotime($open_hourse->start_time))}}</strong> - {{date('H:i',strtotime($open_hourse->finish_time))}}<br>
                                                @else
                                                    <strong>{{getFixedWord($open_hourse->start_day_name->name)}} - {{getFixedWord($open_hourse->finish_day_name->name)}} : </strong> {{getFixedWord('closed')}}<br>
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
                <h4>{{getFixedWord('follow_us')}}</h4>
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
