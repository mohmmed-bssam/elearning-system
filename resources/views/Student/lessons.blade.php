@extends('Student.layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6 text-gray-800">
        📚 Courses & Lessons
    </h1>

    <div class="space-y-6">

        @foreach ($courses as $course)
            <div x-data="{ open: false }" class="bg-white shadow-md rounded-2xl overflow-hidden border border-gray-100">

                <!-- Course Header -->
                <div @click="open = !open"
                    class="p-5 flex justify-between items-center cursor-pointer bg-gradient-to-r from-blue-50 to-white hover:from-blue-100 transition">

                    <div class="flex items-start justify-between w-full">

                        <!-- Left info -->
                        <div>
                            <h2 class="font-bold text-xl text-gray-800">
                                📘 {{ $course->getTransAttribute('title') }}
                            </h2>
                            <p>
                                Teacher: {{ $course->teacher?->name }}
                            </p>
                            <p class="text-sm text-gray-500 mt-1">
                                {{ $course->lessons->count() }} Lessons
                            </p>
                        </div>

                        <!-- Right actions -->
                        <div class="flex items-center gap-3">

                            <div>
                                <a href="{{ route('student.reviews.create', $course->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">

                                    ⭐ Rate Course

                                </a>
                            </div>
                            <div class="text-gray-600 text-xl">
                                <span x-show="!open">▾</span>
                                <span x-show="open">▴</span>
                            </div>

                        </div>

                    </div>

                    <div class="text-gray-600 text-xl">
                        <span x-show="!open">▾</span>
                        <span x-show="open">▴</span>
                    </div>

                </div>

                <!-- Lessons -->
                <div x-show="open" x-transition class="bg-gray-50 p-4 space-y-3">

                    @forelse($course->lessons as $lesson)
                        <div
                            class="bg-white p-4 rounded-xl shadow-sm hover:shadow-md transition flex justify-between items-center">

                            <!-- Left -->
                            <div>
                                <h3 class="font-semibold text-gray-800">
                                    🎬 {{ $lesson->getTransAttribute('title') }}
                                </h3>

                                <div class="text-sm text-gray-500 mt-1">
                                    Order: <span class="font-medium">{{ $lesson->lesson_order }}</span>
                                </div>
                            </div>

                            <!-- Middle -->
                            <div>
                                <a href="{{ $lesson->video_url }}" target="_blank"
                                    class="px-3 py-1 bg-blue-100 text-blue-700 rounded-lg text-sm hover:bg-blue-200">
                                    ▶ Watch Video
                                </a>
                            </div>



                        </div>

                    @empty

                        <div class="text-gray-500 text-center py-6">
                            No lessons yet 😴
                        </div>
                    @endforelse

                </div>

            </div>
        @endforeach

    </div>
@endsection
