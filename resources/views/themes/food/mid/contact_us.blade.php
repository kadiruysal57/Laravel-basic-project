<section id="contact" class="contact">
    <div class="container aos-init aos-animate" data-aos="fade-up">

        <div class="mb-3">
            @if(!empty(getAllOffice()))
                @foreach(getAllOffice() as $map)
                    @if(!empty($map))
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
                        <h3>Opening Hours</h3>
                        <div><strong>Mon-Sat:</strong> 11AM - 23PM;
                            <strong>Sunday:</strong> Closed
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div>
</section>
