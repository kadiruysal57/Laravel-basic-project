<div class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2>{{$content->title}}</h2>
            <ol>
                <li><a href="/">{{getFixedWord('home')}}</a></li>
                {!! $content->getBreadcrumbs() !!}
            </ol>
        </div>
    </div>
</div>
