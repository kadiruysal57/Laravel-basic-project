@extends('Kpanel.layouts.app')


@section('page-title') Dashboard @endsection <!-- Sayfa title'ı ayarlanıyor -->

@section('CssContent')
    <!-- Bu sayfaya özel css dosyaları çekilecek -->
@endsection


@section('content')
    {!! QrCode::size(100)->generate("https://kuarkbilisim.com",'../public/qrcode.svg'); !!}
    @php
    $sitesettings = \App\Models\site_settings::where('status',1)->first();
    @endphp

    {!! QrCode::size(100)->generate("https://kuarkbilisim.com"); !!}

    <div class="main-content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header justify-content-center">
                        <h5 class="card-title "><strong>{{$sitesettings->site_name}} Kontrol Paneli</strong></h5>
                    </div>

                    <div class="card-body justify-content-center text-center">
                        @if(!empty($sitesettings->fav_icon))
                            <img
                                src="{{asset($sitesettings->fav_icon)}}"
                                alt=""
                            >
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.main-content -->

@endsection

@section('JsContent')

    <script
        src="{{asset('panel/assets/vendor/chartjs/Chart.min.js')}}"></script>
@endsection


