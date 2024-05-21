<x-app-layout>
    <article class="container mx-auto max-w-7xl">
        <header
            class="py-4 bg-gray-600 text-gray-200 px-4 rounded-t-lg mb-4 flex flex-row justify-between items-center">
            <div>
                <h2 class="text-3xl font-semibold">Management Area</h2>
                <h3 class="text-2xl">Edit Listing</h3>
            </div>
            <i class="fa fa-listing-pen text-5xl"></i>
        </header>


        @if(Session::has('success'))
            <section id="Messages" class="my-4 px-4">
                <div class="p-4 border-green-500 bg-green-100 text-green-700 rounded-lg">
                    {{Session::get('success')}}
                </div>
            </section>
        @endif

        @if($errors->count()>0)
            <section class="bg-red-200 text-red-800 mx-4 my-2 px-4 py-2 flex flex-col gap-1 rounded border-red-600">
                <p>We have noted some data entry issues, please update and resubmit.</p>
            </section>
        @endif


        <section class="p-4 ">
            <form action="{{ route('listings.update', $listing) }}"
                  method="POST"
                  class="max-w-3xl flex flex-col gap-4">

                @csrf
                @method('patch')


                <fieldset class="grid grid-cols-7">
                    <label class="text-gray-500 col-span-2"
                           for="title">Title:</label>
                    <input type="text"
                           id="title"
                           name="title"
                           value="{{ old('title') ?? $listing->title }}"
                           placeholder="Enter listing title"
                           class="border-gray-200 col-span-5">
                    @error("title")
                    <span class="text-gray-500 col-span-2"></span>
                    <p class="small text-red-500 col-span-5 text-sm">{{ $message }}</p>
                    @enderror
                </fieldset>

                <fieldset class="grid grid-cols-7">
                    <label class="text-gray-500 col-span-2"
                           for="description">Description:</label>
                    <textarea
                        id="description"
                        name="description"
                        placeholder="Enter description"
                        class="border-gray-200 col-span-5"
                        rows="4">{{ old('description') ?? $listing->description }}</textarea>
                    @error("description")
                    <span class="text-gray-500 col-span-2"></span>
                    <p class="small text-red-500 col-span-5 text-sm">{{ $message }}</p>
                    @enderror</fieldset>

                <fieldset class="grid grid-cols-7">
                    <label class="text-gray-500 col-span-2"
                           for="salary">Salary:</label>
                    <input type="text"
                           id="salary"
                           name="salary"
                           value="{{ old('salary') ?? $listing->salary }}"
                           placeholder="Enter listing salary"
                           class="border-gray-200 col-span-5">
                    @error("salary")
                    <span class="text-gray-500 col-span-2"></span>
                    <p class="small text-red-500 col-span-5 text-sm">{{ $message }}</p>
                    @enderror
                </fieldset>

                <fieldset class="grid grid-cols-7">
                    <label class="text-gray-500 col-span-2"
                           for="tags">Tags:</label>
                    <input type="text"
                           id="tags"
                           name="tags"
                           value="{{ old('tags') ?? $listing->tags }}"
                           placeholder="Enter listing tags"
                           class="border-gray-200 col-span-5">
                    @error("tags")
                    <span class="text-gray-500 col-span-2"></span>
                    <p class="small text-red-500 col-span-5 text-sm">{{ $message }}</p>
                    @enderror
                </fieldset>

                <fieldset class="grid grid-cols-7">
                    <label class="text-gray-500 col-span-2"
                           for="company">Company:</label>
                    <input type="text"
                           id="company"
                           name="company"
                           value="{{ old('company') ?? $listing->company }}"
                           placeholder="Enter listing company"
                           class="border-gray-200 col-span-5">
                    @error("company")
                    <span class="text-gray-500 col-span-2"></span>
                    <p class="small text-red-500 col-span-5 text-sm">{{ $message }}</p>
                    @enderror
                </fieldset>

                <fieldset class="grid grid-cols-7">
                    <label class="text-gray-500 col-span-2"
                           for="address">Address:</label>
                    <input type="text"
                           id="address"
                           name="address"
                           value="{{ old('address') ?? $listing->address }}"
                           placeholder="Enter listing address"
                           class="border-gray-200 col-span-5">
                    @error("address")
                    <span class="text-gray-500 col-span-2"></span>
                    <p class="small text-red-500 col-span-5 text-sm">{{ $message }}</p>
                    @enderror
                </fieldset>

                <fieldset class="grid grid-cols-7">
                    <label class="text-gray-500 col-span-2"
                           for="City">City:</label>
                    <input type="text"
                           id="City"
                           name="city"
                           value="{{ old('city') ?? $listing->city }}"
                           placeholder="Enter city"
                           class="border-gray-200 col-span-5">
                    @error("city")
                    <span class="text-gray-500 col-span-2"></span>
                    <p class="small text-red-500 col-span-5 text-sm">{{ $message }}</p>
                    @enderror</fieldset>

                <fieldset class="grid grid-cols-7">
                    <label class="text-gray-500 col-span-2"
                           for="State">State:</label>
                    <input type="text"
                           id="State"
                           name="state"
                           value="{{ old('state') ?? $listing->state }}"
                           placeholder="Enter state"
                           class="border-gray-200 col-span-5">
                    @error("state")
                    <span class="text-gray-500 col-span-2"></span>
                    <p class="small text-red-500 col-span-5 text-sm">{{ $message }}</p>
                    @enderror</fieldset>

                <fieldset class="grid grid-cols-7">
                    <label class="text-gray-500 col-span-2"
                           for="phone">Phone:</label>
                    <input type="text"
                           id="phone"
                           name="phone"
                           value="{{ old('phone') ?? $listing->phone }}"
                           placeholder="Enter listing phone"
                           class="border-gray-200 col-span-5">
                    @error("phone")
                    <span class="text-gray-500 col-span-2"></span>
                    <p class="small text-red-500 col-span-5 text-sm">{{ $message }}</p>
                    @enderror
                </fieldset>

                <fieldset class="grid grid-cols-7">
                    <label class="text-gray-500 col-span-2"
                           for="Email">Email:</label>
                    <input type="text"
                           id="Email"
                           name="email"
                           value="{{ old('email') ?? $listing->email }}"
                           placeholder="Enter email address"
                           class="border-gray-200 col-span-5">
                    @error("email")
                    <span class="text-gray-500 col-span-2"></span>
                    <p class="small text-red-500 col-span-5 text-sm">{{ $message }}</p>
                    @enderror</fieldset>

                <fieldset class="grid grid-cols-7">
                    <label class="text-gray-500 col-span-2"
                           for="requirements">Requirements:</label>
                    <textarea
                        id="requirements"
                        name="requirements"
                        placeholder="Enter requirements"
                        class="border-gray-200 col-span-5"
                        rows="5">{{ old('requirements') ?? $listing->requirements }}</textarea>
                    @error("requirements")
                    <span class="text-gray-500 col-span-2"></span>
                    <p class="small text-red-500 col-span-5 text-sm">{{ $message }}</p>
                    @enderror</fieldset>

                <fieldset class="grid grid-cols-7">
                    <label class="text-gray-500 col-span-2"
                           for="benefits">Benefits:</label>
                    <textarea
                        id="benefits"
                        name="benefits"
                        placeholder="Enter benefits"
                        class="border-gray-200 col-span-5"
                        rows="4">{{ old('benefits') ?? $listing->benefits }}</textarea>
                    @error("benefits")
                    <span class="text-gray-500 col-span-2"></span>
                    <p class="small text-red-500 col-span-5 text-sm">{{ $message }}</p>
                    @enderror</fieldset>

                <fieldset class="grid grid-cols-7">
                    <label class="text-gray-500 col-span-2"
                           for="">Actions</label>
                    <p class="col-span-5 flex gap-4">
                        <button type="submit"
                                class="p-2 px-4 text-center rounded-md
                                      text-green-600 hover:text-green-200 dark:hover:text-black bg-green-200 dark:bg-black hover:bg-green-500
                                      duration-300 ease-in-out transition-all">
                            <i class="fa fa-save text-lg"></i>
                            {{ __('Save Changes') }}
                        </button>
                        <a href="{{ route('listings.show', $listing) }}"
                           class="p-2 px-8 text-center rounded-md
                                      text-blue-600 hover:text-blue-200 dark:hover:text-black bg-blue-200 dark:bg-black hover:bg-blue-500
                                      duration-300 ease-in-out transition-all">
                            <i class="fa fa-xmark text-lg"></i>
                            {{ __('Cancel') }}
                        </a>
                        <a href="{{ route('listings.index') }}" class="p-2 px-4 text-center rounded-md
                                      text-gray-600 hover:text-gray-200 dark:hover:text-black
                                      bg-gray-200 dark:bg-black hover:bg-gray-500
                                      duration-300 ease-in-out transition-all">
                            <i class="fa fa-arrow-left text-lg"></i>
                            {{ __('All listings') }}
                        </a>
                    </p>
                </fieldset>
            </form>
        </section>
    </article>
</x-app-layout>
