<div class="grid grid-cols-1 gap-4">

    <div>
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $teacher->name ?? '')" autofocus />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

</div>


<div class="grid grid-cols-1 gap-4">

    <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $teacher->email ?? '')" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

</div>


<div class="grid grid-cols-1 gap-4">

    <div>
        <x-input-label for="phone" :value="__('Phone')" />
        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone', $teacher->phone ?? '')" />
        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
    </div>

</div>


<div class="grid grid-cols-1 gap-4">

    <div>
        <x-input-label for="password" :value="__('Password')" />

        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" />

        @if (!empty($teacher?->id))
            <small class="text-gray-500">
                اترك الحقل فارغاً إذا كنت لا تريد تغيير كلمة المرور
            </small>
        @endif

        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

</div>
