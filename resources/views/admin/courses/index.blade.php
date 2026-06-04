<x-app-layout>
    <x-slot name="header">
        <div class="flex align-items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('admin.courses') }}
            </h2>
            <a class="bg-green-600 p-1 px-8 rounded text-white hover:bg-green-500 duration-200"
                href="{{ route('admin.courses.create') }}">{{ __('Add Course') }}</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">


                    <div
                        class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base border border-default">
                        <table class="w-full text-sm text-left rtl:text-right text-body">
                            <thead
                                class="text-sm text-body bg-neutral-secondary-soft border-b rounded-base border-default bg-gray-100">
                                <tr>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Image
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Title
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Price
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Hours
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Teacher
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Category
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($courses as $course)
                                    <tr class="bg-neutral-primary border-b border-default">
                                        <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                            {{ $loop->iteration }}
                                        </th>
                                        <td class="px-6 py-4">
                                            <img src="{{ asset($course->image->path) }}" width="80" alt="">
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $course->getTransAttribute('title') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            ${{ $course->price }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $course->hours }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $course->teacher->name }}
                                        </td>

                                        <td class="px-6 py-4">
                                            {{ $course->category->getTransAttribute('title') }}
                                        </td>
                                        <td class="px-6 py-4">
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

                                        <td class="px-6 py-4 flex space-x-2 text-center">
                                            <a href="{{ route('admin.courses.edit', $course->id) }}"
                                                class="text-blue-600 hover:underline"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('admin.courses.destroy', $course->id) }}"
                                                method="POST" onsubmit="return confirm('Are you sure?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline"><i
                                                        class="fas fa-trash"></i></button>
                                            </form>
                                        </td>

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


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
