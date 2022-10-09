@if(!empty($content->portfolio))
    <section id="menu" class="menu">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2>{{$content->portfolio->title}}</h2>
                <p>{{$content->portfolio->description}}</p>
            </div>
            <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
                @if(!empty($content->portfolio->portfolio_select_group))
                    @foreach($content->portfolio->portfolio_select_group as $key => $sl)
                        @if(!empty($sl->portfolio_group))
                            @foreach($sl->portfolio_group as  $pg)
                                <li class="nav-item">
                                    <a class="nav-link @if($key == 0) active show @endif" data-bs-toggle="tab"
                                       data-bs-target="#menu-{{$pg->id}}">
                                        <h4>{{$pg->title}}</h4>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    @endforeach
                @endif


            </ul>

            <div class="tab-content" data-aos="fade-up" data-aos-delay="300">
                @if(!empty($content->portfolio->portfolio_select_group))
                    @foreach($content->portfolio->portfolio_select_group as $key => $sl)
                        @if(!empty($sl->portfolio_group))
                            @foreach($sl->portfolio_group as  $pg)
                                <div class="tab-pane fade @if($key == 0) active show @endif" id="menu-{{$pg->id}}">

                                    <div class="tab-header text-center">
                                        <h3>{{$pg->title}}</h3>
                                    </div>

                                    <div class="row gy-5">
                                        @if(!empty($pg->image))
                                            @foreach($pg->image as $pgi)
                                                <div class="col-lg-4 menu-item">
                                                    <a href="{{asset($pgi->image_url)}}" class="glightbox"><img
                                                            src="{{asset($pgi->image_url)}}"
                                                            class="menu-img img-fluid"
                                                            alt=""></a>
                                                    <h4>{{$pgi->title}}</h4>
                                                    <p class="ingredients">
                                                        {{$pgi->description}}
                                                    </p>
                                                    @if(!empty($pgi->alt_title))
                                                        <p class="price">
                                                            {{$pgi->alt_title}}
                                                        </p>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                @endif
            </div>

        </div>
    </section>
@endif
