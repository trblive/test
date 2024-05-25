<x-app-layout>

    <x-slot name="navigation">
    </x-slot>

    <x-slot name="topBanner">
        <section class="bg-blue-900 text-white py-6 text-center">
            <div class="container mx-auto">
                <h2 class="text-3xl font-semibold">Unlock Your Career Potential</h2>
                <p class="text-lg mt-2">
                    Discover the perfect job opportunity for you.
                </p>
            </div>
        </section>

    </x-slot>

    <div class="py-0">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="pb-6 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Welcome, {{ $user->name }}
            </h2>

            <!-- profile info -->
            <div class="flex gap-12">
                <div class="py-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-2/3">
                    <h2 class="px-8 text-xl font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Profile Information') }}
                    </h2>
                    <p class="px-8 mt-1 mb-6 text-md text-gray-600 dark:text-gray-400">
                        {{ __("Lorem ipsum dolor sit amet") }}
                    </p>
                    <div
                        class="flex items-end px-8 hover:bg-gray-200 dark:hover:bg-gray-900 ease-in-out duration-300 transition-all">
                        <p class="w-1/4 text-sm text-gray-600 font-medium py-3 border-b-1 border-gray-300">Name:</p>
                        <p class="w-3/4 py-3 border-b-1 border-gray-300">{{ $user->name }}</p>
                    </div>
                    <div
                        class="flex items-end px-8 hover:bg-gray-200 dark:hover:bg-gray-900 ease-in-out duration-300 transition-all">
                        <p class="w-1/4 text-sm text-gray-600 font-medium py-3 border-b-1 border-gray-300">Email:</p>
                        <p class="w-3/4 py-3 border-b-1 border-gray-300">{{ $user->email }}</p>
                    </div>
                    <div
                        class="flex items-end px-8 hover:bg-gray-200 dark:hover:bg-gray-900 ease-in-out duration-300 transition-all">
                        <p class="w-1/4 text-sm text-gray-600 font-medium py-3 border-b-1 border-gray-300">City:</p>
                        <p class="w-3/4 py-3 border-b-1 border-gray-300">{{ $user->city }}</p>
                    </div>
                    <div
                        class="flex items-end px-8 hover:bg-gray-200 dark:hover:bg-gray-900 ease-in-out duration-300 transition-all">
                        <p class="w-1/4 text-sm text-gray-600 font-medium py-3">State:</p>
                        <p class="w-3/4 py-3">{{ $user->state }}</p>
                    </div>
                </div>

                <form class="w-1/3 flex flex-col items-center gap-8"
                      action="{{ route('dashboard.delete') }}"
                      method="GET">

                    <a href="{{ route('dashboard.show') }}"
                       class="w-3/4 flex justify-center items-center gap-4 px-5 py-2.5 shadow-sm rounded border text-base font-medium text-blue-600 hover:text-blue-200 dark:hover:text-black bg-blue-200 dark:bg-black hover:bg-blue-500 duration-300 ease-in-out transition-all">
                        <i class="fa fa-eye text-lg"></i>
                        <span>Preview</span>
                    </a>
                    <a href="{{ route('dashboard.edit') }}"
                       class="w-3/4 flex justify-center items-center gap-4 px-5 py-2.5 shadow-sm rounded border text-base font-medium text-purple-600 hover:text-purple-200 dark:hover:text-black bg-purple-200 dark:bg-black hover:bg-purple-500 duration-300 ease-in-out transition-all">
                        <i class="fa fa-pen text-lg"></i>
                        <span>Edit Profile</span>
                    </a>
                    <button type="submit"
                            class="w-3/4 flex justify-center items-center gap-4 px-5 py-2.5 shadow-sm rounded border text-base font-medium text-red-600 hover:text-red-200 dark:hover:text-black bg-red-200 dark:bg-black hover:bg-red-500 duration-300 ease-in-out transition-all">
                        <i class="fa fa-trash text-lg"></i>
                        <span>Delete Profile</span>
                    </button>
                </form>
            </div>


            <div class="h-px w-full bg-gray-400 my-12"></div>

            <!-- Manage content -->
            <h2 class="mb-4 text-xl font-medium text-gray-900 dark:text-gray-100">
                {{ __('Manage Content') }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- roles -->
                <div class="p-4 rounded-lg shadow-md bg-white">
                    <div class="flex items-end gap-6 mb-6">
                        <div class="p-4 bg-indigo-200 text-indigo-700 rounded-lg">
                            <i class="fa-solid fa-user-gear text-5xl"></i>
                        </div>
                        <h3 class="mb-2 text-xl font-semibold">Roles</h3>
                    </div>
                    <div class="h-px w-full bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                    <div class="flex justify-between mt-6">
                        <p class="flex flex-col">
                            <span class="font-bold"></span>
                            <span class="text-gray-500 text-sm">Roles</span>
                        </p>
                        <a href="{{ route('roles.index') }}"
                           class="flex items-center gap-4 px-5 py-2.5 shadow-sm rounded border text-base font-medium text-blue-600 hover:text-white dark:hover:text-black bg-blue-200 dark:bg-black hover:bg-blue-500 duration-300 ease-in-out transition-all">
                            <span>View more</span>
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
                <!-- users -->
                <div class="p-4 rounded-lg shadow-md bg-white">
                    <div class="flex items-end gap-6 mb-6">
                        <div class="p-4 bg-indigo-200 text-indigo-700 rounded-lg">
                            <i class="fa fa-users text-5xl"></i>
                        </div>
                        <h3 class="mb-2 text-xl font-semibold">Users</h3>
                    </div>
                    <div class="h-px w-full bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                    <div class="flex justify-between mt-6">
                        <p class="flex flex-col">
                            <span class="font-bold">{{ $usersCount }}</span>
                            <span class="text-gray-500 text-sm">Users</span>
                        </p>
                        <a href="{{ route('users.index') }}"
                           class="flex items-center gap-4 px-5 py-2.5 shadow-sm rounded border text-base font-medium text-blue-600 hover:text-white dark:hover:text-black bg-blue-200 dark:bg-black hover:bg-blue-500 duration-300 ease-in-out transition-all">
                            <span>View more</span>
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
                <!-- listings-->
                <div class="p-4 rounded-lg shadow-md bg-white">
                    <div class="flex items-end gap-6 mb-6">
                        <div class="p-4 bg-indigo-200 text-indigo-700 rounded-lg">
                            <i class="fa-solid fa-list text-5xl"></i>
                        </div>
                        <h3 class="mb-2 text-xl font-semibold">Listings</h3>
                    </div>
                    <div class="h-px w-full bg-gradient-to-r from-transparent via-gray-300 to-transparent"></div>
                    <div class="flex justify-between mt-6">
                        <p class="flex flex-col">
                            <span class="font-bold">{{ $listingsCount }}</span>
                            <span class="text-gray-500 text-sm">Listings</span>
                        </p>
                        <a href="{{ route('listings.index') }}"
                           class="flex items-center gap-4 px-5 py-2.5 shadow-sm rounded border text-base font-medium text-blue-600 hover:text-white dark:hover:text-black bg-blue-200 dark:bg-black hover:bg-blue-500 duration-300 ease-in-out transition-all">
                            <span>View more</span>
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
