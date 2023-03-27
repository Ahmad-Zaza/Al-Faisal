<!DOCTYPE html>
<html lang="{{ $lang }}">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset($settings['favicon']) }}" type="image/png" sizes="16x16">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/al-faisal-logo.jpg') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="{{ $settings['description'] }}">
    <meta name="keywords" content="{{ $settings['keywords'] }}">






    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Gothic:wght@400;700;800&display=swap" rel="stylesheet" />
    <link type="text/css" rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.6.0-beta.1/css/lightgallery.min.css" />

    <!-- lightgallery plugins -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.5.0/css/lg-pager.min.css"
        integrity="sha512-F4gJy0MBz7nwvFMIYNeap+CXaVQY0Y9pwsn/Up4mvOfjYD50u+8D7jIVZBkeHV7hZ2xjhY8uJRMkRzWQBvznRw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link type="text/css" rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.6.0-beta.1/css/lg-zoom.min.css" />
    <link type="text/css" rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.6.0-beta.1/css/lg-thumbnail.min.css" />

    <!-- Vendor CSS Files -->
    <link href="{{ asset('css/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/owl.theme.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
        integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="text/css" rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.5.0/css/brands.min.css" />
    @if ($lang == 'ar')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.rtl.min.css"
            integrity="sha384-gXt9imSW0VcJVHezoNQsP+TNrjYXoGcrqBZJpry9zJt8PCQjobwmhMGaDHTASo9N" crossorigin="anonymous">
        <link href="{{ asset('css/style-rtl.css') }}" rel="stylesheet" type="text/css" media="all" />
    @endif

</head>
@php $_right = ($lang=="ar"?"left":"right")@endphp
@php $_r = ($lang=="ar"?"r":"l")@endphp
@php $_l = ($lang=="ar"?"l":"r")@endphp
@php $_left = ($lang=="ar"?"right":"left")@endphp

