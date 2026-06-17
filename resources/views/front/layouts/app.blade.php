<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'eLearning')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="{{ asset('assets/img/favicon.ico') }}" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css') " rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    {{-- Font --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    @yield('css')
    @if (app()->getLocale() == 'ar')
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic:wght@100..900&display=swap');

            body {
                direction: rtl;
                text-align: right;
                font-family: 'Cairo', sans-serif;
            }

            .owl-carousel {
                direction: ltr;
            }

            .text-lg-start {
                text-align: right !important;
            }

            h6,
            .h6,
            h5,
            .h5,
            h4,
            .h4,
            h3,
            .h3,
            h2,
            .h2,
            h1,
            .h1 {
                font-family: 'Cairo', sans-serif;

            }

            .breadcrumb-item+.breadcrumb-item::before {
                float: right;
                padding-right: .5rem;
            }
        </style>
    @endif
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>eLEARNING</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="{{ route('front.index') }}" class="nav-item nav-link {{ Request()->routeIs('front.index') ? 'active' : '' }}">Home</a>
                <a href="{{ route('front.about') }}" class="nav-item nav-link {{ Request()->routeIs('front.about') ? 'active' : '' }}">About</a>
                <a href="{{ route('front.course') }}" class="nav-item nav-link {{ Request()->routeIs('front.course') ? 'active' : '' }}">Courses</a>
                <a href="{{ route('front.team') }}" class="nav-item nav-link {{ Request()->routeIs('front.team') ? 'active' : '' }}">Our Team</a>
                <a href="{{ route('front.testimonial') }}" class="nav-item nav-link {{ Request()->routeIs('front.testimonial') ? 'active' : '' }}">Testimonial</a>

                <a href="{{ route('front.contact') }}" class="nav-item nav-link {{ Request()->routeIs('front.contact') ? 'active' : '' }}">Contact</a>
                @guest
                    <a href="{{ route('login') }}"
                        class="nav-item nav-link {{ Request()->routeIs('login') ? 'active' : '' }}">Login</a>
                    <a href="{{ route('register') }}"
                        class="nav-item nav-link {{ Request()->routeIs('register') ? 'active' : '' }}">Register</a>

                @endguest
                @auth
                    @if (Auth::user()->role == 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                            class="nav-item nav-link {{ Request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
                    @elseif (Auth::user()->role == 'teacher')
                        <a href="{{ route('teacher.dashboard') }}"
                            class="nav-item nav-link {{ Request()->routeIs('teacher.dashboard') ? 'active' : '' }}">Dashboard</a>
                    @else
                        <a href="{{ route('student.dashboard') }}"
                            class="nav-item nav-link {{ Request()->routeIs('student.dashboard') ? 'active' : '' }}">Dashboard</a>
                    @endif
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="nav-item nav-link {{ Request()->routeIs('logout') ? 'active' : '' }}">Logout</a>

                @endauth

                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    @if ($localeCode != app()->getLocale())
                        <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                            class="nav-item nav-link">{{ $properties['native'] }}</a>
                    @endif
                @endforeach

            </div>
            <a href="{{ route('front.course') }}" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Join Now<i
                    class="fa fa-arrow-right ms-3"></i></a>

    </div>
    </nav>
    <!-- Navbar End -->

    @yield('content')

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Quick Link</h4>
                    <a class="btn btn-link" href="{{ route('front.about') }}">About Us</a>
                    <a class="btn btn-link" href="{{ route('front.contact') }}">Contact Us</a>
                    <a class="btn btn-link" href="">Privacy Policy</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="">FAQs & Help</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>{{ $settings['address'] }}</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>{{ $settings['call_us'] }}</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>{{ $settings['mail_us'] }}</p>
                    <div class="d-flex pt-2">
                        @isset($settings['x'])
                            <a class="btn btn-outline-light btn-social" href="{{ $settings['x'] }}"><i
                                    class="fab fa-twitter"></i></a>
                        @endisset

                        @isset($settings['facebook'])
                            <a class="btn btn-outline-light btn-social" href="{{ $settings['facebook'] }}"><i
                                    class="fab fa-facebook-f"></i></a>
                        @endisset

                        @isset($settings['youtube'])
                            <a class="btn btn-outline-light btn-social" href="{{ $settings['youtube'] }}"><i
                                    class="fab fa-youtube"></i></a>
                        @endisset
                        @isset($settings['linkedin'])
                            <a class="btn btn-outline-light btn-social" href="{{ $settings['linkedin'] }}"><i
                                    class="fab fa-linkedin-in"></i></a>
                        @endisset

                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Gallery</h4>
                    <div class="row g-2 pt-2">
                        @foreach ($galleries as $gallery)
                            <div class="col-4">
                                <img class="img-fluid bg-light p-1" src="{{ asset($gallery->image) }}"
                                    alt="Gallery Image">
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Newsletter</h4>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <form action="{{ route('front.subscription') }}" method="post">
                            @csrf

                            <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text"
                                placeholder="Your email" name="email">
                            <button type="submit"
                                class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved.

                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a><br><br>
                        Distributed By <a class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="">Home</a>
                            <a href="">Cookies</a>
                            <a href="">Help</a>
                            <a href="">FQAs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
