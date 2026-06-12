<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Teacher Dashboard')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js للـ sidebar toggle -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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

                <a href="" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700">
                    ⭐ <span x-show="open">Ratings</span>
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
