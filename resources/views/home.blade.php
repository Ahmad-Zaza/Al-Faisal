@extends('layouts.app')
@section('title', config('app.name', 'Faisal'))
@section('content')
    @php $_right = ($lang=="ar"?"left":"right")@endphp
    @php $_r = ($lang=="ar"?"r":"l")@endphp
    @php $_l = ($lang=="ar"?"l":"r")@endphp
    @php $_left = ($lang=="ar"?"right":"left")@endphp

    <main id="main" class="main">
        <section>
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($section_sliders[1] as $key => $main_slider)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <img class="d-block img-fluid main-slide-img" src="{{ asset($main_slider['image']) }}"
                                alt="{{ $main_slider['image_alt'] }}" style="background-size:cover;">
                            <div class="carousel-caption d-none d-md-block" data-aos="fade-down" data-aos-duration="1000"
                                data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true"
                                data-aos-anchor-placement="top-center">
                                <a href="{{ $main_slider['url'] }}" style="text-decoration: none;" target="_blank">
                                    <p class="first-caption">{{ $main_slider["first_title_$lang"] }}</p>
                                    <p class="second-caption">{{ $main_slider["second_title_$lang"] }}</p>
                                </a>
                                {{-- <p class="first-caption">{{ $main_slider["first_title_$lang"] }}</p>
                                <p class="second-caption">{{ $main_slider["second_title_$lang"] }}</p> --}}
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>
        <!-- end main slider section -->
        <!-- start about us section -->
        <section>
            <div class="container-fluid aboutUs-container" style="padding:0;">
                <div class="row aboutUs-row">
                    <fieldset class="aboutUs-feild-text" data-aos="fade-right" data-aos-duration="1000"
                        data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true"
                        data-aos-anchor-placement="top-center">
                        <div class="aboutUs-special-style">
                            <div class="about-us-background-text">
                                <div class="overlay-good"></div>
                                <h3 class="f-good">
                                    <span class="f-good-space">&nbsp;</span>
                                    {{ $section_textBoxes[2]["first_box_title_$lang"] }}
                                </h3>
                                <h3 class="s-good">
                                    {{ $section_textBoxes[2]["second_box_title_$lang"] }}</h3>
                            </div>
                            <div id="innerAboutUsField" class="innerAboutUsField home-innerAboutUsField">
                                {!! $section_textBoxes[2]["first_box_para_$lang"] !!}
                            </div>
                            <a href="{{ route('about_us') }}" class="read-more">
                                {{ __('read_more') }}
                            </a>
                        </div>
                    </fieldset>
                    <img class="padding-img" src="{{ asset($section_textBoxes[2]['image']) }}"
                        alt="{{ $section_textBoxes[2]['image_alt'] }}">
                </div>
            </div>
        </section>
        <!-- end about us section -->
        <!-- start services section -->
        <section>
            <div class="container-fluid cover-section"
                style="padding: 0; background-image: url({{ $section_textBoxes[3]['image'] }});">
                <div class="row cover-section-row">
                    <div class="col-md">
                        <fieldset class="border border-faisal">
                            <div class="cover-first-special-style">
                                <h5 class='text-center'>{{ $section_textBoxes[3]["first_box_title_$lang"] }}
                                </h5>
                                <div id="innerPara">
                                    {!! $section_textBoxes[3]["first_box_para_$lang"] !!}
                                </div>
                            </div>

                        </fieldset>
                        <fieldset class="border-faisal-second">
                            <div class="second-special-style">
                                <div id="innerParaWithBackground">
                                    {!! $section_textBoxes[3]["second_box_para_$lang"] !!}

                                </div>
                            </div>

                        </fieldset>
                    </div>
                    <div class="col-md"></div>
                </div>
            </div>
        </section>
        <!-- end services section -->
        <!-- start events section -->
        <section>
            <div class="container-fluid events-container">
                <div class="row first-service-row">
                    <div class="img1">
                        <div class="events-header-text">
                            <h5 style="color: #000;  color: rgba(0, 0, 0, 0) !important;">
                                {{ $section_textBoxes[4]["first_box_title_$lang"] }}</h5>
                        </div>
                        <div class="first-carousel">
                            <div id="carouselExampleControls1" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($section_sliders[4] as $key => $main_slider)
                                        @if ($main_slider['slider_number'] == 1)
                                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                <img class="d-block img-fluid services-imgs"
                                                    src="{{ asset($main_slider['image']) }}"
                                                    alt="{{ $main_slider['image_alt'] }}"
                                                    class="animated slideInLeft infinite">
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="img2">
                        <div class="events-header-text">
                            <h5> {{ $section_textBoxes[4]["first_box_title_$lang"] }}</h5>
                        </div>
                        {{-- <img id="second-changed" src="{{ asset('images/service2.jpg') }}" alt=""> --}}
                        <div class="second-carousel">
                            <div id="carouselExampleControls2" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($second_service_sliders as $key => $main_slider)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <img class="d-block img-fluid services-imgs"
                                                src="{{ asset($main_slider['image']) }}"
                                                alt="{{ $main_slider['image_alt'] }}" class="animated slideInLeft infinite"
                                                loading="lazy">
                                        </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row second-service-row">
                    <div class="event-para">
                        {!! $section_textBoxes[4]["first_box_para_$lang"] !!}

                    </div>

                    <div class="body-card-button">

                        <a id="vidoePopup" href="{{ route('service_events.index') }}" class="card-button-link"
                            target="_blank">
                            <span class="card-btn">
                                {{ $section_textBoxes[4]["button_text_$lang"] }}
                            </span>
                        </a>
                    </div>

                </div>
            </div>
        </section>
        <!-- end events sectino -->
        <section>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" style="background-color: rgba(0,0,0,.0); border:none;">
                        <div class="modal-header" style="border:none;">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <video id="faisal_video" width="100%" height="100%" controls preload="auto">
                                <source src="{{ $mainInformations['vedio'] }}" type="video/mp4">
                                <source src="{{ $mainInformations['vedio'] }}" type="video/ogg">
                            </video>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid owl-container" style="padding: 0;">
                <div id="main-owl-carousel" class="owl-carousel">
                    @foreach (min($section_textBoxes[5], $section_sliders[5]) as $key => $section_slider)
                        <div class="item">
                            <img class="owl-img" src="{{ asset($section_sliders[5][$key]['image']) }}"
                                alt="{{ $section_sliders[5][$key]['image_alt'] }}" loading="lazy">
                        </div>
                        <div class="item card">
                            <div class="card-body servecs-slider-card-body">
                                <fieldset class="border border-slider-card">
                                    <div class="first-speial-style">

                                        <h5 class='text-center first-spec-title'>
                                            <div class="box-title">
                                                <div class="overlay-catering-box"></div>
                                                {{ $section_textBoxes[5][$key]["first_box_title_$lang"] }}
                                            </div>
                                        </h5>
                                        <div id="innerSliderCardPara">
                                            {!! $section_textBoxes[5][$key]["first_box_para_$lang"] !!}
                                        </div>
                                    </div>
                                    <!-- Button trigger modal -->
                                    @if ($key == 0 && $mainInformations['vedio'])
                                        <!-- Button trigger modal -->
                                        <button id="video_btn" type="button" class="btn btn-primary"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="myFunction()">
                                            {{ __('watch_video') }}
                                        </button>
                                    @endif
                                    <div class="body-card-button">
                                        <a href="{{ route('service_events.index') }}" class="card-button-link"
                                            target="_blank">
                                            <span class="card-btn">
                                                {{ $section_textBoxes[5][$key]["button_text_$lang"] }}
                                            </span>
                                        </a>
                                    </div>
                                </fieldset>

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
        <section class="contactUs">
            <div class="container-fluid about-us-container" style="">
                <div class="row contact-row">
                    <div class="contact-div">
                        <fieldset class="contactUs-field">
                            <div class="contact-style">
                                <h5 id="headContactPara">
                                    {!! $section_textBoxes[6]["first_box_title_$lang"] !!}
                                </h5>
                                <div class="home-overlay-box">
                                </div>
                                <p id="innerContactPara">
                                    {!! $section_textBoxes[6]["first_box_para_$lang"] !!}
                                </p>
                                <div class="address">
                                    <p>
                                        {{ $mainInformations["sub_address_$lang"] }}<br>{{ $mainInformations["main_address_$lang"] }}
                                    </p>

                                </div>
                                <div class="social-media">
                                    <p class="social-text">{{ __('enjoy_morning') }}</p>
                                    @if ($social_media['facebook_link'] != null)
                                        <a class="social-text" href="{{ $social_media['facebook_link'] }}"
                                            target="_blank">
                                            <img class="inst-img"
                                                src="{{ asset('img/icons8-facebook-f-material-filled-32.png') }}"
                                                alt="ins-icon" loading="lazy">
                                        </a>
                                    @endif
                                    @if ($social_media['instagram_link'] != null)
                                        <a class="social-link social-text" href="{{ $social_media['instagram_link'] }}"
                                            target="_blank">
                                            <img class="inst-img"
                                                src="{{ asset('img/icons8-instagram-material-filled-32.png') }}"
                                                alt="ins-icon" loading="lazy">
                                        </a>
                                    @endif
                                    @if ($social_media['youtube_link'] != null)
                                        <a class="social-link social-text" href="{{ $social_media['youtube_link'] }}"
                                            target="_blank">
                                            <img class="inst-img"
                                                src="{{ asset('img/icons8-youtube-logo-material-filled-32.png') }}"
                                                alt="ins-icon" loading="lazy">
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </fieldset>
                        <div class="contact-with-img">
                            <img class="padding-img_1" src="{{ asset($section_textBoxes[6]['image']) }}"
                                alt="{{ $section_textBoxes[6]['image_alt'] }}" loading="lazy">
                            <fieldset class="contactUs-info ml-auto">
                                <div class="contact-info-style" data-aos="fade-up" data-aos-duration="1000"
                                    data-aos-easing="ease-in-out" data-aos-mirror="true" data-aos-once="true"
                                    data-aos-anchor-placement="top-center">
                                    <p id="ParaInfoBackground">
                                        {{ __('welcome') }}
                                    </p>
                                    <h2 class="contact_us_h">
                                        {{ __('contact_us') }}
                                    </h2>
                                    <div id="innerInfoBackground">
                                        <div class="tel" style="display: inline-flex">
                                            <i id="innerInfoBackground" class="fa fa-phone phone-icon"
                                                aria-hidden="true"></i>
                                            <div class="tels">
                                                <a href="tel:{{ $mainInformations->tel_number }}">
                                                    <p id="innerInfoBackground1">
                                                        {{ $mainInformations->tel_number }}
                                                    </p>
                                                </a>
                                                <a href="tel:{{ $mainInformations->tel_number }}">
                                                    <p id="innerInfoBackground1">
                                                        {{ $mainInformations->tel_number1 }}
                                                    </p>
                                                </a>
                                            </div>
                                        </div><br>
                                        <div class="mobile" style="display: inline-flex">
                                            <i id="innerInfoBackground" class="fa fa-mobile mobile-icon"
                                                aria-hidden="true"></i>
                                            <a href="tel:{{ $mainInformations->mob_number }}">
                                                <p id="innerInfoBackground1">
                                                    {{ $mainInformations->mob_number }}
                                                </p>
                                            </a>
                                        </div><br>
                                        <div class="event" style="display: inline-flex">
                                            <i id="innerInfoBackground" class="fa fa-calendar celander-icon"></i>
                                            <a href="tel:{{ $mainInformations->event }}">
                                                <p id="innerInfoBackground1">{{ $mainInformations->event }}</p>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="email">
                                        <p id="innerInfoBackgroundEmail"><i id="innerInfoBackground"
                                                class="fa fa-envelope" aria-hidden="true"></i></p>
                                        <a class="emailto-link" href="mailto:{{ $mainInformations->email }}">
                                            <p id="emailBackground">
                                                {{ $mainInformations->email }}
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
