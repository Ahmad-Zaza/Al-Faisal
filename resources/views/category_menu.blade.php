@extends('layouts.app')
@php
$title = '';
foreach ($seo as $s) {
    if ($s->model_id == $category->id) {
        $title = $s["title_$lang"];
    }
}
@endphp
@section('title', $title)
@section('content')
    <style>
        .cat-menu-cover {
            padding: 0;
            padding-bottom: 30px;
            background-repeat: no-repeat;
        }
    </style>

    <div class="main-category-munu">
        <section class="menu-cover-section">
            <div class="container-fluid cat-menu-cover inner-highlight-container">
                <img class="category-main-menu-img inner-highlight-img" src="{{ $category['highlight'] }}" alt=""
                    loading="lazy">
                <div class="overlay-cover-light"></div>
                <h5 class="category-overlay-text">
                    {{ $category["name_$lang"] }}
                </h5>
                <ol class="breadcrumb category-overlay-text breadcrumb-cat-menu">
                    <li>
                        <a class="breadcrumb-item breadcrumb-item-home" href="{{ route('home') }}">
                            {{ Config::get('app.locale') == 'en' ? 'Home' : 'الرئيسية' }}
                        </a>
                    </li>
                    <li><span
                            class="fa fasl fa-angle-double-{{ Config::get('app.locale') == 'en' ? 'right' : 'left' }}"></span>
                    </li>
                    <li>
                        <a class="breadcrumb-item" href="{{ route('service_events.index') }}">
                            {{ Config::get('app.locale') == 'en' ? 'Catering' : 'خدماتنا' }}
                        </a>
                    </li>
                    <li><span
                            class="fa fasl fa-angle-double-{{ Config::get('app.locale') == 'en' ? 'right' : 'left' }}"></span>
                    </li>
                    <li>
                        <p class="breadcrumb-item current-breadcrumb-item">
                            {{ $category["name_$lang"] }}
                        </p>
                    </li>
                </ol>
            </div>
        </section>
    </div>
    <section class="category-menu-para-section">
        @include('layouts.sub_category_menu')
        <div class="row note-row note-row-{{ $lang }}">
            <p class="category-note">
                {{ $category["note_$lang"] }}
            </p>
        </div>
        @if ($category['is_downloadable'])
            <div class="row download-menu-row">
                <a href="{{ route('pdf.download', ['id' => $category['id']]) }}" target="_blank">{{ __('Download') }}</a>
            </div>
        @endif
        <div class="container booking-container">
            <div class="card booking-card">
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert"
                        style="width: 50%; display:flex; justify-content:center; margin: 0 auto; margin-bottom:10px;">
                        {{ __('booking_success') }}
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
                    <h5 class="booking-title">{{ __('booking') }}</h5>
                    <form class="booking-form" method="POST" action="{{ route('event.book') }}" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <div class="row row-space">
                            <div class="col-form">
                                <div class="form-group input-group">
                                    <div class="mb-3">
                                        <label for="booking-form" class="form-label">{{ __('name') }}*</label>
                                        <input class="input-booking booking-name" type="text" name="name" required>
                                        {{-- <span class="floating-label">{{ __('name') }}*</span> --}}
                                        @if ($errors->has('name'))
                                            <div class="error">{{ $errors->first('name') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-form">
                                <div class="form-group input-group">
                                    <div class="mb-3">
                                        <label for="booking-form" class="form-label">{{ __('catering_name') }}*</label>
                                        <input class="input-booking booking-catering-name" type="text"
                                            name="catering_name" value="{{ $category["name_$lang"] }}" required>
                                        @if ($errors->has('catering_name'))
                                            <div class="error">{{ $errors->first('catering_name') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-form">
                                <div class="form-group input-group">
                                    <div class="mb-3">
                                        <label for="booking-form" class="form-label">{{ __('phone_num') }}*</label>
                                        <input class="input-booking booking-phone-number" type="tel" pattern="[0-9]+"
                                            name="phone_number" required>
                                        @if ($errors->has('phone_number'))
                                            <div class="error">{{ $errors->first('phone_number') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-form">
                                <div class="form-group input-group">
                                    <div class="mb-3">
                                        <label for="booking-form" class="form-label">{{ __('n_of_pers') }}*</label>
                                        <input class="input-booking booking-no-of-persons" type="number"
                                            name="no_of_persons" required>
                                        @if ($errors->has('no_of_persons'))
                                            <div class="error">{{ $errors->first('no_of_persons') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-form">
                                <div class="form-group input-group">
                                    <div class="mb-3">
                                        <label for="booking-form" class="form-label">{{ __('email_address') }}*</label>
                                        <input class="input-booking booking-email" type="email" name="email" required>
                                        @if ($errors->has('email'))
                                            <div class="error">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-form">
                                <div class="form-group input-group">
                                    <div class="form-group mb-3">
                                        <label for="booking-form" class="form-label">{{ __('delivery_locatin') }}*</label>
                                        <input class="input-booking booking-location" type="text" name="location"
                                            required>
                                        @if ($errors->has('location'))
                                            <div class="error">{{ $errors->first('location') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="form-group mb-3 note-mb-3">
                                <label for="booking-form" class="form-label">{{ __('notes') }}</label>
                                <textarea class="form-control input-booking booking-notes" rows="3" name="note"></textarea>
                                @if ($errors->has('note'))
                                    <div class="error">{{ $errors->first('note') }}</div>
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
    </section>

@endsection
