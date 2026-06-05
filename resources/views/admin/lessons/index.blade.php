<x-app-layout>
    <x-slot name="header">
        <div class="flex align-items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('admin.lessons') }}
            </h2>
            <a class="bg-green-600 p-1 px-8 rounded text-white hover:bg-green-500 duration-200"
                href="{{ route('admin.lessons.create') }}">{{ __('Add lesson') }}</a>
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
                                        Title
                                    </th>

                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Course
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Lesson Order
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Lesson URL
                                    </th>
                                    <th scope="col" class="px-6 py-3 font-medium">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lessons as $lesson)
                                    <tr class="bg-neutral-primary border-b border-default">
                                        <th scope="row" class="px-6 py-4 font-medium text-heading whitespace-nowrap">
                                            {{ $loop->iteration }}
                                        </th>

                                        <td class="px-6 py-4">
                                            {{ $lesson->getTransAttribute('title') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $lesson->course->getTransAttribute('title') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $lesson->lesson_order }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ $lesson->video_url }}" target="_blank"
                                                class="text-blue-600 hover:underline">{{ $lesson->video_url }}</a>
                                        </td>


                                        <td class="px-6 py-4 flex space-x-2 text-center">
                                            <a href="{{ route('admin.lessons.edit', $lesson->id) }}"
                                                class="text-blue-600 hover:underline"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('admin.lessons.destroy', $lesson->id) }}"
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
                                            No lessons found.
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
