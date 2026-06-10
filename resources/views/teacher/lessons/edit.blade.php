@extends('Teacher.layouts.app')

@section('title')
    Edit Lesson
@endsection

@section('header')
<div class="flex items-center justify-between">

    <h2 class="text-xl font-bold text-gray-800">
        ✏️ Edit Lesson
    </h2>

    <a href="{{ route('teacher.lessons.index') }}"
       class="bg-gray-800 hover:bg-gray-700 text-white px-5 py-2 rounded-lg transition">
        ← Back to Lessons
    </a>

</div>
@endsection

@section('content')

<div class="min-h-screen bg-gray-50 py-10">

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Card -->
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden">

            <!-- Header -->
            <div class="border-b px-6 py-4 bg-gray-50">
                <h2 class="text-lg font-bold text-gray-800">
                    ✏️ Update Lesson Details
                </h2>
            </div>

            <!-- Form -->
            <div class="p-6">

                <form method="POST" action="{{ route('teacher.lessons.update', $lesson->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">

                        <!-- Form Fields -->
                        <div class="bg-gray-50 p-5 rounded-xl border">
                            @include('teacher.lessons._form')
                        </div>

                        <!-- Submit -->
                        <div class="flex justify-end gap-3">

                            <a href="{{ route('teacher.lessons.index') }}"
                               class="px-5 py-3 rounded-xl bg-gray-200 hover:bg-gray-300 transition">
                                Cancel
                            </a>

                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl shadow-md transition">
                                💾 Update Lesson
                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection
