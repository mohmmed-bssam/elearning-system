@extends('Teacher.layouts.app')


@section('title')
    My Courses
@endsection


@section('content')
<div class="min-h-screen bg-gray-50 py-10">

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Card -->
        <div class="bg-white shadow-lg rounded-2xl overflow-hidden">

            <!-- Header -->
            <div class="border-b px-6 py-4 flex items-center justify-between bg-gray-50">
                <h2 class="text-lg font-bold text-gray-800">
                    ➕ Create New Lesson
                </h2>

                <a href="{{ route('teacher.lessons.index') }}"
                   class="text-sm bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                    All Lessons
                </a>
            </div>

            <!-- Form Body -->
            <div class="p-6">

                <form method="POST" action="{{ route('teacher.lessons.store') }}">
                    @csrf

                    <div class="space-y-6">

                        <!-- Form Fields -->
                        <div class="bg-gray-50 p-5 rounded-xl border">
                            @include('teacher.lessons._form')
                        </div>

                        <!-- Submit -->
                        <div class="flex justify-end">
                            <button type="submit"
                                class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl shadow-md transition">
                                🚀 Create Lesson
                            </button>
                        </div>

                    </div>

                </form>

            </div>

        </div>
    </div>

</div>
@endsection

