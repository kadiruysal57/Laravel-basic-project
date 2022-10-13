<section @if(!empty($blok->id_attr) && $blok->id_attr != "") id="{{$blok->id_attr}}"
         @endif class="contact {{$blok->class_attr}}"
         @if(!empty($blok->color_attr) && $blok->color_attr != "") style="background-color: {{$blok->color_attr}}" @endif>
    <div class="container aos-init aos-animate" data-aos="fade-up">

        <div class="mb-3">
            @if(!empty(getAllOffice()))
                @foreach(getAllOffice() as $map)
                    @if(!empty($map->maps) && $map->maps != "")
                        <iframe style="border:0; width: 100%; height: 350px;"
                                src="{{$map->maps}}"
                                frameborder="0" allowfullscreen=""></iframe>
                    @endif
                @endforeach
            @endif

        </div>

        <div class="row gy-4">

            <div class="col-md-6">
                <div class="info-item  d-flex align-items-center">
                    <i class="icon bi bi-map flex-shrink-0"></i>
                    <div>
                        <h3>{{getFixedWord('address')}}</h3>
                        @if(!empty(getAllOffice()))
                            @foreach(getAllOffice() as $address)
                                @if(!empty($address->address))
                                    <p>{{$address->address}}</p>
                                @endif
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-item d-flex align-items-center">
                    <i class="icon bi bi-envelope flex-shrink-0"></i>
                    <div>
                        <h3>{{getFixedWord('email')}}</h3>
                        @if(!empty(getAllOffice()))
                            @foreach(getAllOffice() as $email)
                                @if(!empty($email->email))
                                    <p>{{$email->email}}</p>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-item  d-flex align-items-center">
                    <i class="icon bi bi-telephone flex-shrink-0"></i>
                    <div>
                        <h3>{{getFixedWord('call_us')}}</h3>
                        @if(!empty(getAllOffice()))
                            @foreach(getAllOffice() as $gsm)
                                @if(!empty($gsm->gsm))
                                    <p>{{$gsm->gsm}}</p>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-item  d-flex align-items-center">
                    <i class="icon bi bi-share flex-shrink-0"></i>
                    <div>
                        <h3>{{getFixedWord('opening_hours')}}</h3>
                        <div>
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

        </div>


    </div>
</section>
