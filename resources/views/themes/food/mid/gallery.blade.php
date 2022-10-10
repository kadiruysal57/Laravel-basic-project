@if(!empty($content->gallery))
    <section @if(!empty($blok->id_attr) && $blok->id_attr != "") id="{{$blok->id_attr}}"
             @endif class="gallery {{$blok->class_attr}}"
             @if(!empty($blok->color_attr) && $blok->color_attr != "") style="background-color: {{$blok->color_attr}}" @endif>
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>{{$content->gallery->title}}</h2>
                <p>{{$content->gallery->description}}</p>
            </div>
            @if(count($content->gallery->gallery_image) > 0)
                <div class="gallery-slider swiper">
                    <div class="swiper-wrapper align-items-center">
                        @foreach($content->gallery->gallery_image as $gallery_image)
                            <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                                                         href="{{asset($gallery_image->url)}}"><img
                                        src="{{asset($gallery_image->url)}}" class="img-fluid" alt=""></a></div>
                        @endforeach

                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            @endif
        </div>
    </section>
@endif
