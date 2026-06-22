@extends('front.layouts.app')

@section('title', 'Login')

@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-5">

            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h3 class="mb-0">Login</h3>
                </div>

                <div class="card-body p-4">

                    <x-auth-session-status class="mb-3" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

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

                        <div class="form-check mb-3">
                            <input
                                type="checkbox"
                                name="remember"
                                class="form-check-input">
                            <label class="form-check-label">
                                Remember Me
                            </label>
                        </div>

                        <button class="btn btn-primary w-100">
                            Login
                        </button>

                        <div class="text-center mt-3">
                            <a href="{{ route('register') }}">
                                Create New Account
                            </a>
                        </div>

                        @if (Route::has('password.request'))
                            <div class="text-center mt-2">
                                <a href="{{ route('password.request') }}">
                                    Forgot Password?
                                </a>
                            </div>
                        @endif

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

@endsection
