@extends('layouts.app')

@php
$title = '';
foreach ($seo as $s) {
    if ($s->model == 'contact-us') {
        $title = $s["title_$lang"];
    }
}
@endphp
@section('title', $title)

@section('content')

    <div class="main-contact-us">
        <section class="contact-cover-section">
            <div class="container-fluid contact-cover inner-highlight-container" style="padding: 0;">
                <img class="contact-cover-img inner-highlight-img" src="{{ asset($Highlight['image']) }}"
                    alt="{{ $Highlight['image_alt'] }}" loading="lazy">
                <h5 class="category-overlay-text">
                    {{ __('contact_us') }}
                </h5>
                <div class="overlay-cover-light"></div>
                <ol class="breadcrumb highlight-overlay-text">
                    <li>
                        <a class="breadcrumb-item breadcrumb-item-home" href="{{ route('home') }}">
                            {{-- <i class="fa fa-home"></i> --}}
                            {{ Config::get('app.locale') == 'en' ? 'Home' : 'الرئيسية' }}
                        </a>
                    </li>
                    <li><span
                            class="fa fasl fa-angle-double-{{ Config::get('app.locale') == 'en' ? 'right' : 'left' }}"></span>
                    </li>
                    <li>
                        <p class="breadcrumb-item current-breadcrumb-item">
                            {{ Config::get('app.locale') == 'en' ? 'Contact Us' : 'اتصل بنا' }}
                        </p>
                    </li>
                </ol>
            </div>
        </section>
        <section class="contactUs">
            <div class="container" style="padding:0;">
                <div class="row breadcrumb-row"
                    style="{{ Config::get('app.locale') == 'en' ? '' : 'margin-right:-85px;' }}">
                </div>
                <div class="row contact-row">
                    <div class="contact-div contact-main-div">
                        <fieldset class="contactUs-field main-contactUs-field">
                            <div class="contact-style">
                                <div class="colored-contact-div"></div>
                                <h5 id="headContactPara">
                                    {!! $contactUs_section_info["first_box_title_$lang"] !!}
                                </h5>
                                <div class="overlay-box">
                                </div>
                                <div id="innerContactPara">
                                    {!! $contactUs_section_info["first_box_para_$lang"] !!}
                                </div>
                                <div class="address">
                                    <p>
                                        {{ $mainInformations["sub_address_$lang"] }}<br>{{ $mainInformations["main_address_$lang"] }}
                                    </p>

                                </div>
                                <div class="social-media">
                                    <p class="social-text">{{ __('enjoy_morning') }}</p>
                                    @if ($social_media['facebook_link'] != null)
                                        <a class="social-text" href="{{ $social_media['facebook_link'] }}" target="_blank">
                                            {{-- <i class="fa fa-facebook" target="_blank"></i> --}}
                                            <img class="inst-img"
                                                src="{{ asset('img/icons8-facebook-f-material-filled-32.png') }}"
                                                alt="ins-icon" loading="lazy">
                                        </a>
                                    @endif
                                    @if ($social_media['instagram_link'] != null)
                                        <a class="social-link social-text" href="{{ $social_media['instagram_link'] }}"
                                            target="_blank">
                                            {{-- <i class="fa fa-instagram" target="_blank"></i> --}}
                                            <img class="inst-img"
                                                src="{{ asset('img/icons8-instagram-material-filled-32.png') }}"
                                                alt="ins-icon" loading="lazy">
                                        </a>
                                    @endif
                                    @if ($social_media['youtube_link'] != null)
                                        <a class="social-link social-text" href="{{ $social_media['youtube_link'] }}"
                                            target="_blank">
                                            {{-- <i class="fa fa-youtube" target="_blank"></i> --}}

                                            <img class="inst-img"
                                                src="{{ asset('img/icons8-youtube-logo-material-filled-32.png') }}"
                                                alt="ins-icon" loading="lazy">
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </fieldset>
                        <div class="contact-with-img">
                            <fieldset class="contactUs-info ml-auto contact-main-page-info">
                                <div class="contact-info-style" data-aos="fade-left" data-aos-duration="1000"
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
                                        <p id="innerInfoBackgroundEmail"><i id="innerInfoBackground" class="fa fa-envelope"
                                                aria-hidden="true"></i></p>
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
        <div class="container contact-form-container">
            <div class="card contactUs-card">
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert"
                        style="width: 50%; display:flex; justify-content:center; margin: 0 auto; margin-bottom:10px;">
                        {{ __('contact_msg_success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @elseif (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert"
                        style="width: 50%; display:flex; justify-content:center; margin: 0 auto; margin-bottom:10px;">
                        {{ __('check_email') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="card-heading"></div>
                <div class="card-body">
                    <h5 class="booking-title">{{ __('love_eat') }}</h2>
                        <form class="contactUs-form" method="POST" action="{{ route('contactUs.post') }}"
                            accept-charset="UTF-8">
                            {{ csrf_field() }}
                            <div class="row row-space">
                                <div class="col-form">
                                    <div class="form-group input-group">
                                        <div class="mb-3">
                                            <label for="contactUs-form" class="form-label">{{ __('name') }}*</label>
                                            <input class="input-contactUs booking-name" type="text" name="name"
                                                required>
                                            @if ($errors->has('name'))
                                                <div class="error">{{ $errors->first('name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-form">
                                    <div class="form-group input-group">
                                        <div class="mb-3">
                                            <label for="contactUs-form"
                                                class="form-label">{{ __('email_address') }}*</label>
                                            <input class="input-contactUs booking-email" type="email" name="email"
                                                required>
                                            @if ($errors->has('email'))
                                                <div class="error">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-space">
                                <div class="col-form">
                                    <div class="form-group input-group">
                                        <div class="mb-3">
                                            <label for="contactUs-form" class="form-label">{{ __('phone_num') }}*</label>
                                            <input class="input-contactUs booking-phone-number" type="tel"
                                                pattern="[0-9]+" name="phone_number" required>
                                            @if ($errors->has('phone_number'))
                                                <div class="error">{{ $errors->first('phone_number') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-form">
                                    <div class="form-group input-group">
                                        <div class="mb-3">
                                            <label for="contactUs-form" class="form-label">{{ __('address') }}*</label>
                                            <input class="input-contactUs booking-no-of-persons" type="text"
                                                name="address" required>
                                            @if ($errors->has('address'))
                                                <div class="error">{{ $errors->first('address') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-space">
                                <div class="form-group mb-3 note-mb-3">
                                    <label for="contactUs-form" class="form-label">{{ __('message') }}*</label>
                                    <textarea class="form-control input-contactUs booking-notes" rows="3" name="message" required></textarea>
                                    @if ($errors->has('message'))
                                        <div class="error">{{ $errors->first('message') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row row-space">
                                <div class="form-group recapatcha-group">
                                    <div class="g-recaptcha{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}"
                                        data-sitekey="{{ env('GOOGLE_RECAPTCHA_SITE_KEY') }}">
                                    </div>
                                    <small class="text-danger">{{ $errors->first('g-recaptcha-response') }}</small>
                                    <div class="p-t-20">
                                        <button class="btn btn-sbmit-booking" type="submit">{{ __('submit') }}</button>
                                    </div>
                                </div>
                            </div>

                        </form>

                </div>
            </div>
        </div>
    </div>
@endsection
