@extends('Teacher.layouts.app')


@section('title')
    My students
@endsection

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">students</h1>


    </div>

    <div class="bg-white shadow rounded-xl overflow-hidden">

        <table class="w-full text-left">

            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">#</th>
                    <th class="p-3">Student Name</th>
                    <th class="p-3">Email</th>

                    <th class="p-3">Title</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($students as $student)
                    {{-- @dd($student) --}}
                    <tr class="border-t">
                        <td class="p-3">
                            {{ $loop->iteration }}
                        </td>

                        <td class="p-3">
                            {{ $student->name }}
                        </td>
                        <td class="p-3">
                            {{ $student->email }}
                        </td>

                        <td class="p-3">
                            @foreach ($student->enrollments as $enrollment)
                                {{ $enrollment->course->getTransAttribute('title') }}<br>
                            @endforeach
                        </td>
                       


                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center">
                            No students found.
                        </td>
                    </tr>
                @endforelse
            </tbody>


        </table>

    </div>
@endsection
