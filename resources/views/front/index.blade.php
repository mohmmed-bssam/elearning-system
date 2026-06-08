@extends('front.layouts.app')
@section('title')
    {{ __('front.home_page') }}
@endsection
@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5">
        <div class="owl-carousel header-carousel position-relative">
            @foreach ($sliders as $slider)
                <div class="owl-carousel-item position-relative">
                    <img class="img-fluid" src="{{ asset($slider->image->path) }}" alt="">
                    <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                        style="background: rgba(24, 29, 56, .7);">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-sm-10 col-lg-8">
                                    <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Best Online Courses
                                    </h5>
                                    <h1 class="display-3 text-white animated slideInDown">
                                        {{ $slider->getTransAttribute('title') }}</h1>
                                    <p class="fs-5 text-white mb-4 pb-2">{{ $slider->getTransAttribute('content') }}.</p>
                                    <a href="{{ route('front.slider_show', $slider->id) }}"
                                        class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Read
                                        More</a>
                                    <a href="" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Join
                                        Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <!-- Carousel End -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                @foreach ($services as $service)
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="service-item text-center pt-3">
                            <div class="p-4">
                                <i class="{{ $service->icon }}"></i>
                                <h5 class="mb-3">{{ $service->getTransAttribute('title') }}</h5>
                                <p>{{ $service->getTransAttribute('content') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="{{ asset($settings['about_logo']) }}"
                            alt="" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">About Us</h6>
                    <h1 class="mb-4">{{ $settings['about_title'] }}</h1>
                    <p class="mb-4">{{ $settings['about_content'] }}.</p>

                    <div class="row gy-2 gx-4 mb-4">
                        <div class="col-sm-6">
                            <p class="mb-0"><i
                                    class="fa fa-arrow-right text-primary me-2"></i>{{ $settings['ourMission_goal1'] }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i
                                    class="fa fa-arrow-right text-primary me-2"></i>{{ $settings['ourMission_goal2'] }}</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i
                                    class="fa fa-arrow-right text-primary me-2"></i>{{ $settings['ourMission_goal3'] }}
                            </p>
                        </div>

                    </div>
                    <a class="btn btn-primary py-3 px-5 mt-2" href="{{ route('front.about') }}">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Categories Start -->
    <div class="container-xxl py-5 category">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Categories</h6>
                <h1 class="mb-5">Courses Categories</h1>
            </div>
            <div class="row g-3">
                <div class="col-lg-7 col-md-6">
                    <div class="row g-3">

                        @foreach ($categories as $category)
                            <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.3s">
                                <a class="position-relative d-block overflow-hidden" href="">
                                    <img class="img-fluid" src="{{ asset($category->image->path) }}" alt="">
                                    <div class="bg-white text-center position-absolute bottom-0 end-0 py-2 px-3"
                                        style="margin: 1px;">
                                        <h5 class="m-0">{{ $category->getTransAttribute('title') }}</h5>
                                        <small
                                            class="text-primary">{{ App\Models\Course::where('category_id', $category->id)->count() }}
                                            Courses</small>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Categories Start -->


    <!-- Courses Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Courses</h6>
                <h1 class="mb-5">Popular Courses</h1>
            </div>
            <div class="row g-4 justify-content-center">
                @foreach ($courses as $course)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="course-item bg-light">
                            <div class="position-relative overflow-hidden">
                                <img class="img-fluid" src="{{ asset($course->image->path) }}" alt="">
                                <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
                                    <a href="{{ route('front.course_show', $course->id) }}"
                                        class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end"
                                        style="border-radius: 30px 0 0 30px;">Read More</a>
                                    <a href="#" class="flex-shrink-0 btn btn-sm btn-primary px-3"
                                        style="border-radius: 0 30px 30px 0;">Join Now</a>
                                </div>
                            </div>
                            <div class="text-center p-4 pb-0">
                                <h3 class="mb-0">${{ $course->price }}</h3>
                                <div class="mb-3">
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small class="fa fa-star text-primary"></small>
                                    <small>(123)</small>
                                </div>
                                <h5 class="mb-4">{{ $course->getTransAttribute('title') }}</h5>
                            </div>
                            <div class="d-flex border-top">
                                <small class="flex-fill text-center border-end py-2"><i
                                        class="fa fa-user-tie text-primary me-2"></i>{{ $course->teacher->name }}</small>
                                <small class="flex-fill text-center border-end py-2"><i
                                        class="fa fa-clock text-primary me-2"></i>{{ $course->hours }} Hrs</small>
                                <small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i>
                                    {{ App\Models\Enrollment::where('course_id', $course->id)->count() }}
                                    Students</small>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Courses End -->


    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Instructors</h6>
                <h1 class="mb-5">Expert Instructors</h1>
            </div>
            <div class="row g-4">
                @foreach ($teams as $team)
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item bg-light">
                            <div class="overflow-hidden">
                                <img class="img-fluid" src="{{ asset($team->image->path) }}" alt="">
                            </div>
                            <div class="position-relative d-flex justify-content-center" style="margin-top: -23px;">
                                <div class="bg-light d-flex justify-content-center pt-2 px-1">
                                    <a class="btn btn-sm-square btn-primary mx-1" href="{{ $team->fb }}"><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-sm-square btn-primary mx-1" href="{{ $team->x }}"><i
                                            class="fab fa-twitter"></i></a>
                                    <a class="btn btn-sm-square btn-primary mx-1" href="{{ $team->insta }}"><i
                                            class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                            <div class="text-center p-4">
                                <h5 class="mb-0">{{ $team->name }}</h5>
                                <small>{{ $team->job_title }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h6 class="section-title bg-white text-center text-primary px-3">Testimonial</h6>
                <h1 class="mb-5">Our Students Say!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel position-relative">
                @foreach ($testimonials as $testimonial)
                    <div class="testimonial-item text-center">
                        <img class="border rounded-circle p-2 mx-auto mb-3"
                            src="{{ asset($testimonial->image->path) }}" style="width: 80px; height: 80px;">
                        <h5 class="mb-0">{{ $testimonial->name }}</h5>
                        <p>{{ $testimonial->getTransAttribute('title') }}</p>
                        <div class="testimonial-text bg-light text-center p-4">
                            <p class="mb-0">{{ $testimonial->getTransAttribute('content') }}.</p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Testimonial End -->
@endsection
