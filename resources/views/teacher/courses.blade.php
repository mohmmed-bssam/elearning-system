@extends('Teacher.layouts.app')


@section('title')
    My Courses
@endsection

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Courses</h1>


    </div>

    <div class="bg-white shadow rounded-xl overflow-hidden">

        <table class="w-full text-left">

            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">#</th>
                    <th class="p-3">Image</th>
                    <th class="p-3">Title</th>
                    <th class="p-3">Price</th>
                    <th class="p-3">Hours</th>
                    <th class="p-3">Category</th>
                    <th class="p-3">Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($courses as $course)
                    <tr class="border-t">
                        <td class="p-3">
                            {{ $loop->iteration }}
                        </td>
                        <td class="p-3">
                            <img src="{{ asset($course->image->path) }}" width="80" alt="">
                        </td>
                        <td class="p-3">
                            {{ $course->getTransAttribute('title') }}
                        </td>
                        <td class="p-3">
                            ${{ $course->price }}
                        </td>
                        <td class="p-3">
                            {{ $course->hours }}
                        </td>
                        <td class="p-3">
                            {{ $course->category->getTransAttribute('title') }}
                        </td>
                        <td class="p-3">
                            @if ($course->status == 'active')
                                <span style="background:rgb(84, 218, 84);color:white;padding:5px 10px;">
                                    Active
                                </span>
                            @else
                                <span style="background:rgb(220, 20, 60);color:white;padding:5px 10px;">
                                    Inactive
                                </span>
                            @endif
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center">
                            No courses found.
                        </td>
                    </tr>
                @endforelse
            </tbody>


        </table>

    </div>
@endsection
