@if(!empty($content->gallery))
    <section id="gallery" class="gallery section-bg">
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
