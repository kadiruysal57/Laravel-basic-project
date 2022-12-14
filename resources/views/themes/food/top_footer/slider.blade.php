@if(!empty($content->content_slider))
    <section @if(!empty($blok->id_attr) && $blok->id_attr != "") id="{{$blok->id_attr}}"
         @endif class="hero {{$blok->class_attr}}"
         @if(!empty($blok->color_attr) && $blok->color_attr != "") style="background-color: {{$blok->color_attr}}" @endif>
        <div class="container">
            <div class="row justify-content-between gy-5">
                @if(!empty($content->content_slider->slider_image_many))
                    @foreach($content->content_slider->slider_image_many as $image)
                        <div
                            class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center align-items-lg-start text-center text-lg-start">
                            <h2 data-aos="fade-up">{{$image->title}}</h2>
                            <p data-aos="fade-up" data-aos-delay="100">{{$image->description}}</p>
                            <!--<div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                                <a href="#book-a-table" class="btn-book-a-table">Book a Table</a>
                                <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ"
                                   class="glightbox btn-watch-video d-flex align-items-center"><i
                                        class="bi bi-play-circle"></i><span>Watch Video</span></a>
                            </div>-->
                        </div>
                        <div class="col-lg-5 order-1 order-lg-2 text-center text-lg-start">
                            <img src="{{$image->url}}" class="img-fluid" alt="" data-aos="zoom-out"
                                 data-aos-delay="300">
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endif
