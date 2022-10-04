@if(!empty($content->services->services_many))
<section id="why-us" class="why-us section-bg">
    <div class="container" data-aos="fade-up">

        <div class="row gy-4">


            <!--Sadece list order en küçük olan buraya gelir -->
            @if(!empty($content->services->services_one_first))
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="why-box">
                        <h3>{{$content->services->services_one_first->title}}</h3>
                        <p>
                            {{$content->services->services_one_first->description}}
                        </p>
                        <div class="text-center">
                            <a href="{{$content->services->services_one_first->link}}" class="more-btn">Learn More <i
                                    class="bx bx-chevron-right"></i></a>
                        </div>
                    </div>
                </div><!-- End Why Box -->
            @endif

            <div class="col-lg-8 d-flex align-items-center">
                <div class="row gy-4">
                    @foreach($content->services->services_many as $services_list)
                        @if($content->services->services_one_first->id != $services_list->id)
                            @if(!empty($services_list))
                                <div class="col-xl-4" data-aos="fade-up" data-aos-delay="200">
                                    <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{asset($services_list->url)}}" alt="{{$services_list->title}}">
                                        <h4>{{$services_list->title}}</h4>
                                        <p>{{$services_list->description}}</p>
                                    </div>
                                </div>
                            @endif
                        @endif

                    @endforeach

                </div>
            </div>

        </div>

    </div>
</section>
@endif
