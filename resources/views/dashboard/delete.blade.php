<x-app-layout>
    <article class="container mx-auto max-w-7xl">
        <header
            class="py-4 bg-gray-600 text-gray-200 px-4 rounded-t-lg mb-4 flex flex-row justify-between items-center">
            <div>
                <h2 class="text-3xl font-semibold">Are you sure you want to delete your account?</h2>
            </div>
            <i class="fa fa-user text-5xl"></i>
        </header>

        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach


        <section
            class="flex flex-col gap-4 p-4">
            <div class="grid grid-cols-12">
                <p class="col-span-12 md:col-span-2 xl:col-span-1 text-gray-500">Name</p>
                <p class="col-span-12 md:col-span-10 xl:col-span-11 ">{{ $user->name }}</p>
            </div>

            <div class="grid grid-cols-12">
                <p class="col-span-12 md:col-span-2 xl:col-span-1 text-gray-500">Email</p>
                <p class="col-span-12 md:col-span-10 xl:col-span-11 ">{{ $user->email }}</p>
            </div>

            <div class="grid grid-cols-12">
                <p class="col-span-12 md:col-span-2 xl:col-span-1 text-gray-500">City</p>
                <p class="col-span-12 md:col-span-10 xl:col-span-11 ">{{ $user->city }}</p>
            </div>

            <div class="grid grid-cols-12">
                <p class="col-span-12 md:col-span-2 xl:col-span-1 text-gray-500">State</p>
                <p class="col-span-12 md:col-span-10 xl:col-span-11 ">{{ $user->state }}</p>
            </div>

            <div class="grid grid-cols-12">
                <p class="col-span-12 md:col-span-2 xl:col-span-1 text-gray-500">Last Login</p>
                <p class="col-span-12 md:col-span-10 xl:col-span-11  ">{{ $user->login_at ?? "---" }}</p>
            </div>

            <div class="grid grid-cols-12">
                <p class="col-span-12 md:col-span-2 xl:col-span-1 text-gray-500">Actions</p>
                <form class="col-span-12 md:col-span-10 xl:col-span-11 flex flex-row gap-2 items-center "
                      action="{{ route('dashboard.destroy', $user) }}"
                      method="POST">
                    @csrf
                    @method('DELETE')

                    <a href="{{ route('dashboard') }}"
                       class="p-1 px-6 text-center rounded-md
                                      text-blue-600 hover:text-blue-200 dark:hover:text-black bg-blue-200 dark:bg-black hover:bg-blue-500
                                      duration-300 ease-in-out transition-all">
                        <i class="fa fa-arrow-left text-lg"></i>
                        <span>Cancel</span>
                    </a>

                    <button type="submit"
                            class="p-1 px-2 text-center rounded-md
                                           text-red-600 hover:text-red-200 dark:hover:text-black bg-red-200 dark:bg-black hover:bg-red-500
                                           duration-300 ease-in-out transition-all">
                        <i class="fa fa-trash text-lg"></i>
                        <span>Confirm</span>
                    </button>
                </form>
            </div>
        </section>
    </article>
</x-app-layout>
