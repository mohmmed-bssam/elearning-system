@extends('Teacher.layouts.app')

@section('title')
Teacher Dashboard
@endsection

@section('content')

<div class="p-6">

    <h1 class="text-3xl font-bold text-gray-800 mb-6">
        👨‍🏫 Teacher Dashboard
    </h1>
  

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="text-gray-500">Courses</h2>
            <p class="text-3xl font-bold text-blue-600">
                {{ $coursesCount ?? 0 }}
            </p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="text-gray-500">Lessons</h2>
            <p class="text-3xl font-bold text-green-600">
                {{ $lessonsCount ?? 0 }}
            </p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="text-gray-500">Students</h2>
            <p class="text-3xl font-bold text-yellow-500">
                {{ $studentsCount ?? 0 }}
            </p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="text-gray-500">Ratings</h2>
            <p class="text-3xl font-bold text-yellow-500">
                {{ $ratingsCount ?? 0 }}
            </p>
        </div>

    </div>

    <!-- Quick actions -->
    <div class="mt-10 bg-white p-6 rounded-2xl shadow">

        <h2 class="text-xl font-bold mb-4">⚡ Quick Actions</h2>

        <div class="flex gap-4">

            <a href="{{ route('teacher.lessons.index') }}"
               class="bg-blue-600 text-white px-5 py-2 rounded-xl hover:bg-blue-700">
                📚 Manage Lessons
            </a>

            <a href="{{ route('teacher.students') }}"
               class="bg-gray-800 text-white px-5 py-2 rounded-xl hover:bg-gray-700">
                🎓 View Students
            </a>

        </div>

    </div>

</div>

@endsection
