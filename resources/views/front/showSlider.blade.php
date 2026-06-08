@extends('front.layouts.app')
@section('title')
    {{ __('front.show_slider') }}
@endsection
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">

            <img src="{{ asset($slider->image->path) }}"
                 class="img-fluid rounded mb-4"
                 alt="{{ $slider->getTransAttribute('title') }}">

            <h1>
                {{ $slider->getTransAttribute('title') }}
            </h1>

            <p class="mt-3">
                {{ $slider->getTransAttribute('content') }}
            </p>

        </div>
    </div>
</div>
@endsection
