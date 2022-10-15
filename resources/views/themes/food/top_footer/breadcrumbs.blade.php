<div @if(!empty($blok->id_attr) && $blok->id_attr != "") id="{{$blok->id_attr}}"
         @endif class="breadcrumbs {{$blok->class_attr}}"
         @if(!empty($blok->color_attr) && $blok->color_attr != "") style="background-color: {{$blok->color_attr}}" @endif>
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h1>{{$content->title}}</h1>
            <ol>
                <li><a href="/">{{getFixedWord('home',$active_lang)}}</a></li>
                {!! $content->getBreadcrumbs() !!}
            </ol>
        </div>
    </div>
</div>
