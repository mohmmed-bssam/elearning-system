@extends('student.layouts.app')

@section('title', 'Rate Course')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-2xl font-bold mb-6">
            ⭐ Rate Course
        </h2>

        <div class="mb-6">
            <h3 class="text-lg font-semibold">
                {{ $course->getTransAttribute('title') }}
            </h3>
        </div>

        <form action="{{ route('student.reviews.store') }}" method="POST">
            @csrf

            <input type="hidden"
                name="course_id"
                value="{{ $course->id }}">

            <div class="mb-4">

                <label class="block mb-2 font-semibold">
                    Rating
                </label>

                <select name="rate"
                    class="w-full border rounded-lg p-3">

                    <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
                    <option value="4">⭐⭐⭐⭐ Very Good</option>
                    <option value="3">⭐⭐⭐ Good</option>
                    <option value="2">⭐⭐ Fair</option>
                    <option value="1">⭐ Poor</option>

                </select>

                @error('rate')
                    <span class="text-red-500 text-sm">
                        {{ $message }}
                    </span>
                @enderror

            </div>

            <div class="mb-6">

                <label class="block mb-2 font-semibold">
                    Your Review
                </label>

                <textarea
                    name="comment"
                    rows="5"
                    class="w-full border rounded-lg p-3"
                >{{ old('comment') }}</textarea>

                @error('comment')
                    <span class="text-red-500 text-sm">
                        {{ $message }}
                    </span>
                @enderror

            </div>

            <button
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-lg">

                Submit Rating

            </button>

        </form>

    </div>

</div>

@endsection
