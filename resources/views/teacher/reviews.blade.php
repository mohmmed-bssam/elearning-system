@extends('teacher.layouts.app')

@section('title', 'Course Reviews')

@section('content')

    <div class="max-w-5xl mx-auto">
        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 mb-6">

            <h3 class="font-bold">
                Average Rating
            </h3>

            <p class="text-3xl font-bold text-yellow-600">
                {{ number_format($averageRate, 1) }} ⭐
            </p>

        </div>

        <h1 class="text-2xl font-bold mb-6">
            ⭐ Student Reviews
        </h1>

        @forelse($reviews as $review)

            <div class="bg-white rounded-xl shadow p-6 mb-4">

                <div class="flex justify-between">

                    <div>

                        <h3 class="font-bold text-lg">
                            {{ $review->course->getTransAttribute('title') }}
                        </h3>

                        <p class="text-sm text-gray-500">
                            {{ $review->user->name }}
                        </p>

                    </div>

                    <div class="text-yellow-500 text-lg">

                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $review->rate)
                                ⭐
                            @else
                                ☆
                            @endif
                        @endfor

                    </div>

                </div>

                @if ($review->comment)
                    <p class="mt-4 text-gray-700">
                        {{ $review->comment }}
                    </p>
                @endif

                <div class="mt-3 text-sm text-gray-500">

                    {{ $review->created_at->diffForHumans() }}

                </div>

            </div>

        @empty

            <div class="bg-white p-8 rounded-xl shadow text-center">

                No Reviews Yet

            </div>

        @endforelse

        <div class="mt-4">
            {{ $reviews->links() }}
        </div>

    </div>

@endsection
