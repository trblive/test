<footer class="mt-8 w-full min-h-36 bg-neutral-800 text-neutral-300 sticky text-sm" xmlns="http://www.w3.org/1999/html">
    <div class="container mx-auto my-6 bg-blue-800 text-white rounded p-4 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-semibold">Looking to hire?</h2>
            <p class="text-gray-200 text-lg mt-2">
                Post your job listing now and find the perfect candidate.
            </p>
        </div>
        <a href="{{ route('listings.create') }}"
           class="ml-6 px-4 rounded-md py-2
                  text-black bg-yellow-400 shadow shadow-black/70
                  hover:text-yellow-300 hover:bg-yellow-600 hover:shadow-none
                  transition duration-300 h-10">
            <i class="fa fa-edit"></i> Post a Job
        </a>
    </div>

    <div class="container grid grid-cols-1 md:grid-cols-8 mx-auto p-6 gap-8">
        <!-- left section -->
        <section class="md:col-span-2 flex flex-col justify-start gap-2">
            <p xmlns:cc="http://creativecommons.org/ns#" xmlns:dct="http://purl.org/dc/terms/">
                <a property="dct:title" rel="cc:attributionURL" href="https://laravel-bootcamp.screencraft.net.au"
                   class="hover:text-neutral-200  underline underline-offset-2">Laravel Bootcamp (Enhanced)</a>
                by
                <a rel="cc:attributionURL dct:creator" property="cc:attributionName" href="https://adygcode.github.io"
                   class="hover:text-neutral-200 underline underline-offset-2">Adrian Gould</a>
                is licensed under
                <a href="https://creativecommons.org/licenses/by-sa/4.0/?ref=chooser-v1" target="_blank"
                   rel="license noopener noreferrer"
                   class="space-x-0.5 hover:text-neutral-200">
                    <span class="underline underline-offset-2">CC BY-SA 4.0 International</span>
                    <i class="text-md fa-brands fa-creative-commons px-1"></i><i
                        class="text-md fa-brands fa-creative-commons-by pr-1"></i><i
                        class="text-md fa-brands fa-creative-commons-sa pr-1"></i>
                </a>
            </p>
        </section>

        <!-- middle section -->
        <section class="md:col-span-3 gap-4 flex flex-wrap justify-center h-fit">
            <img alt="Laravel Badge" src="https://img.shields.io/badge/Laravel-FF2D20?logo=laravel&logoColor=white"
                 class="max-h-4 md:max-h-6">
            <img alt="TailwindCSS Badge"
                 src="https://img.shields.io/badge/Tailwindcss-06B6D4?logo=tailwindcss&logoColor=white"
                 class="max-h-4 md:max-h-6">
            <img alt="SQLite Badge"
                 src="https://img.shields.io/badge/Sqlite-003B57?style=for-the-badge&logo=sqlite&logoColor=white"
                 class="max-h-4 md:max-h-6">
            <img alt="PhpStorm Badge"
                 src="https://img.shields.io/badge/Phpstorm-000000?style=for-the-badge&logo=phpstorm&logoColor=white"
                 class="max-h-4 md:max-h-6">
            <img alt="NPM Badge"
                 src="https://img.shields.io/badge/Npm-CB3837?style=for-the-badge&logo=npm&logoColor=white"
                 class="max-h-4 md:max-h-6">
            <img alt="Composer Badge"
                 src="https://img.shields.io/badge/Composer-885630?style=for-the-badge&logo=composer&logoColor=white"
                 class="max-h-4 md:max-h-6">
            <img alt="Vite Badge"
                 src="https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white"
                 class="max-h-4 md:max-h-6">
            <img alt="Laragon Badge"
                 src="https://img.shields.io/badge/Laragon-0E83CD?style=for-the-badge&logo=laragon&logoColor=white"
                 class="max-h-4 md:max-h-6">
        </section>

        <!-- right section -->
        <section
            class="md:col-span-3 flex flex-col gap-2 justify-start p-4 bg-amber-900 text-amber-500 font-light rounded-lg shadow">
            <p>We acknowledge all Aboriginal and Torres Strait Islander Traditional Custodians of Country and recognize
                their continuing connection to land, sea, culture and community.</p>
            <p>We pay our respects to Elders past, present and future.</p>
        </section>
    </div>
</footer>

@include('layouts.dev-mode')
