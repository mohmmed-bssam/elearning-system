@extends('teacher.layouts.app')

@section('content')

<div class="container-fluid py-4">

    <div class="card border-0 shadow-lg">

        <div class="card-header text-center py-5 bg-success text-white">

            <img
                src="{{ $user->image ? asset($user->image) : asset('images/default-user.png') }}"
                class="rounded-circle border border-4 border-white shadow"
                width="130"
                height="130"
                style="object-fit: cover;">

            <h3 class="mt-3 mb-1">{{ $user->name }}</h3>

            <span class="badge bg-light text-dark px-3 py-2">
                Teacher
            </span>

        </div>

        <div class="card-body p-5">

            <form action="{{ route('profile.update') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PATCH')

                <div class="row">

                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold">
                            Full Name
                        </label>

                        <input type="text"
                               name="name"
                               value="{{ old('name',$user->name) }}"
                               class="form-control">
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold">
                            Email Address
                        </label>

                        <input type="email"
                               name="email"
                               value="{{ old('email',$user->email) }}"
                               class="form-control">
                    </div>

                    <div class="col-12 mb-4">
                        <label class="form-label fw-bold">
                            Profile Image
                        </label>

                        <input type="file"
                               name="image"
                               class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">
                            Member Since
                        </label>

                        <input type="text"
                               class="form-control"
                               value="{{ $user->created_at->format('d M Y') }}"
                               readonly>
                    </div>

                </div>

                <div class="text-end mt-4">
                    <button class="btn btn-success px-5">
                        Save Changes
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

@endsection
