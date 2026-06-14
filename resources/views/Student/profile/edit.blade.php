@extends('student.layouts.app')

@section('content')

<div class="container py-4">

    <!-- Cover -->
    <div class="card border-0 shadow rounded-4 overflow-hidden mb-4">

        <div style="
            height:220px;
            background:linear-gradient(135deg,#4f46e5,#06b6d4);
        ">
        </div>

        <div class="text-center position-relative pb-4">

            <img src="{{ $user->image ? asset($user->image) : asset('profiles/default-user.jpg') }}"
                 class="rounded-circle border border-5 border-white shadow"
                 width="170"
                 height="170"
                 style="
                    object-fit:cover;
                    margin-top:-85px;
                 ">

            <h2 class="fw-bold mt-3 mb-1">
                {{ $user->name }}
            </h2>

            <span class="badge bg-primary px-3 py-2">
                {{ ucfirst($user->role) }}
            </span>

        </div>

    </div>

    <div class="row">

        <!-- Profile Info -->
        <div class="col-lg-8 mb-4">

            <div class="card border-0 shadow rounded-4">
                <div class="card-body p-4">

                    <h4 class="fw-bold mb-4">
                        Personal Information
                    </h4>

                    <form method="POST"
                          action="{{ route('profile.update') }}"
                          enctype="multipart/form-data">

                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Full Name
                            </label>

                            <input type="text"
                                   name="name"
                                   value="{{ $user->name }}"
                                   class="form-control form-control-lg">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Email Address
                            </label>

                            <input type="email"
                                   name="email"
                                   value="{{ $user->email }}"
                                   class="form-control form-control-lg">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Profile Image
                            </label>

                            <input type="file"
                                   name="image"
                                   class="form-control">
                        </div>

                        <button class="btn btn-primary px-5">
                            Save Changes
                        </button>

                    </form>

                </div>
            </div>

        </div>

        <!-- Side Card -->
        <div class="col-lg-4">

            <div class="card border-0 shadow rounded-4">
                <div class="card-body text-center p-4">

                    <img src="{{ $user->image ? asset($user->image) : asset('profiles/default-user.jpg') }}"
                         class="rounded-circle mb-3"
                         width="100"
                         height="100"
                         style="object-fit:cover">

                    <h5 class="fw-bold">
                        {{ $user->name }}
                    </h5>

                    <p class="text-muted">
                        {{ $user->email }}
                    </p>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <span>Role</span>
                        <strong>{{ ucfirst($user->role) }}</strong>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

@endsection
