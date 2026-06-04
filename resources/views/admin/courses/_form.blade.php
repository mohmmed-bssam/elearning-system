                  <div class="grid grid-cols-2 gap-4">
                      <div>
                          <x-input-label for="title_en" :value="__('English Title')" />
                          <x-text-input id="title_en" class="block mt-1 w-full" type="text" name="title_en"
                              :value="old('title_en', $course->title['en'] ?? ('' ?? ''))" autofocus />
                          <x-input-error :messages="$errors->get('title_en')" class="mt-2" />
                      </div>
                      <div>
                          <x-input-label for="title_ar" :value="__('Arabic Title')" />
                          <x-text-input id="title_ar" class="block mt-1 w-full" type="text" name="title_ar"
                              :value="old('title_ar', $course->title['ar'] ?? '')" autofocus />
                          <x-input-error :messages="$errors->get('title_ar')" class="mt-2" />
                      </div>
                  </div>

                  <div class="mt-4">
                      <x-input-label for="image" />
                      <x-text-input accept="image/*" id="image" class="block mt-1 w-full" type="file"
                          name="image" />
                      @if ($course && $course->image)
                          <img src="{{ asset($course->image->path) }}" alt="course Image" width="100">
                      @endif
                      <x-input-error :messages="$errors->get('image')" class="mt-2" />
                  </div>
                  <div class="grid grid-cols-1 gap-4">
                      <div class="mt-4">
                          <x-input-label for="slug" :value="__('Slug')" />
                          <x-text-input id="slug" class="block mt-1 w-full" type="text" name="slug"
                              :value="old('slug', $course->slug ?? ('' ?? ''))" />
                          <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                      </div>

                  </div>
                  <div class="grid grid-cols-2 gap-4">
                      <div class="mt-4">
                          <x-input-label for="description_en" :value="__('English description')" />
                          <x-textarea id="description_en" rows="5" class="block mt-1 w-full"
                              name="description_en">{{ old('description_en', $course->description['en'] ?? '') }}</x-textarea>
                          <x-input-error :messages="$errors->get('description_en')" class="mt-2" />
                      </div>
                      <div class="mt-4">
                          <x-input-label for="description_ar" :value="__('Arabic description')" />
                          <x-textarea id="description_ar" rows="5" class="block mt-1 w-full"
                              name="description_ar">{{ old('description_ar', $course->description['ar'] ?? '') }}</x-textarea>
                          <x-input-error :messages="$errors->get('description_ar')" class="mt-2" />
                      </div>
                  </div>
                  <div class="grid grid-cols-2 gap-4">
                      <div>
                          <x-input-label for="price" :value="__('Price')" />
                          <x-text-input id="price" class="block mt-1 w-full" type="number" name="price"
                              :value="old('price', $course->price ?? '')" autofocus />
                          <x-input-error :messages="$errors->get('price')" class="mt-2" />
                      </div>
                      <div>
                          <x-input-label for="hours" :value="__('Hours')" />
                          <x-text-input id="hours" class="block mt-1 w-full" type="number" name="hours"
                              :value="old('hours', $course->hours ?? '')" autofocus />
                          <x-input-error :messages="$errors->get('hours')" class="mt-2" />
                      </div>
                  </div>
                  <div class="grid grid-cols-2 gap-4">
                      <div>
                          <x-input-label for="teacher_id" :value="__('Teacher')" />
                          <x-select id="teacher_id" class="block mt-1 w-full" name="teacher_id">
                              <option disabled value="">Select Teacher</option>
                              @foreach ($teachers as $teacher)
                                  <option value="{{ $teacher->id }}"
                                      {{ old('teacher_id', $course->teacher_id ?? '') == $teacher->id ? 'selected' : '' }}>
                                      {{ $teacher->name }}</option>
                              @endforeach
                            </x-select>
                              <x-input-error :messages="$errors->get('teacher_id')" class="mt-2" />
                      </div>
                      <div>
                          <x-input-label for="category_id" :value="__('Category')" />
                          <x-select id="category_id" class="block mt-1 w-full" name="category_id">
                              <option disabled value="">Select Category</option>
                              @foreach ($categories as $category)
                                  <option value="{{ $category->id }}"
                                      {{ old('category_id', $course->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                      {{ $category->getTransAttribute('title') }}</option>
                              @endforeach
                          </x-select>
                          <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                      </div>
                  </div>
                  <div class="grid grid-cols-1 gap-4">
                      <div>
                          <x-input-label for="status" :value="__('Status')" />
                          <x-select id="status" class="block mt-1 w-full" name="status">
                              <option disabled value="">Select Status</option>
                              <option value="active"
                                  {{ old('status', $course->status ?? '') == 'active' ? 'selected' : '' }}>Active
                              </option>
                              <option value="inactive"
                                  {{ old('status', $course->status ?? '') == 'inactive' ? 'selected' : '' }}>Inactive
                              </option>
                          </x-select>
                          <x-input-error :messages="$errors->get('status')" class="mt-2" />
                      </div>
                  </div>