<body lang="{{ $lang }}">
    <div class="loader" id="loader">
        <div></div>
    </div>
    <div class="wrapper">
        <!-- Navbar Section -->
        <header id="header" class="fixed-top d-flex align-items-center">
            <nav id="navbar" class="navbar navbar-expand-lg">
                <div class="container-fluid navbar-container">
                    <a class="navbar-brand navbar-right" href="{{ route('home') }}">
                        <img class="companyLogo" alt="CompanyLogo" src="{{ asset('img/al-faisal-logo.jpg') }}"
                            loading="lazy">
                    </a>
                    <button class="navbar-toggler ml-auto hidden-sm-up float-xs-right" type="button"
                        data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars" style="color:#8b562c; font-size:28px;" aria-hidden="true"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">

                        <ul class="navbar-nav">
                            <li class="nav-item main-nav-item">
                                <span id="nav-item" class="nav-link vertical-nav-space"
                                    style="color: #8b562c; font-weight:lighter;">&#10072;</span>
                            </li>
                            @foreach ($menu as $main_menu)
                                @php
                                    $href = config('app.url') . '' . $main_menu['section'];
                                    if (Request::fullUrl() == $href) {
                                        $str = $main_menu["name_$lang"];
                                    }
                                @endphp
                                @if ($main_menu->is_download_menu == 1)
                                    <li class="nav-item main-nav-item" id="drop-down-nav">
                                        <a id="nav-item" class="nav-link" href="{{ route('our_menu') }}"
                                            target="_blank">
                                            {{ $main_menu["name_$lang"] }}<i class="fa fa-download downolad-nav-item"
                                                aria-hidden="true"></i>
                                        </a>
                                    </li>
                                @elseif($main_menu->is_drop_down_menu == 1)
                                    <li id="drop-down-nav"
                                        class="nav-item dropdown nav-dropdown-menu main-nav-item {{ Request::fullUrl() == $href ? 'color-li' : '' }}">
                                        <a id="drop-down-nav-link"
                                            class="nav-link  dropdown-toggle {{ Request::fullUrl() == $href ? 'active-nav-link' : '' }} {{ Route::currentRouteName() == 'category_menu.index' ? 'active-nav-link' : '' }}"
                                            href="{{ route('service_events.index') }}" data-bs-toggle="dropdown">
                                            {{ $main_menu["name_$lang"] }}</a>
                                        <ul class="dropdown-menu">
                                            @foreach ($catering_categories as $catering_category)
                                                <li><a class="dropdown-item"
                                                        href="{{ route('category_menu.index', [$catering_category['id']]) }}">{{ $catering_category["name_$lang"] }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div
                                            class="overlay-nav-item {{ Request::fullUrl() == $href ? 'active-overlay-nav-item' : '' }} {{ Route::currentRouteName() == 'category_menu.index' ? 'active-overlay-nav-item' : '' }}">

                                        </div>
                                    </li>
                                @else
                                    <li class="nav-item main-nav-item ">
                                        <div class="overlay {{ Request::fullUrl() == $href ? 'color-li' : '' }}">
                                            <a id="nav-item"
                                                class="nav-link {{ Request::fullUrl() == $href ? 'active-nav-link' : '' }}"
                                                href="{{ $href }}">
                                                {{ $main_menu["name_$lang"] }}
                                            </a>
                                        </div>
                                        <div
                                            class="overlay-nav-item {{ Request::fullUrl() == $href ? 'active-overlay-nav-item' : '' }}">
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        <div class="navbar-nav lang-nav-ul">
                            <li class="nav-item active-lang-en">
                                <a id="nav-item" class="nav-link" href="{{ route('change_lang', ['en']) }}"
                                    style="color:#ffffff ;">{{ __('en_lang') }}</a>
                            </li>
                            <li class="nav-item active-lang-ar">
                                <a id="nav-item" class="nav-link"
                                    href="{{ route('change_lang', ['ar']) }}">{{ __('ar_lang') }}</a>
                            </li>
                        </div>
                    </div>

                </div>
            </nav>
        </header>

        <div class="main">
            @yield('content')
        </div> <!-- Main -->
    </div><!-- Wrapper -->
    <footer id="footer">
        <div class="container text-center footer-container">
            {{ __('rights') }}
            <br>
            <div class="voila-made">
                Made with love by <a class="voila-name">ASK</a>
            </div>
        </div>
    </footer>

    <!-- Jquery and Js Plugins -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/aos.js') }}"></script>
    <script type="text/javascript" src="{{ asset('css/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.5.0/js/brands.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.6.0-beta.1/lightgallery.min.js"></script>
    <!-- lightgallery plugins -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.5.0/plugins/pager/lg-pager.min.js"
        integrity="sha512-smL/gQDLzDjVmL1/tndmYmRLcSK1NibZsCkBeGk+bFwuJiIqv3Wck10bkTwlU8Bj99yPiMYroEvzSfD2Uxuy0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.6.0-beta.1/plugins/thumbnail/lg-thumbnail.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/2.6.0-beta.1/plugins/zoom/lg-zoom.min.js"></script>
    <script>
        AOS.init({
            offset: 10,
        });
        /*scrolling banner*/
        function openNav() {
            document.getElementById("prod-cat-nav").style.width = "100%";
            console.log("open====", document.getElementById("nav").style.width)
        }

        function closeNav() {
            document.getElementById("prod-cat-nav").style.width = "0%";
        }
        document.addEventListener("DOMContentLoaded", function() {
            // make it as accordion for smaller screens
            if (window.innerWidth > 992) {

                document.querySelectorAll('.navbar .nav-item').forEach(function(everyitem) {

                    everyitem.addEventListener('mouseover', function(e) {

                        let el_link = this.querySelector('a[data-bs-toggle]');

                        if (el_link != null) {
                            let nextEl = el_link.nextElementSibling;
                            el_link.classList.add('show');
                            nextEl.classList.add('show');
                        }

                    });
                    everyitem.addEventListener('mouseleave', function(e) {
                        let el_link = this.querySelector('a[data-bs-toggle]');

                        if (el_link != null) {
                            let nextEl = el_link.nextElementSibling;
                            el_link.classList.remove('show');
                            nextEl.classList.remove('show');
                        }


                    })
                });

            }
            // end if innerWidth
        });
    </script>
    <script>
        $(document).ready(function() {
            "use strict";
            $('#carouselExampleControls1').carousel({
                interval: 2000
            });
            $('#carouselExampleControls2').carousel({
                interval: 2000
            });
            $('.carousel').carousel('cycle');
            $("#main-owl-carousel").owlCarousel({
                stagePadding: 0,
                loop: true,
                margin: 10,
                responsiveClass: true,
                slideBy: 3,
                responsive: {
                    0: {
                        items: 1,
                        nav: false
                    },
                    826: {
                        items: 2,
                        nav: false
                    },
                    1000: {
                        items: 2,
                        nav: false,
                        loop: true
                    },
                    1200: {
                        items: 3,
                        nav: false,
                        loop: true
                    },
                }
            });
            $('#drop-down-nav').on('click', function(e) {
                window.location.href = $("#drop-down-nav-link").attr("href");
            });

            $('#youtubeVideo').on('hidden.bs.modal', function() {
                var $this = $(this).find('iframe'),
                    tempSrc = $this.attr('src');
                $this.attr('src', "");
                $this.attr('src', tempSrc);
            });
        });
    </script>
    <script>
        (function() {
            "use strict";
            window.addEventListener('DOMContentLoaded', (event) => {
                console.log('DOM fully loaded and parsed');
                document.querySelector(
                    "#loader").style.display = "none";
            });

            function scrollFunction() {
                if (document.documentElement.scrollTop > 20) {
                    document.getElementById("navbar").style.opacity = 0.8;
                    document.getElementsByClassName("companyLogo")[0].style.maxWidth = "55px";
                } else {
                    document.getElementById("navbar").style.opacity = 1;
                    document.getElementsByClassName("companyLogo")[0].style.maxWidth = "none";
                }
            }

            window.onscroll = function() {
                scrollFunction()
            };

            if ($(".number").offset() !== undefined) {
                $(window).scroll(testScroll);
            }
            var viewed = false;

            function isScrolledIntoView(elem) {
                var docViewTop = $(window).scrollTop();
                var docViewBottom = docViewTop + $(window).height();

                var elemTop = $(elem).offset().top;
                var elemBottom = elemTop + $(elem).height();

                return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
            }

            function testScroll() {
                if (isScrolledIntoView($(".number")) && !viewed) {
                    viewed = true;
                    $('.num-value').each(function() {
                        $(this).prop('Counter', 0).animate({
                            Counter: $(this).text()
                        }, {
                            duration: 3000,
                            easing: 'swing',
                            step: function(now) {
                                $(this).text(Math.ceil(now));
                            }
                        });
                    });
                }
            }
        })()
    </script>
    <script type="text/javascript">
        lightGallery(document.getElementById('lightgallery'), {
            plugins: [lgZoom, lgThumbnail, lgPager],
            selector: '.gallery_item',
            // licenseKey: 'your_license_key',
            speed: 500,
            counter: true,
            numberOfSlideItemsInDom: 5,
            // ... other settings
        });

        // Get the video
        var video = document.getElementById("faisal_video");
        var btn = document.getElementById("video_btn");
        // Pause and play the video, and change the button text
        function myFunction() {
            if (video.requestFullscreen) {
                video.requestFullscreen();
            } else if (video.mozRequestFullScreen) {
                video.mozRequestFullScreen();
            } else if (video.webkitRequestFullscreen) {
                video.webkitRequestFullscreen();
            } else if (video.msRequestFullscreen) {
                video.msRequestFullscreen();
            }
        }
    </script>
</body>

</html>
