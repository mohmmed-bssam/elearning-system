<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Student Dashboard')</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!-- Alpine.js للـ sidebar toggle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
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
                <a href="{{ route('front.index') }}"><span x-show="open">  <i class="fa-solid fa-user-graduate me-2"></i> student</span></a>

                <button @click="open = !open" class="text-white text-sm">
                    ☰
                </button>
            </div>
            <div class="p-4 border-b border-gray-700">

                <div
                    class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center mx-auto text-lg font-bold">
                    @if (auth()->user()->image)
                        <img src="{{ asset(auth()->user()->image) }}" >
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
                <a href="{{ route('student.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg
   {{ request()->routeIs('student.dashboard') ? 'bg-blue-600' : 'hover:bg-gray-700' }}">
                        <i class="fa-solid fa-house"></i>
 <span x-show="open">Dashboard</span>
                </a>
                <a href="{{ route('student.lessons') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg
   {{ request()->routeIs('student.lessons') ? 'bg-blue-600' : 'hover:bg-gray-700' }}">
                        <i class="fa-solid fa-graduation-cap"></i>
 <span x-show="open">Courses&Lessons</span>
                </a>
                <a href="{{ route('student.reviews.index') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg
   {{ request()->routeIs('student.reviews.index') ? 'bg-blue-600' : 'hover:bg-gray-700' }}">
                        <i class="fa-solid fa-star"></i>
 <span x-show="open">My Reviews</span>
                </a>
                <a href="{{ route('profile.edit') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg
   {{ request()->routeIs('profile.edit') ? 'bg-blue-600' : 'hover:bg-gray-700' }}">
                        <i class="fa-solid fa-user"></i>
 <span x-show="open">My Profile</span>
                </a>
                <a href="{{ route('student.notifications') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg
   {{ request()->routeIs('student.notifications') ? 'bg-blue-600' : 'hover:bg-gray-700' }}">
                        <i class="fa-solid fa-bell"></i>
 <span x-show="open"> Notifications</span> ({{ Auth::user()->unreadNotifications->count() }})
                </a>




                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="flex items-center gap-3 px-4 py-2 hover:bg-gray-700 w-full text-left">

                            <i class="fa-solid fa-right-from-bracket"></i>
 <span x-show="open">{{ __('Log Out') }}</span>
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
