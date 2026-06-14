@extends('student.layouts.app')
@section('title', 'My Reviews')

@section('content')

<div class="bg-white rounded-xl shadow">

    <div class="p-6 border-b">

        <h2 class="text-2xl font-bold">
            ⭐ My Reviews
        </h2>

    </div>

    <div class="p-6">

        @forelse($reviews as $review)

            <div class="border rounded-lg p-4 mb-4">

                <div class="flex justify-between">

                    <h3 class="font-bold text-lg">
                        {{ $review->course->getTransAttribute('title') }}
                    </h3>

                    <span class="font-semibold text-yellow-500">
                        {{ $review->rate }}/5 ⭐
                    </span>

                </div>

                @if($review->comment)

                    <p class="mt-3 text-gray-700">
                        {{ $review->comment }}
                    </p>

                @endif

                <div class="mt-3 text-sm text-gray-500">

                    {{ $review->created_at->format('Y-m-d') }}

                </div>

            </div>

        @empty

            <div class="text-center py-8 text-gray-500">

                No Reviews Yet

            </div>

        @endforelse

    </div>

</div>

@endsection
