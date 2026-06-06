<div class="grid grid-cols-3 gap-4">

    <div class="mt-4">
        <x-input-label for="user_id" :value="__('Student')" />
        <x-select id="user_id" class="block mt-1 w-full" name="user_id">
            <option disabled value="">{{ __('Select a student') }}</option>
            @foreach ($students as $student)
                <option value="{{ $student->id }}"
                    {{ old('user_id', $enrollment->user_id ?? '') == $student->id ? 'selected' : '' }}>
                    {{ $student->name }}
                </option>
            @endforeach
        </x-select>
        <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
    </div>
    <div class="mt-4">
        <x-input-label for="course_id" :value="__('Course')" />
        <x-select id="course_id" class="block mt-1 w-full" name="course_id">
            <option disabled value="">{{ __('Select a course') }}</option>
            @foreach ($courses as $course)
                <option value="{{ $course->id }}"
                    {{ old('course_id', $enrollment->course_id ?? '') == $course->id ? 'selected' : '' }}>
                    {{ $course->getTransAttribute('title') }}
                </option>
            @endforeach
        </x-select>
        <x-input-error :messages="$errors->get('course_id')" class="mt-2" />
    </div>
    <div class="mt-4">
        <x-input-label for="status" :value="__('Status')" />
        <x-select id="status" class="block mt-1 w-full" name="status">
            <option disabled value="">{{ __('Select a status') }}</option>
            <option value="pending" {{ old('status', $enrollment->status ?? '') == 'pending' ? 'selected' : '' }}>
                {{ __('Pending') }}
            </option>
            <option value="active" {{ old('status', $enrollment->status ?? '') == 'active' ? 'selected' : '' }}>
                {{ __('Active') }}
            </option>
            <option value="completed" {{ old('status', $enrollment->status ?? '') == 'completed' ? 'selected' : '' }}>
                {{ __('Completed') }}
            </option>
        </x-select>
        <x-input-error :messages="$errors->get('status')" class="mt-2" />
    </div>

</div>
