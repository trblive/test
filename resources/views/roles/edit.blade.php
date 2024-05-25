<x-app-layout>
    <article class="container mx-auto max-w-7xl">
        <header
            class="py-4 bg-gray-600 text-gray-200 px-4 rounded-t-lg mb-4 flex flex-row justify-between items-center">
            <div>
                <h2 class="text-3xl font-semibold">Management Area</h2>
                <h3 class="text-2xl">Edit Role</h3>
            </div>
            <i class="fa fa-user-pen text-5xl"></i>
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
            <form action="{{ route('roles.update', $role) }}"
                  method="POST"
                  class="max-w-4xl flex flex-col gap-4">

                @csrf
                @method('patch')


                <fieldset class="grid grid-cols-5">
                    <label class="text-gray-500"
                           for="Name">Name:</label>
                    <input type="text"
                           id="Name"
                           name="name"
                           value="{{ old('name') ?? $role->name }}"
                           placeholder="Enter role name"
                           class="border-gray-200 col-span-4">
                    @error("name")
                    <span class="text-gray-500"></span>
                    <p class="small text-red-500 col-span-4 text-sm">{{ $message }}</p>
                    @enderror
                </fieldset>
                <fieldset class="grid grid-cols-5">
                    <p class="text-gray-500">Permissions:</p>
                    <div class="col-span-4 flex justify-between">

                        <div class="flex flex-col gap-3">
                            <p>Users:</p>
                            @foreach($perms_user as $permission)
                                <label class="flex items-center gap-3">
                                    <input type="checkbox"
                                           name="permission[]"
                                           value="{{ $permission->name }}"
                                        {{ in_array($permission->id, $rolePermissions) ? "checked" : "" }}
                                    >
                                    {{ $permission->name }}
                                </label>
                            @endforeach
                        </div>

                        <div class="flex flex-col gap-3">
                            <p>Listings:</p>
                            @foreach($perms_listing as $permission)
                                <label class="flex items-center gap-3">
                                    <input type="checkbox"
                                           name="permission[]"
                                           value="{{ $permission->name }}"
                                        {{ in_array($permission->id, $rolePermissions) ? "checked" : "" }}
                                    >
                                    {{ $permission->name }}
                                </label>
                            @endforeach
                        </div>

                        <div class="flex flex-col gap-3">
                            <p>Roles:</p>
                            @foreach($perms_admin as $permission)
                                <label class="flex items-center gap-3">
                                    <input type="checkbox"
                                           name="permission[]"
                                           value="{{ $permission->name }}"
                                        {{ in_array($permission->id, $rolePermissions) ? "checked" : "" }}
                                    >
                                    {{ $permission->name }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                </fieldset>
                @error("permissions")
                <span class="text-gray-500"></span>
                <p class="small text-red-500 col-span-4 text-sm">{{ $message }}</p>
                @enderror


                <fieldset class="grid grid-cols-5 mt-4">
                    <label class="text-gray-500"
                           for="">Actions</label>
                    <p class="col-span-4 flex gap-4">
                        <a href="{{ route('roles.index') }}" class="p-2 px-4 text-center rounded-md
                                      text-gray-600 hover:text-gray-200 dark:hover:text-black
                                      bg-gray-200 dark:bg-black hover:bg-gray-500
                                      duration-300 ease-in-out transition-all">
                            <i class="fa fa-arrow-left text-lg"></i>
                            {{ __('Back') }}
                        </a>
                        <button type="submit"
                                class="p-2 px-4 text-center rounded-md
                                      text-green-600 hover:text-green-200 dark:hover:text-black bg-green-200 dark:bg-black hover:bg-green-500
                                      duration-300 ease-in-out transition-all">
                            <i class="fa fa-save text-lg"></i>
                            {{ __('Save Changes') }}
                        </button>
                    </p>
                </fieldset>
            </form>
        </section>
    </article>
</x-app-layout>
