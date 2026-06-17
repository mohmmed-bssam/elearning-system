@extends('Student.layouts.app')

@section('title', 'Student Dashboard')

@section('header', 'Student Dashboard')

@section('content')

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <div class="bg-white rounded-xl shadow p-6 border-l-4 border-blue-500">
            <p class="text-gray-500">My Courses</p>
            <h2 class="text-4xl font-bold mt-2">
                {{ $coursesCount }}
            </h2>
        </div>

        <div class="bg-white rounded-xl shadow p-6 border-l-4 border-green-500">
            <p class="text-gray-500">Completed Courses</p>
            <h2 class="text-4xl font-bold mt-2">
                {{ $completedCourses }}
            </h2>
        </div>

        <div class="bg-white rounded-xl shadow p-6 border-l-4 border-yellow-500">
            <p class="text-gray-500">My Reviews</p>
            <h2 class="text-4xl font-bold mt-2">
                {{ $reviewsCount }}
            </h2>
        </div>

        <div class="bg-white rounded-xl shadow p-6 border-l-4 border-purple-500">
            <p class="text-gray-500">Active Courses</p>
            <h2 class="text-4xl font-bold mt-2">
                {{ $coursesCount - $completedCourses }}
            </h2>
        </div>

    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mt-8">

        <!-- Latest Courses -->
        <div class="bg-white rounded-xl shadow">

            <div class="border-b p-4">
                <h3 class="font-bold text-lg">
                    Latest Enrolled Courses
                </h3>
            </div>

            <div class="p-4">

                @forelse($enrollments as $enrollment)
                    <div class="flex justify-between items-center border-b py-3">

                        <div>
                            <h4 class="font-semibold">
                                {{ $enrollment->course->getTransAttribute('title') }}
                            </h4>

                            <p class="text-sm text-gray-500">
                                {{ $enrollment->created_at->diffForHumans() }}
                            </p>
                        </div>

                        @if ($enrollment->status == 'completed')
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs">
                                Completed
                            </span>
                        @elseif($enrollment->status == 'active')
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs">
                                Active
                            </span>
                        @else
                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs">
                                Pending
                            </span>
                        @endif

                    </div>

                @empty

                    <div class="text-center py-6 text-gray-500">
                        No enrolled courses yet.
                    </div>
                @endforelse

            </div>

        </div>

        <!-- Student Information -->
        <div class="bg-white rounded-xl shadow">

            <div class="border-b p-4">
                <h3 class="font-bold text-lg">
                    Student Information
                </h3>
            </div>

            <div class="p-6">

                <div class="flex items-center gap-4">

                    <div
                        class="w-16 h-16 rounded-full bg-blue-500 text-white flex items-center justify-center text-2xl font-bold">

                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <div>
                        <h4 class="font-bold text-lg">
                            {{ auth()->user()->name }}
                        </h4>

                        <p class="text-gray-500">
                            {{ auth()->user()->email }}
                        </p>
                    </div>

                </div>

                <div class="mt-6 space-y-3">

                    <div class="flex justify-between">
                        <span>Total Courses</span>
                        <span class="font-semibold">{{ $coursesCount }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Completed Courses</span>
                        <span class="font-semibold">{{ $completedCourses }}</span>
                    </div>

                    <div class="flex justify-between">
                        <span>Total Reviews</span>
                        <span class="font-semibold">{{ $reviewsCount }}</span>
                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
