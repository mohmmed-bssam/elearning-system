@extends('Student.layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6 text-gray-800">
            <i class="fa-solid fa-bell"></i>
  {{ __('admin.notifications') }} ({{ Auth::user()->unreadNotifications->count() }})
    </h1>

    <div class="space-y-6">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col"> #
                    </th>
                    <th scope="col">Content</th>
                    <th scope="col"> Received At
                    </th>
                    <th scope="col"> Mark as Read
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($notifications as $notify)
                    <tr>
                        <td class="px-6 py-4">
                            {{ $loop->iteration }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $notify->data['message'] ?? 'No content' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $notify->created_at->diffForHumans() }}
                        </td>
                        <td class="px-6 py-4">
                            @if (!$notify->read_at)
                                <a href="{{ route('student.notifications.markAsRead', $notify->id) }}"
                                    class="bg-green-500 p-1 text-white">Mark as Read</a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center">

                            No notifications
                        </td>
                    </tr>
                    {{-- <p class="text-gray-500 text-sm">No notifications</p> --}}
                @endforelse

            </tbody>
        </table>


    </div>
@endsection
