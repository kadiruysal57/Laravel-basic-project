<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>
        @if(!empty($content->seo_title))
            {{$content->seo_title}}
        @else
            {{getSiteSetting('site_slogan')}}
        @endif

    </title>
    <meta content="{{$content->seo_description}}" name="description">
    <meta content="{{$content->keywords}}" name="keywords">

    <link href="{{asset('themes/food/assets/img/favicon.png')}}" rel="icon">
    <link href="{{asset('themes/food/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <link href="{{asset('themes/food/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('themes/food/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('themes/food/assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{asset('themes/food/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('themes/food/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">
    <link href="{{asset('themes/css/toastify.css')}}" rel="stylesheet">
    <link href="{{asset('themes/'.$select_themes->themes->themes_folder_name.'/assets/color/'.$select_themes->color->color_folder_name.'/css/main.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

</head>

<body>
@if(!empty($content->default_blok))
    @foreach($content->default_blok->blok_file->where('main_blok_id',1) as $blok)
        @if($blok->file_name->type == 1)
            @include('themes.food.top_footer.'.$blok->file_name->name);
        @else
            <div class="container aos-init aos-animate" data-aos="fade-up">
                {!! $blok->html !!}
            </div>
        @endif

    @endforeach
@else
    @foreach($content->blok_file->where('main_blok_id',1) as $blok)
        @if($blok->file_name->type == 1)
            @include('themes.food.top_footer.'.$blok->file_name->name);
        @else
            <div class="container aos-init aos-animate" data-aos="fade-up">
                {!! $blok->html !!}
            </div>
        @endif
    @endforeach
@endif


<main id="main">

    @if(!empty($content->default_blok))
        @foreach($content->default_blok->blok_file->where('main_blok_id',3) as $blok)
            @if($blok->file_name->type==1)
                @include('themes.food.mid.'.$blok->file_name->name)
            @else
                <div class="container aos-init aos-animate" data-aos="fade-up">
                    {!! $blok->html !!}
                </div>
            @endif
        @endforeach
    @else
        @foreach($content->blok_file->where('main_blok_id',3) as $blok)
            @if($blok->file_name->type==1)
                @include('themes.food.mid.'.$blok->file_name->name)
            @else
                <div class="container aos-init aos-animate" data-aos="fade-up">
                    {!! $blok->html !!}
                </div>
            @endif

        @endforeach
    @endif

</main>
@if(!empty($wp))
<a href="https://wa.me/{{$wp->phone}}?text={{$wp->default_text}}" target="_blank" class="whattsapp
    @if($wp->button_position == 1)
    left-mid
    @elseif($wp->button_position == 2)
    left-bottom
    @elseif($wp->button_position == 3)
    right-mid
    @elseif($wp->button_position == 4)
    right-bottom

    @endif
    ">
    <img src="{{$wp->image}}" alt="">
    <span>{{$wp->wp_text}}</span>
</a>
@endif
<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<div id="preloader"></div>
<div class="preloader" style="display: none"></div>


@if(!empty($content->default_blok))
    @foreach($content->default_blok->blok_file->where('main_blok_id',5) as $blok)

        @if($blok->file_name->type == 1)
            @include('themes.food.top_footer.'.$blok->file_name->name)
        @else
            {!! $blok->html !!}
        @endif
    @endforeach
@else
    @foreach($content->blok_file->where('main_blok_id',5) as $blok)
        @if($blok->file_name->type == 1)
            @include('themes.food.top_footer.'.$blok->file_name->name)
        @else
            {!! $blok->html !!}
        @endif
    @endforeach
@endif
<script src="{{asset('themes/food/assets/js/jquery-3.6.1.min.js')}}"></script>
<script src="{{asset('themes/food/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('themes/food/assets/vendor/aos/aos.js')}}"></script>
<script src="{{asset('themes/food/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
<script src="{{asset('themes/food/assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
<script src="{{asset('themes/food/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
<script src="{{asset('themes/food/assets/vendor/php-email-form/validate.js')}}"></script>

<script src="{{asset('themes/food/assets/js/toastify.js')}}"></script>
<script src="{{asset('themes/food/assets/js/main.js')}}"></script>
@yield('JsContent')
</body>

</html>
