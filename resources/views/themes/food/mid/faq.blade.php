@if(!empty($content->faq_category))
    <section @if(!empty($blok->id_attr) && $blok->id_attr != "") id="{{$blok->id_attr}}"
             @endif class=" {{$blok->class_attr}}"
             @if(!empty($blok->color_attr) && $blok->color_attr != "") style="background-color: {{$blok->color_attr}}" @endif>
        <div class="container aos-init aos-animate" data-aos="fade-up">
            <div class="section-header">
                <h2>{{$content->faq_category->title}}</h2>
                <p>{{$content->faq_category->description}}</p>
            </div>

            @if(!empty($content->faq_category->faq))
                <div class="accordion" id="accordionFaq">
                    @foreach($content->faq_category->faq as $key => $faqs)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{$faqs->id}}">
                                <button class="accordion-button @if($key != 0) collapsed @endif" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse{{$faqs->id}}"
                                        aria-expanded="true" aria-controls="collapse{{$faqs->id}}">
                                    {{$faqs->question}}
                                </button>
                            </h2>
                            <div id="collapse{{$faqs->id}}"
                                 class="accordion-collapse collapse @if($key == 0) show @endif"
                                 aria-labelledby="heading{{$faqs->id}}" data-bs-parent="#accordionFaq">
                                <div class="accordion-body">
                                    {{$faqs->answer}}
                                </div>
                            </div>
                        </div>
                    @section('Faqjs')
                            <script type="application/ld+json">
    {
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [

            {
                "@type": "Question",
                "name": "{{$faqs->question}}",
                "acceptedAnswer": {
                "@type": "Answer",
                "text": "{{$faqs->answer}}"
                }
            },
      ]
    }

                        </script>
                    @endsection
                    @endforeach
                </div>
            @endif

        </div>
    </section>
@endif
