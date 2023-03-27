@extends('layouts.app')

@php
$title = '';
foreach ($seo as $s) {
    if ($s->model == 'about-us') {
        $title = $s["title_$lang"];
    }
}
@endphp
@section('title', $title)

@section('content')
    <div class="main-about-us">
        <div class="container-fluid about-us-highlight inner-highlight-container">
            <img class="about-highlight inner-highlight-img" src="{{ asset($Highlight['image']) }}"
                alt="{{ $Highlight['image_alt'] }}" loading="lazy">
            <h5 class="category-overlay-text">
                {{ Config::get('app.locale') == 'en' ? 'About Us' : 'من نحن' }}
            </h5>
            <div class="overlay-cover-light"></div>
            <ol class="breadcrumb highlight-overlay-text">
                <li>
                    <a class="breadcrumb-item breadcrumb-item-home" href="{{ route('home') }}">
                        {{ Config::get('app.locale') == 'en' ? 'Home' : 'الرئيسية' }}
                    </a>
                </li>
                <li><span class="fa fasl fa-angle-double-{{ Config::get('app.locale') == 'en' ? 'right' : 'left' }}"></span>
                </li>
                <li>
                    <p class="breadcrumb-item current-breadcrumb-item">
                        {{ Config::get('app.locale') == 'en' ? 'About Us' : 'من نحن' }}
                    </p>
                </li>
            </ol>
        </div>
        <div class="container text-about-container">
        </div>
        <div class="row text-about-row">
            <div class="col about-us-textarea">
                <div class="about-us-background-text main-about-us-background-text">
                    <div class="overlay-good"></div>
                    <h3 class="f-good">
                        {!! $aboutUsInfo["first_box_title_$lang"] !!}
                    </h3>
                    <h3 class="s-good">
                        {!! $aboutUsInfo["second_box_title_$lang"] !!}
                    </h3>
                </div>
                <div id="innerAboutUsField" class="innerAboutUsField main-inner-aboutUs">
                    {!! $aboutUsInfo["first_box_para_$lang"] !!}
                </div>
            </div>
            <div class="col our-vision-textare">
                <img class="vision-img" src="{{ asset($aboutUsInfo['image']) }}" alt="{{ $aboutUsInfo['image_alt'] }}"
                    loading="lazy">
                <div class="innerVisionField">
                    {!! $aboutUsInfo["second_box_para_$lang"] !!}
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="padding: 0;">
        <div class="row cover-about-page-row">
            <img class="cover-about-page-img" src="{{ asset($aboutUsInfo['image_1']) }}"
                alt="{{ $aboutUsInfo['image_alt_1'] }}" loading="lazy">
        </div>
    </div>
@endsection
