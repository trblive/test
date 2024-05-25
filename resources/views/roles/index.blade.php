<x-app-layout>
    <article class="container mx-auto max-w-7xl">
        <header
            class="py-4 bg-gray-600 text-gray-200 px-4 rounded-t-lg mb-4 flex flex-row justify-between items-center">
            <div>
                <h2 class="text-3xl font-semibold">Management Area</h2>
                <h3 class="text-2xl">Roles</h3>
            </div>
            <i class="fa-solid fa-user-gear text-5xl"></i>
        </header>

        @if(Session::has('success'))
            <section id="Messages" class="my-4 px-4">
                <div class="p-4 border-green-500 bg-green-100 text-green-700 rounded-lg">
                    {{Session::get('success')}}
                </div>
            </section>
        @endif

        <section class="px-4 pb-8">
            <header class="flex flex-row justify-between items-center gap-2">
                <p class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Browse') }}
                </p>
            </header>

            <table class="mt-4 table bg-white dark:bg-gray-800
                          overflow-hidden shadow-sm sm:rounded-lg
                          border border-gray-600 dark:border-gray-700 w-full">

                <thead class="py-1 px-2 bg-gray-700 text-gray-200 ">

                <tr class="bg-gray-400 text-gray-800 py-2 rounded-lg ">
                    <th class="pl-2 flex-0 text-left">ID</th>
                    <th class="text-left">Name</th>
                    <th class="text-left">Date created</th>
                    <th class="pr-2 text-right">Actions</th>
                </tr>
                </thead>

                <tbody>
                @foreach($roles as $role)
                    <tr class="group
                               hover:bg-gray-200 dark:hover:bg-gray-900 ease-in-out duration-300 transition-all
                               border border-gray-200 dark:border-gray-700
                               dark:text-gray-400">
                        <td class="py-2 pl-2 flex-0 text-left">{{ $role->id }}</td>
                        <td class="py-2 pl-2 flex-0 text-left">{{ $role->name }}</td>
                        <td class="py-2 text-left">{{ $role->created_at }}</td>
                        <td class="py-2 pr-2 text-right">
                            <form class="flex flex-row gap-2 items-center justify-end"
                                  action="{{ route('roles.destroy', $role) }}"
                                  method="post">
                                @csrf
                                @method('delete')

                                <a href="{{ route('roles.show', $role) }}"
                                   class="h-[36px] flex items-center gap-4 py-1 px-3 rounded-md
                                          text-blue-600 hover:text-blue-200 dark:hover:text-black bg-blue-200 dark:bg-black hover:bg-blue-500
                                          duration-300 ease-in-out transition-all">
                                    <span>View Assignees</span>
                                    <i class="fa-solid fa-chevron-right"></i>
                                </a>

                                <a href="{{ route('roles.edit', $role) }}"
                                   class="h-[36px] flex items-center gap-4 py-1 px-3 rounded-md
                                          text-purple-600 hover:text-purple-200 dark:hover:text-black bg-purple-200 dark:bg-black hover:bg-purple-500
                                          duration-300 ease-in-out transition-all">
                                    <i class="fa fa-pen text-lg"></i>
                                    <span>Edit</span>
                                    <i class="fa-solid fa-chevron-right"></i>
                                </a>
                                <button type="submit"
                                        class="p-1 w-10 text-center rounded-md
                                               text-red-600 hover:text-red-200 dark:hover:text-black bg-red-200 dark:bg-black hover:bg-red-500
                                               duration-300 ease-in-out transition-all">
                                    <i class="fa fa-trash text-lg"></i>
                                    <span class="sr-only">Delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </section>
    </article>
</x-app-layout>
