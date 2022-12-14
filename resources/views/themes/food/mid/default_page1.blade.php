<!-- ======= About Section ======= -->

<section @if(!empty($blok->id_attr) && $blok->id_attr != "") id="{{$blok->id_attr}}"
         @endif class="about {{$blok->class_attr}}"
         @if(!empty($blok->color_attr) && $blok->color_attr != "") style="background-color: {{$blok->color_attr}}" @endif>
    <div class="container" data-aos="fade-up">

        <div class="section-header">
            <h2>{{$content->title}}</h2>
            <p>{{$content->short_desc}}</p>
        </div>

        <div class="row gy-4">
            @if(!empty($content->content_gallery_one->image_url))
                <div class="col-lg-7 position-relative about-img"
                     style="background-image: url('{{asset($content->content_gallery_one->image_url)}}') ;"
                     data-aos="fade-up" data-aos-delay="150">
                </div>
                <div class="col-lg-5 d-flex align-items-end sample-page" data-aos="fade-up" data-aos-delay="300">
                    {!! $content->description !!}
                </div>
            @else
                <div class="col-lg-12 d-flex align-items-end" data-aos="fade-up" data-aos-delay="300">
                    {!! $content->description !!}

                </div>
            @endif

        </div>

    </div>
</section><!-- End About Section -->
