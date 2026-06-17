@extends('front.layouts.app')
@section('title')
    {{ __('Course Checkout') }}
@endsection
@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5 page-header">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <h1 class="display-3 text-white animated slideInDown">Course Checkout</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-center">
                            <li class="breadcrumb-item"><a class="text-white" href="{{ route('front.index') }}">Home</a></li>
                            <li class="breadcrumb-item text-white active" aria-current="page">Checkout</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
    <!-- Join Start -->
    <div class="container-xxl py-5">
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-8">

                <div class="card border-0 shadow">

                    <div class="card-header bg-primary text-white py-3">
                        <h3 class="mb-0">
                            Checkout
                        </h3>
                    </div>

                    <div class="card-body p-4">

                        <h4 class="fw-bold mb-4">
                            {{ $course->getTransAttribute('title') }}
                        </h4>

                        <div class="row mb-4">

                            <div class="col-md-6">
                                <p>
                                    <strong>Teacher:</strong><br>
                                    {{ $course->teacher->name }}
                                </p>
                            </div>

                            <div class="col-md-6">
                                <p>
                                    <strong>Duration:</strong><br>
                                    {{ $course->hours }} Hours
                                </p>
                            </div>

                        </div>

                        <div class="alert alert-info">

                            <h5 class="mb-3">
                                Course Price
                            </h5>

                            <h2 class="text-primary fw-bold">
                                ${{ $course->price }}
                            </h2>

                        </div>

                        <div class="border rounded p-4 mb-4">

                            <h5 class="mb-3">
                                Payment Method
                            </h5>

                            <div class="form-check">

                                <input class="form-check-input"
                                    type="radio"
                                    checked>

                                <label class="form-check-label">
                                    Cash Payment
                                </label>

                            </div>

                            <small class="text-muted">
                                Your enrollment request will be reviewed by the administrator before activation.
                            </small>

                        </div>

                        <form method="POST"
                            action="{{ route('checkout.store', $course) }}">

                            @csrf

                            <button type="submit"
                                class="btn btn-success btn-lg w-100">

                                Confirm Enrollment

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
</div>
   
    <!-- Join End -->
@endsection
