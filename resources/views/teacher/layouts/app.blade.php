<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Teacher Dashboard')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js للـ sidebar toggle -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        .card {
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-4px);
        }

        .form-control {
            border-radius: 12px;
        }

        .btn-primary {
            border-radius: 12px;
        }
    </style>
</head>

<body class="bg-gray-100">

    <div x-data="{ open: true }" class="flex h-screen">

        <!-- Sidebar -->
        <div :class="open ? 'w-64' : 'w-20'" class="bg-gray-900 text-white transition-all duration-300">

            <!-- Logo -->
            <div class="p-4 text-xl font-bold border-b border-gray-700 flex justify-between items-center">
                <a href="{{ route('front.index') }}"><span x-show="open">👨‍🏫 Teacher</span></a>

                <button @click="open = !open" class="text-white text-sm">
                    ☰
                </button>
            </div>
            <div class="p-4 border-b border-gray-700">

                <div
                    class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mx-auto text-lg font-bold">
                    @if (auth()->user()->image)
                        <img src="{{ asset(auth()->user()->image) }}">
                    @else
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    @endif
                </div>

                <p class="text-center mt-2 font-semibold" x-show="open">
                    {{ auth()->user()->name }}
                </p>

            </div>

            <!-- Links -->
            <nav class="mt-4 space-y-2">



                <a href="{{ route('teacher.dashboard') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                    🏠 <span x-show="open">Dashboard</span>
                </a>
                <a href="{{ route('teacher.students') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                    📚 <span x-show="open">Student</span>
                </a>

                <a href="{{ route('teacher.lessons.index') }}"
                    class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                    📖 <span x-show="open">Courses&Lessons</span>
                </a>

                <a href="{{ route('teacher.reviews') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                    ⭐ <span x-show="open">Reviews</span>
                </a>
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                    ⭐ <span x-show="open">My Profile</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700 w-full text-left">

                        🚪 <span x-show="open">{{ __('Log Out') }}</span>
                    </button>
                </form>

            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6 overflow-y-auto">

            @yield('content')

        </div>

    </div>

</body>

</html>
