@extends('front.layouts.app')

@section('title', 'Register')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5">

            <div class="card shadow border-0">
                <div class="card-header bg-primary text-center">
                    <h3 class="mb-0 text-dark">Register</h3>
                </div>

                <div class="card-body p-4">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                class="form-control"
                                required
                                autofocus>
                            <x-input-error :messages="$errors->get('name')" class="mt-2 text-danger" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="form-control"
                                required>
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required>
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input
                                type="password"
                                name="password_confirmation"
                                class="form-control"
                                required>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Register
                        </button>

                        <div class="text-center mt-3">
                            <a href="{{ route('login') }}">
                                Already registered?
                            </a>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
