@if(!empty($content->staff))
    <section @if(!empty($blok->id_attr) && $blok->id_attr != "") id="{{$blok->id_attr}}"
             @endif class="chefs {{$blok->class_attr}}"
             @if(!empty($blok->color_attr) && $blok->color_attr != "") style="background-color: {{$blok->color_attr}}" @endif>
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>{{$content->staff->name}}</h2>
                <p>{{$content->staff->description}}</p>
            </div>
            @if(count($content->staff->staff_many) != 0)
                <div class="row gy-4">
                    @foreach($content->staff->staff_many as $sm)
                        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up"
                             data-aos-delay="100">
                            <div class="chef-member">
                                <div class="member-img">
                                    <img src="{{asset($sm->url)}}" class="img-fluid" alt="">
                                </div>
                                <div class="member-info">
                                    <h4>{{$sm->name}}</h4>
                                    <span>{{$sm->job_title}}</span>
                                    <p>{{$sm->description}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </section>
@endif
