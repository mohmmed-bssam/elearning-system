                  <div class="grid grid-cols-2 gap-4">
                      <div>
                        <input type="hidden" name="course_id" value="{{ $courseId ??'' }}">
                          <x-input-label for="title_en" :value="__('English Title')" />
                          <x-text-input id="title_en" class="block mt-1 w-full" type="text" name="title_en"
                              :value="old('title_en', $lesson->title['en'] ?? ('' ?? ''))" autofocus />
                          <x-input-error :messages="$errors->get('title_en')" class="mt-2" />
                      </div>
                      <div>
                          <x-input-label for="title_ar" :value="__('Arabic Title')" />
                          <x-text-input id="title_ar" class="block mt-1 w-full" type="text" name="title_ar"
                              :value="old('title_ar', $lesson->title['ar'] ?? '')" />
                          <x-input-error :messages="$errors->get('title_ar')" class="mt-2" />
                      </div>
                  </div>


                  <div class="grid grid-cols-2 gap-4">
                      <div class="mt-4">
                          <x-input-label for="description_en" :value="__('English Description')" />
                          <x-textarea id="description_en" rows="5" class="block mt-1 w-full"
                              name="description_en">{{ old('description_en', $lesson->description['en'] ?? '') }}</x-textarea>
                          <x-input-error :messages="$errors->get('description_en')" class="mt-2" />
                      </div>
                      <div class="mt-4">
                          <x-input-label for="description_ar" :value="__('Arabic Description')" />
                          <x-textarea id="description_ar" rows="5" class="block mt-1 w-full"
                              name="description_ar">{{ old('description_ar', $lesson->description['ar'] ?? '') }}</x-textarea>
                          <x-input-error :messages="$errors->get('description_ar')" class="mt-2" />
                      </div>
                  </div>
                  <div class="grid grid-cols-1 gap-4">
                      <div class="mt-4">
                          <x-input-label for="video_url" :value="__('Video URL')" />
                          <x-text-input id="video_url" class="block mt-1 w-full" type="text" name="video_url"
                              :value="old('video_url', $lesson->video_url ?? '')" />
                          <x-input-error :messages="$errors->get('video_url')" class="mt-2" />
                      </div>

                  </div>
                  <div class="grid grid-cols-2 gap-4">
                      <div class="mt-4">
                          <x-input-label for="lesson_order" :value="__('Lesson Order')" />
                          <x-text-input id="lesson_order" class="block mt-1 w-full" type="number" name="lesson_order"
                              :value="old('lesson_order', $lesson->lesson_order ?? '')" />
                          <x-input-error :messages="$errors->get('lesson_order')" class="mt-2" />
                      </div>
                      <div class="mt-4">
                          <x-input-label for="course_id" :value="__('Course')" />
                          <x-select id="course_id" class="block mt-1 w-full" name="course_id">
                              <option disabled value="">{{ __('Select a course') }}</option>
                              @foreach ($courses as $course)
                                  <option value="{{ $course->id }}"
                                      {{ old('course_id', $lesson->course_id ?? '') == $course->id ? 'selected' : '' }}>
                                      {{ $course->getTransAttribute('title') }}
                                  </option>
                              @endforeach
                          </x-select>
                          <x-input-error :messages="$errors->get('course_id')" class="mt-2" />
                      </div>

                  </div>
