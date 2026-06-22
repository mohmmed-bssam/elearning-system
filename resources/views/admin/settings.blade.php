<x-app-layout>
    <x-slot name="header">
        <div class="flex align-items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('admin.settings') }}
            </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.settings') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <h3 class="text-lg font-bold">General Settings</h3>
                        <div class="grid grid-cols-4 md:max-w-2xl items-center mt-4">
                            <div>
                                <x-input-label for="site_logo" class="block font-medium text-sm text-gray-700 !text-lg"
                                    :value="__('Site Logo')" />
                            </div>
                            <div class="col-span-2">
                                <x-text-input id="site_logo" class="block mt-1 w-full" type="file" name="site_logo"
                                    accept="image/*" />
                                @if (isset($settings['site_logo']))
                                    <img class="p-0.5 mt-1 border rounded" width="80"
                                        src="{{ asset($settings['site_logo']) }}" alt="Site Logo" class="mt-2 h-16">
                                @endif
                            </div>
                        </div>
                        <div class="grid grid-cols-4 md:max-w-2xl items-center mt-4">
                            <div>
                                <x-input-label for="call_us" class="block font-medium text-sm text-gray-700 !text-lg"
                                    :value="__('Call Us')" />
                            </div>
                            <div class="col-span-2">
                                <x-text-input id="call_us" class="block mt-1 w-full" type="text" name="call_us"
                                    :value="$settings['call_us'] ?? ''" />
                            </div>
                        </div>
                        <div class="grid grid-cols-4 md:max-w-2xl items-center mt-4">
                            <div>
                                <x-input-label for="mail_us" class="block font-medium text-sm text-gray-700 !text-lg"
                                    :value="__('Mail Us')" />
                            </div>
                            <div class="col-span-2">
                                <x-text-input id="mail_us" class="block mt-1 w-full" type="email" name="mail_us"
                                    :value="$settings['mail_us'] ?? ''" />
                            </div>
                        </div>
                        <div class="grid grid-cols-4 md:max-w-2xl items-center mt-4">
                            <div>
                                <x-input-label for="address" class="block font-medium text-sm text-gray-700 !text-lg"
                                    :value="__('Address')" />
                            </div>
                            <div class="col-span-2">
                                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address"
                                    :value="$settings['address'] ?? ''" />
                            </div>
                        </div>
                        <div class="grid grid-cols-4 md:max-w-2xl items-center mt-4">
                            <div>
                                <x-input-label for="gallery" class="block font-medium text-sm text-gray-700 !text-lg"
                                    :value="__('Gallery')" />
                            </div>
                            <div class="col-span-2">
                                <x-text-input id="gallery" class="block mt-1 w-full" type="file" name="gallery[]"
                                    accept="image/*" multiple />

                            </div>
                            @if ($galleries->isNotEmpty())
                                <div class="flex gap-2 flex-wrap mt-2">
                                    @foreach ($galleries as $item)
                                        <div class="relative inline-block">
                                            <img src="{{ asset($item->image) }}" alt="gallery image"
                                                class="w-20 h-20 object-cover rounded">

                                            <a href="{{ route('admin.delete_gallery', $item->id) }}"
                                                class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-5 h-5 flex items-center
                                                 justify-center text-xs hover:bg-red-700 del_image">
                                                ✕
                                            </a>
                                        </div>
                                    @endforeach
                                </div>

                            @endif
                        </div>
                        <br>
                        <hr class="my-6">

                        <h1 class="text-lg font-bold" style="color: rgb(199, 19, 19)">About Us</h1>
                        <div class="grid grid-cols-4 md:max-w-2xl items-center mt-4">
                            <div>
                                <x-input-label for="about_logo" class="block font-medium text-sm text-gray-700 !text-lg"
                                    :value="__('About Logo')" />
                            </div>
                            <div class="col-span-2">
                                <x-text-input id="about_logo" class="block mt-1 w-full" type="file" name="about_logo"
                                    accept="image/*" />
                                @if (isset($settings['about_logo']))
                                    <img class="p-0.5 mt-1 border rounded" width="80"
                                        src="{{ asset($settings['about_logo']) }}" alt="about Logo" class="mt-2 h-16">
                                @endif
                            </div>
                        </div>
                        <div class="grid grid-cols-4 md:max-w-2xl items-center mt-4">
                            <div>
                                <x-input-label for="about_title"
                                    class="block font-medium text-sm text-gray-700 !text-lg" :value="__('About_title')" />
                            </div>
                            <div class="col-span-2">
                                <x-text-input id="about_title" class="block mt-1 w-full" type="text"
                                    name="about_title" :value="$settings['about_title'] ?? ''" />
                            </div>
                        </div>
                        <div class="grid grid-cols-4 md:max-w-2xl items-center mt-4">
                            <div>
                                <x-input-label for="about_content"
                                    class="block font-medium text-sm text-gray-700 !text-lg" :value="__('About_content')" />
                            </div>
                            <div class="col-span-2">
                                <x-textarea id="about_content" rows="5" class="block mt-1 w-full"
                                    name="about_content">{{ $settings['about_content'] ?? '' }}</x-textarea>
                            </div>
                        </div>
                        <div class="grid grid-cols-4 md:max-w-2xl items-center mt-4">
                            <div>
                                <x-input-label for="ourMission_content"
                                    class="block font-medium text-sm text-gray-700 !text-lg" :value="__('OurMission_content')" />
                            </div>

                        </div>
                        <div class="grid grid-cols-4 md:max-w-2xl items-center mt-4">
                            <div>
                                <x-input-label for="ourMission_goal1"
                                    class="block font-medium text-sm text-gray-700 !text-lg" :value="__('OurMission_goal1')" />
                            </div>
                            <div class="col-span-2">
                                <x-text-input id="ourMission_goal1" class="block mt-1 w-full" type="text"
                                    name="ourMission_goal1" :value="$settings['ourMission_goal1'] ?? ''" />
                            </div>
                        </div>
                        <div class="grid grid-cols-4 md:max-w-2xl items-center mt-4">
                            <div>
                                <x-input-label for="ourMission_goal2"
                                    class="block font-medium text-sm text-gray-700 !text-lg" :value="__('OurMission_goal2')" />
                            </div>
                            <div class="col-span-2">
                                <x-text-input id="ourMission_goal2" class="block mt-1 w-full" type="text"
                                    name="ourMission_goal2" :value="$settings['ourMission_goal2'] ?? ''" />
                            </div>
                        </div>
                        <div class="grid grid-cols-4 md:max-w-2xl items-center mt-4">
                            <div>
                                <x-input-label for="ourMission_goal3"
                                    class="block font-medium text-sm text-gray-700 !text-lg" :value="__('OurMission_goal3')" />
                            </div>
                            <div class="col-span-2">
                                <x-text-input id="ourMission_goal3" class="block mt-1 w-full" type="text"
                                    name="ourMission_goal3" :value="$settings['ourMission_goal3'] ?? ''" />
                            </div>
                        </div>
                        <br>

                        <hr class="my-6">

                        <h1 class="text-lg font-bold" style="color: rgb(199, 19, 19)">Social Media</h1>

                        <div class="grid grid-cols-4 md:max-w-2xl items-center mt-4">
                            <div>
                                <x-input-label for="facebook" class="block font-medium text-sm text-gray-700 !text-lg"
                                    :value="__('Facebook')" />
                            </div>
                            <div class="col-span-2">
                                <x-text-input id="facebook" class="block mt-1 w-full" type="text"
                                    name="facebook" :value="$settings['facebook'] ?? ''" />
                            </div>
                        </div>
                        <div class="grid grid-cols-4 md:max-w-2xl items-center mt-4">
                            <div>
                                <x-input-label for="x" class="block font-medium text-sm text-gray-700 !text-lg"
                                    :value="__('Twitter/X')" />
                            </div>
                            <div class="col-span-2">
                                <x-text-input id="x" class="block mt-1 w-full" type="text" name="x"
                                    :value="$settings['x'] ?? ''" />
                            </div>
                        </div>
                        <div class="grid grid-cols-4 md:max-w-2xl items-center mt-4">
                            <div>
                                <x-input-label for="linkedin" class="block font-medium text-sm text-gray-700 !text-lg"
                                    :value="__('Linkedin')" />
                            </div>
                            <div class="col-span-2">
                                <x-text-input id="linkedin" class="block mt-1 w-full" type="text"
                                    name="linkedin" :value="$settings['linkedin'] ?? ''" />
                            </div>
                        </div>
                        <div class="grid grid-cols-4 md:max-w-2xl items-center mt-4">
                            <div>
                                <x-input-label for="youtube" class="block font-medium text-sm text-gray-700 !text-lg"
                                    :value="__('YouTube')" />
                            </div>
                            <div class="col-span-2">
                                <x-text-input id="youtube" class="block mt-1 w-full" type="text" name="youtube"
                                    :value="$settings['youtube'] ?? ''" />
                            </div>
                        </div>
                        <br>

                        <hr>

                        <h1 class="text-lg font-bold" style="color: rgb(199, 19, 19)">Contact Us</h1>
                        <div class="grid grid-cols-4 md:max-w-2xl items-center mt-4">
                            <div>
                                <x-input-label for="contact_description"
                                    class="block font-medium text-sm text-gray-700 !text-lg" :value="__('Contact Description')" />
                            </div>
                            <div class="col-span-2">
                                <x-textarea id="contact_description" rows="5" class="block mt-1 w-full"
                                    name="contact_description">{{ $settings['contact_description'] ?? '' }}</x-textarea>
                            </div>
                        </div>



                        <x-primary-button class="mt-6">Save</x-primary-button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            const del_btns = document.querySelectorAll('.del_image');
            del_btns.forEach(el => {
                el.onclick = (e) => {
                    e.preventDefault();
                        let url = el.href;
                        fetch(url)
                            .then(res => res.json())
                            .then(data => {
                                    if (data.status) {
                                        el.parentElement.remove();
                                    }
                                })
                           .catch(err => {
                        console.log(err);
                    });
            }
            });
        </script>
    @endpush
</x-app-layout>
