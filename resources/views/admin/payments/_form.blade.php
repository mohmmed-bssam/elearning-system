                  <div class="grid grid-cols-2 gap-4">
                      <div>
                          <x-input-label for="Student_id" :value="__('Student Name : ')" />
                          <h3>{{ $payment->student->name }}</h3>
                      </div>
                      <div>
                          <x-input-label for="Course_id" :value="__('Course Name :')" />
                          <h2>{{ $payment->course->getTransAttribute('title') }}</h2>

                      </div>

                  </div>
                  <div class="grid grid-cols-1 gap-4">
                      <div>
                          <x-input-label for="Amount" :value="__('Amount')" />
                          <h2>${{ $payment->amount }}</h2>

                      </div>


                  </div>


                  <div class="mt-4">
                      <x-input-label for="status" :value="__('Status')" />
                      <x-select id="status" class="block mt-1 w-full" name="status">
                          <option disabled value="">{{ __('Select a status') }}</option>
                          <option value="pending"
                              {{ old('status', $payment->status ?? '') == 'pending' ? 'selected' : '' }}>
                              {{ __('Pending') }}
                          </option>
                          <option value="paid"
                              {{ old('status', $payment->status ?? '') == 'paid' ? 'selected' : '' }}>
                              {{ __('Paid') }}
                          </option>
                          <option value="failed"
                              {{ old('status', $payment->status ?? '') == 'failed' ? 'selected' : '' }}>
                              {{ __('Failed') }}
                          </option>
                      </x-select>
                      <x-input-error :messages="$errors->get('status')" class="mt-2" />
                  </div>
