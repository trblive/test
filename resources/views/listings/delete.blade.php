<x-app-layout>
    <!-- listing -->
    <section class="container mx-auto p-4 mt-4">
        <header
            class="py-4 bg-gray-600 text-gray-200 px-4 rounded-t-lg mb-4 flex flex-row justify-between items-center">
            <div>
                <h2 class="text-3xl font-semibold">Are you sure you want to delete {{ $listing->title }}?</h2>
            </div>
            <i class="fa fa-user text-5xl"></i>
        </header>

        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach

        <form class="flex flex-row gap-2 my-4 justify-center items-center "
              action="{{ route('listings.destroy', $listing) }}"
              method="POST">
            @csrf
            @method('DELETE')

            <a href="{{ route('listings.index') }}"
               class="px-5 py-2.5 text-center shadow-sm rounded border text-base font-medium text-blue-600 hover:text-blue-200 dark:hover:text-black bg-blue-200 dark:bg-black hover:bg-blue-500 duration-300 ease-in-out transition-all">
                <i class="fa fa-arrow-left text-lg"></i>
                <span>Cancel</span>
            </a>

            <button type="submit"
                    class="px-5 py-2.5 text-center shadow-sm rounded border text-base font-medium text-red-600 hover:text-red-200 dark:hover:text-black bg-red-200 dark:bg-black hover:bg-red-500 duration-300 ease-in-out transition-all">
                <i class="fa fa-trash text-lg"></i>
                <span>Confirm</span>
            </button>
        </form>

        <div class="rounded-lg shadow-md bg-white p-3">
            <!-- back -->
            <div class="flex justify-between items-center">
                <a class="block p-4 text-blue-700" href="{{ route('listings.index') }}">
                    <i class="fa fa-arrow-alt-circle-left"></i>
                    Back To Listings
                </a>
            </div>

            <div class="p-4">
                <h2 class="text-xl font-semibold">{{ $listing->title }}</h2>
                <p class="text-gray-700 text-lg mt-2">{{ $listing->description }}</p>

                <ul class="my-4 bg-gray-100 p-4">
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
            </div>
        </div>
    </section>

    <!-- details -->
    <section class="container mx-auto p-4">
        <h2 class="text-xl font-semibold mb-4">Job Details</h2>
        <div class="rounded-lg shadow-md bg-white p-4">
            <h3 class="text-lg font-semibold mb-2 text-blue-500">Job Requirements</h3>
            <p>{{ $listing->requirements }}</p>
            <h3 class="text-lg font-semibold mt-4 mb-2 text-blue-500">Benefits</h3>
            <p>{{ $listing->benefits }}</p>
        </div>
    </section>
</x-app-layout>
