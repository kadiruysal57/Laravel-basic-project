
@if(!empty($content->comments))
    <section @if(!empty($blok->id_attr) && $blok->id_attr != "") id="{{$blok->id_attr}}"
             @endif class="testimonials {{$blok->class_attr}}"
             @if(!empty($blok->color_attr) && $blok->color_attr != "") style="background-color: {{$blok->color_attr}}" @endif>
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>{{$content->comments->name}}</h2>
                <p>{{$content->comments->description}}</p>
            </div>
            @if(count($content->comments->comments_many) != 0)
                <div class="slides-1 swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">
                        @foreach($content->comments->comments_many as $cm)
                            <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <div class="row gy-4 justify-content-center">
                                        <div class="col-lg-6">
                                            <div class="testimonial-content">
                                                <p>
                                                    <i class="bi bi-quote quote-icon-left"></i>
                                                    {{$cm->comments}}
                                                    <i class="bi bi-quote quote-icon-right"></i>
                                                </p>
                                                <h3>{{$cm->name}}</h3>
                                                <h4>{{$cm->job_title}}</h4>
                                                <div class="stars">
                                                    @for ($i = 1; $i <= round($cm->rate); $i++)
                                                        @if($cm->rate >= $i)
                                                        <i class="bi bi-star-fill"></i>
                                                        @elseif($cm->rate < $i)
                                                            <i class="bi bi-star-half"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 text-center">
                                            <img src="{{asset($cm->url)}}"
                                                 class="img-fluid testimonial-img" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            @endif

        </div>
    </section>
@endif
