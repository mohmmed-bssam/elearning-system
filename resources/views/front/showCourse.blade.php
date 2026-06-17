@extends('front.layouts.app')
@section('title')
    {{ __('front.show_course') }}
@endsection
@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">

                <img src="{{ asset($course->image->path) }}" class="img-fluid rounded mb-4"
                    alt="{{ $course->getTransAttribute('title') }}">

                <h1>
                    {{ $course->getTransAttribute('title') }}
                </h1>

                <p class="mt-3">
                    {{ $course->getTransAttribute('description') }}
                </p>
                <div class="mb-3">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= round($course->reviews_avg_rate ?? 0))
                            <i class="fa fa-star text-warning"></i>
                        @else
                            <i class="fa fa-star text-secondary"></i>
                        @endif
                    @endfor

                    <span>({{ $course->reviews_count }})</span>
                </div>
                <h4>Price: ${{ $course->price }}</h4>
                <h4>Teacher: {{ $course->teacher->name }}</h4>

                <div>
                    <a href="{{ route('checkout', $course) }}" class="flex-shrink-0 btn btn-sm btn-primary px-3"
                        style="border-radius: 0 30px 30px 0;">Join Now</a>

                </div>


            </div>
        </div>
    </div>
@endsection
