<x-app-layout>

    <x-slot name="header">
        <h2 class="font-bold text-2xl">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-6">

            <!-- Welcome -->
            <div class="bg-gradient-to-r from-indigo-600 to-blue-600 rounded-2xl p-8 text-white mb-8">
                <h1 class="text-3xl font-bold">
                    Welcome {{ auth()->user()->name }} 👋
                </h1>

                <p class="mt-2 text-indigo-100">
                    Manage your eLearning platform efficiently.
                </p>
            </div>

            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-6">

                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="text-gray-500">Students</p>
                    <h3 class="text-4xl font-bold mt-2">{{ $students }}</h3>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="text-gray-500">Teachers</p>
                    <h3 class="text-4xl font-bold mt-2">{{ $teachers }}</h3>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="text-gray-500">Courses</p>
                    <h3 class="text-4xl font-bold mt-2">{{ $courses }}</h3>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="text-gray-500">Lessons</p>
                    <h3 class="text-4xl font-bold mt-2">{{ $lessons }}</h3>
                </div>

                <div class="bg-white p-6 rounded-xl shadow">
                    <p class="text-gray-500">Enrollments</p>
                    <h3 class="text-4xl font-bold mt-2">{{ $enrollments }}</h3>
                </div>

            </div>

            <!-- Tables -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">

                <!-- Latest Enrollments -->
                <div class="bg-white rounded-xl shadow p-6">

                    <h3 class="font-bold text-lg mb-4">
                        Latest Enrollments
                    </h3>

                    <table class="w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-2">Student</th>
                                <th class="text-left py-2">Course</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($latestEnrollments as $enrollment)
                                <tr class="border-b">
                                    <td class="py-3">
                                        {{ $enrollment->user->name }}
                                    </td>

                                    <td>
                                        {{ $enrollment->course->getTransAttribute('title') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="py-4 text-center">
                                        No enrollments yet
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>

                <!-- Latest Payments -->
                <div class="bg-white rounded-xl shadow p-6">

                    <h3 class="font-bold text-lg mb-4">
                        Latest Payments
                    </h3>

                    <table class="w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-2">Student</th>
                                <th class="text-left py-2">Amount</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($latestPayments as $payment)
                                <tr class="border-b">
                                    <td class="py-3">
                                        {{ $payment->student->name }}
                                    </td>

                                    <td>
                                        ${{ $payment->amount }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="py-4 text-center">
                                        No payments yet
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>

            </div>

        </div>
    </div>

</x-app-layout>
