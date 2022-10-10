
@if(count($content->form) > 0)
    @foreach($content->form as $form)
        <section @if(!empty($blok->id_attr) && $blok->id_attr != "") id="{{$blok->id_attr}}"
                 @endif class="book-a-table {{$blok->class_attr}}"
                 @if(!empty($blok->color_attr) && $blok->color_attr != "") style="background-color: {{$blok->color_attr}}" @endif>
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>{{$form->name}}</h2>
                    <p>{{$form->title}}</p>
                </div>

                <div class="row g-0">

                    <div class="col-lg-12 d-flex align-items-center reservation-form-bg">
                        <form id="form_send" class="php-email-form-2 fv-plugins-bootstrap5 fv-plugins-framework"
                              action="{{route('form_send')}}" data-aos="fade-up" data-aos-delay="100" style="width: 100%;">
                            <input type="hidden" value="{{$form->id}}" name="id">
                            <div class="row gy-4">
                                @foreach($form->form_input as $fi)
                                    {!! $fi->createForm($fi) !!}
                                @endforeach
                            </div>
                            <div class="text-center mt-3">
                                <button class="send-button" type="submit">{{getFixedWord('send_button')}}</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </section>
    @endforeach
@endif
