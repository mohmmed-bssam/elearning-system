<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('front.index') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-3 sm:-my-px sm:ms-6 sm:flex sm:items-center">
                    <x-nav-link class="{{ app()->getLocale() == 'ar' ? 'me-4' : '' }}" :href="route('admin.dashboard')"
                        :active="request()->routeIs('admin.dashboard')">
                        {{ __('admin.dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.sliders.index')" :active="request()->routeIs('admin.sliders.index')">
                        {{ __('admin.sliders') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.services.index')" :active="request()->routeIs('admin.services.index')">
                        {{ __('admin.services') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.teachers.index')" :active="request()->routeIs('admin.teachers.index')">
                        {{ __('admin.teachers') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.index')">
                        {{ __('admin.categories') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.courses.index')" :active="request()->routeIs('admin.courses.index')">
                        {{ __('admin.courses') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.lessons.index')" :active="request()->routeIs('admin.lessons.index')">
                        {{ __('admin.lessons') }}
                    </x-nav-link>

                    <x-nav-link :href="route('admin.teams.index')" :active="request()->routeIs('admin.teams.index')">
                        {{ __('admin.teams') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.enrollments.index')" :active="request()->routeIs('admin.enrollments.index')">
                        {{ __('admin.enrollments') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.testimonials.index')" :active="request()->routeIs('admin.testimonials.index')">
                        {{ __('admin.testimonials') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.course_reviews.index')" :active="request()->routeIs('admin.course_reviews.index')">
                        {{ __('admin.course_reviews') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.subscriptions')" :active="request()->routeIs('admin.subscriptions')">
                        {{ __('admin.subscriptions') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.payments.index')" :active="request()->routeIs('admin.payments.index')">
                        {{ __('admin.payments') }}
                    </x-nav-link>

                </div>
            </div>
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 8l6 6" />
                                    <path d="M5 l4l6 2-3" />
                                    <path d="M2 5h12" />
                                    <path d="M7 2h1" />
                                    <path d="M22 22l-5-10-5 10" />
                                    <path d="M14 18h6" />
                                </svg></div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <x-dropdown-link :href="LaravelLocalization::getLocalizedURL($localeCode, null, [], true)">
                                    {{ $properties['native'] }}
                                </x-dropdown-link>


                            </li>
                        @endforeach




                    </x-slot>
                </x-dropdown>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('admin.messages')">
                            {{ __('admin.messages') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('admin.notifications')">
                            {{ __('admin.notifications') }} ({{ Auth::user()->unreadNotifications->count() }})
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('admin.settings')">
                            {{ __('admin.settings') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>


                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('admin.sliders.index')" :active="request()->routeIs('admin.sliders.index')">
                {{ __('Sliders') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
