<section @if(!empty($blok->id_attr) && $blok->id_attr != "") id="{{$blok->id_attr}}"
         @endif class="sample {{$blok->class_attr}}"
         @if(!empty($blok->color_attr) && $blok->color_attr != "") style="background-color: {{$blok->color_attr}}" @endif>
    <div class="container" data-aos="fade-up">
        {!! $content->description !!}
    </div>
</section>
