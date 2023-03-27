@extends('layouts.app')
@php
$title = '';
foreach ($seo as $s) {
    if ($s->model == 'catering') {
        $title = $s["title_$lang"];
    }
}
@endphp
@section('title', $title)
@section('content')
    @php $_right = ($lang=="ar"?"left":"right")@endphp
    @php $_r = ($lang=="ar"?"r":"l")@endphp
    @php $_l = ($lang=="ar"?"l":"r")@endphp
    @php $_left = ($lang=="ar"?"right":"left")@endphp

    <div class="main-services">
        <div class="container-fluid main-service-cover" style="padding: 0;">
            <div class="row" style="--bs-gutter-x: 0; position: relative;">
                <img class="main-service-img" src="{{ asset($highlight['image']) }}" alt="{{ $highlight['image_alt'] }}"
                    loading="lazy">
                <h5 class="category-overlay-text catering-overlay-text">
                    {{ Config::get('app.locale') == 'en' ? 'Catering' : 'خدماتنا' }}
                </h5>
                <div class="overlay-cover-light"></div>
                <ol class="breadcrumb highlight-overlay-text catering-breadcrumb">
                    <li>
                        <a class="breadcrumb-item breadcrumb-item-home" href="{{ route('home') }}">
                            <i class="fa fa-home"></i>
                            {{ Config::get('app.locale') == 'en' ? 'Home' : 'الرئيسية' }}
                        </a>
                    </li>
                    <li><span
                            class="fa fasl fa-angle-double-{{ Config::get('app.locale') == 'en' ? 'right' : 'left' }}"></span>
                    </li>
                    <li>
                        <p class="breadcrumb-item current-breadcrumb-item">
                            {{ Config::get('app.locale') == 'en' ? 'Catering' : 'خدماتنا' }}
                        </p>
                    </li>
                </ol>
            </div>
        </div>
        <section class="catering-para-section">
            <section>
                <div class="container service-gallery-container">
                    <div class="row service-gallery-row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 service_portfolio_text trans-protfolio-text">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 service_portfolio_text">
                            <div class="gallery-spec">
                                <p>
                                    {{ __('hold_event') }}
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 main-service-box-fill">
                            <div class="telephones">
                                <p>
                                    {{ $mainInformations['tel_number'] }}<br>
                                    {{ $mainInformations['tel_number1'] }}
                                </p>

                            </div>
                            <div class="verticalLine">
                            </div>
                            <div class="delivery-service">
                                <div class="delivary-vech">
                                    <img src="{{ asset('img/events/vech-services.png') }}" alt="" loading="lazy">
                                </div>
                                <div class="delivery-text">
                                    <p>
                                        {{ __('delivery_services') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @php
                            $reverse = 1;
                            $counter = 0;
                        @endphp
                        @foreach ($categories as $key => $category)
                            @php
                                if ($key % 2 == 0) {
                                    $reverse *= -1;
                                }
                                if ($key == 2) {
                                }
                                if ($key > 2) {
                                    $counter++;
                                }
                            @endphp
                            @if ($reverse == -1)
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 service_portfolio_text">
                                    <div class="service-text-box center"
                                        style="{{ $key == 2 || $counter == 4 ? 'background-color:#f1c50d' : '' }};">
                                        <a href="{{ route('category_menu.index', [$category['id']]) }}">
                                            {{ $category["name_$lang"] }}
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 service_portfolio_text"
                                    style="display: block;">
                                    <img src="{{ asset($category['image']) }}" alt="{{ $category['image_alt'] }}"
                                        loading="lazy" class="service-img">
                                </div>
                            @else
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 service_portfolio_text"
                                    style="display: block;">
                                    <img src="{{ asset($category['image']) }}" alt="" class="service-img"
                                        loading="lazy">
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 service_portfolio_text">
                                    <div class="service-text-box center"
                                        style="{{ $key == 2 || $counter == 4 ? 'background-color:#f1c50d' : '' }};">
                                        <a href="{{ route('category_menu.index', [$category['id']]) }}">
                                            {{ $category["name_$lang"] }}
                                        </a>
                                    </div>
                                </div>
                            @endif
                            @php
                                if ($counter == 4) {
                                    $counter = 0;
                                }
                            @endphp
                        @endforeach
                        <div
                            class="col-lg-6 col-md-6 col-sm-6 col-xs-12 service_portfolio_text service_portfolio_text_empty">
                        </div>
                        <div
                            class="col-lg-6 col-md-6 col-sm-6 col-xs-12 service_portfolio_text service_portfolio_text_empty">
                        </div>
                        {{-- <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 last-service_portfolio_text"
                            style="background-color: #8b562c;">
                            <p>
                                {{ __('choose_event') }}
                            </p>
                        </div> --}}
                    </div>
                </div>
            </section>
        </section>
    </div>
@endsection
