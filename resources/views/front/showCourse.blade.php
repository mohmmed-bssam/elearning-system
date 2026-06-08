@extends('front.layouts.app')
@section('title')
    {{ __('front.show_course') }}
@endsection
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">

            <img src="{{ asset($course->image->path) }}"
                 class="img-fluid rounded mb-4"
                 alt="{{ $course->getTransAttribute('title') }}">

            <h1>
                {{ $course->getTransAttribute('title') }}
            </h1>

            <p class="mt-3">
                {{ $course->getTransAttribute('description') }}
            </p>
            <h4>Price: ${{ $course->price }}</h4>
            <h4>Teacher: {{ $course->teacher->name }}</h4>


        </div>
    </div>
</div>
@endsection
