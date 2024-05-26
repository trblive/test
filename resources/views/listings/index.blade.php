<x-app-layout>
    <section>
        <header>
            <h2 class="text-center mb-4 text-3xl border border-gray-300 font-bold p-3 bg-gray-200 dark:bg-gray-500 text-black dark:text-white/80 rounded-lg">
                Recent Job Listings
            </h2>
            <section class="flex flex-row justify-end gap-4 my-4">
                <a href="{{ route('listings.create') }}"
                   class="p-2 px-4 text-center rounded-md h-10
                          text-blue-600 hover:text-blue-200 bg-blue-200 hover:bg-blue-500
                          duration-300 ease-in-out transition-all">
                    <i class="fa-solid fa-pen-to-square font-xl"></i>
                    {{ __('New Listing') }}
                </a>

                <a href="{{ route('listings.trash') }}"
                   class="p-2 px-4 text-center rounded-md h-10
                          @if($trashedCount>0)
                            text-slate-200 hover:text-slate-600 bg-slate-600 hover:bg-slate-500
                          @else
                            text-slate-600 hover:text-slate-200 bg-slate-200 hover:bg-slate-500
                          @endif
                          duration-300 ease-in-out transition-all space-x-2">
                    <i class="fa fa-trash font-xl"></i>
                    {{ $trashedCount }} {{ __('Deleted') }}
                </a>
            </section>
        </header>

        @if(Session::has('success'))
            <section id="Messages" class="my-4 px-4">
                <div class="p-4 border-green-500 bg-green-100 text-green-700 rounded-lg">
                    {{Session::get('success')}}
                </div>
            </section>
        @endif
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <!-- Job Listings -->
            @foreach($listings as $listing)
                <div class="rounded-lg shadow-md bg-white">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold">{{ $listing->title }}</h3>
                        <p class="text-gray-600 mt-2">{{ $listing->company }}</p>
                        <p class="text-gray-700 text-md mt-2">{{ $listing->description }}</p>
                        <ul class="my-4 bg-gray-100 p-4 rounded text-sm">
                            <li class="mb-2">
                                <strong>Salary:</strong>
                                {{ $listing->salary }}
                            </li>
                            <li class="mb-2">
                                <strong>Location:</strong>
                                {{ $listing->city }},
                                {{ $listing->state }}
                            </li>
                            <li class="mb-2">
                                <strong>Tags:</strong>
                                {{ $listing->tags }}
                            </li>
                        </ul>
                        <form class="flex flex-row gap-2 items-center justify-between"
                              action="{{ route('listings.delete', $listing) }}"
                              method="GET">
                            @can(['Listing-Browse'])
                                <a href="{{ route('listings.show', $listing )}}"
                                   class="block w-full text-center my-2 px-5 py-2.5 shadow-sm rounded border text-base font-medium text-blue-600 hover:text-blue-200 dark:hover:text-black bg-blue-200 dark:bg-black hover:bg-blue-500 duration-300 ease-in-out transition-all">
                                    <i class="fa fa-eye text-lg"></i>
                                    <span>Details</span>
                                </a>
                            @endcan
                            @if(($canEdit) || ($listing->user_id === $user->id))
                                <a href="{{ route('listings.edit', $listing )}}"
                                   class="block w-full text-center my-2 px-5 py-2.5 shadow-sm rounded border text-base font-medium text-purple-600 hover:text-purple-200 dark:hover:text-black bg-purple-200 dark:bg-black hover:bg-purple-500 duration-300 ease-in-out transition-all">
                                    <i class="fa fa-pen text-lg"></i>
                                    <span>Edit</span>
                                </a>
                                <button type="submit"
                                        class="block w-full text-center my-2 px-5 py-2.5 shadow-sm rounded border text-base font-medium text-red-600 hover:text-red-200 dark:hover:text-black bg-red-200 dark:bg-black hover:bg-red-500 duration-300 ease-in-out transition-all">
                                    <i class="fa fa-trash text-lg"></i>
                                    <span>Delete</span>
                                </button>
                            @endif
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</x-app-layout>
