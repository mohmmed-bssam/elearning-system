

<div class="grid grid-cols-2 gap-4">
     <div class="mt-4">
        <x-input-label for="name" :value="__('Name')" />
        <x-text-input id="name" class="block mt-1 w-full" type="text"
            name="name" :value="old('name', $team->name ?? '')" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>
     <div class="mt-4">
        <x-input-label for="job_title" :value="__('Job Title')" />
        <x-text-input id="job_title" class="block mt-1 w-full" type="text"
            name="job_title" :value="old('job_title', $team->job_title ?? '')" />
        <x-input-error :messages="$errors->get('job_title')" class="mt-2" />
    </div>


</div>

<div class="mt-4">
    <x-input-label for="image" :value="__('Image')" />
    <x-text-input accept="image/*" id="image" class="block mt-1 w-full"
        type="file" name="image" />

    @if(isset($team) && $team->image)
        <img src="{{ asset($team->image->path) }}"
             alt="Team Image"
             width="100"
             class="mt-2 rounded">
    @endif

    <x-input-error :messages="$errors->get('image')" class="mt-2" />
</div>

<div class="grid grid-cols-3 gap-4">
    <div class="mt-4">
        <x-input-label for="facebook" :value="__('Facebook URL')" />
        <x-text-input id="facebook" class="block mt-1 w-full"
            type="url"
            name="facebook"
            :value="old('facebook', $team->fb ?? '')" />
        <x-input-error :messages="$errors->get('facebook')" class="mt-2" />
    </div>
  <div class="mt-4">
        <x-input-label for="x" :value="__('Twitter/X URL')" />
        <x-text-input id="x" class="block mt-1 w-full"
            type="url"
            name="x"
            :value="old('x', $team->x ?? '')" />
        <x-input-error :messages="$errors->get('x')" class="mt-2" />
    </div>

    <div class="mt-4">
        <x-input-label for="instagram" :value="__('Instagram URL')" />
        <x-text-input id="instagram" class="block mt-1 w-full"
            type="url"
            name="instagram"
            :value="old('instagram', $team->insta ?? '')" />
        <x-input-error :messages="$errors->get('instagram')" class="mt-2" />
    </div>

</div>

<div class="grid grid-cols-2 gap-4">

</div>
