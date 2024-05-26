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
            <img alt="PHP Badge"
                 src="https://img.shields.io/badge/Php-777BB4?style=for-the-badge&logo=php&logoColor=white"
                 class="max-h-4 md:max-h-6">
            <img alt="Laravel Badge"
                 src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white"
                 class="max-h-4 md:max-h-6">
            <img alt="TailwindCSS Badge"
                 src="https://img.shields.io/badge/Tailwindcss-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white"
                 class="max-h-4 md:max-h-6">
            <img alt="SQLite Badge"
                 src="https://img.shields.io/badge/Sqlite-003B57?style=for-the-badge&logo=sqlite&logoColor=white"
                 class="max-h-4 md:max-h-6">
            <img alt="PhpStorm Badge"
                 src="https://img.shields.io/badge/PHPStorm-FF45ED?style=for-the-badge&logo=phpstorm&logoColor=white"
                 class="max-h-4 md:max-h-6">
            <img alt="Docker Badge"
                 src="https://img.shields.io/badge/docker-2496ED?style=for-the-badge&logo=docker&logoColor=white"
                 class="max-h-4 md:max-h-6">
            <img alt="Breeze Badge"
                 src="https://img.shields.io/badge/Breeze-fcbe24?style=for-the-badge&logo=data%3Aimage%2Fsvg%2Bxml%3Bbase64%2CPD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyBpZD0iTGF5ZXJfMiIgZGF0YS1uYW1lPSJMYXllciAyIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZlcnNpb249IjEuMSIgdmlld0JveD0iMCAwIDY4IDY4Ij4KICA8ZGVmcz4KICAgIDxzdHlsZT4KICAgICAgLmNscy0xIHsKICAgICAgICBmaWxsOiAjMzgzODM4OwogICAgICAgIHN0cm9rZS13aWR0aDogMHB4OwogICAgICB9CiAgICA8L3N0eWxlPgogIDwvZGVmcz4KICA8cGF0aCBjbGFzcz0iY2xzLTEiIGQ9Ik00MS44LDI2LjJsLTcuOCw3LjhoMTUuNmwtNy44LTcuOFpNMTguNSwzNGw3LjgsNy44LDcuOC03LjhoLTE1LjVaTTI2LjIsMjYuMmw3LjgsNy44di0xNS41bC03LjgsNy44Wk02OCwzNGMwLTkuMy0zLjgtMTcuOC05LjktMjMuOSwwLDAsMCwwLDAsMEM1MS45LDMuOCw0My40LDAsMzQsMCwxNS4yLDAsMCwxNS4yLDAsMzRzMy44LDE3LjksMTAsMjQuMWwxNS41LTE1LjYtOC41LTguNS03LTdWMTBsMTUuNSwxNS41LDguNS04LjVoMGMwLDAsNy02LjksNy02LjloMTdsLTE1LjUsMTUuNCw4LjYsOC41aDBjMCwwLDcuMSw3LjEsNy4xLDcuMXYxNi44YzYuMS02LjEsOS45LTE0LjYsOS45LTIzLjlaTTM0LDM0di0xNS41bC03LjgsNy44LDcuOCw3LjhaTTI2LjIsMjYuMmw3LjgsNy44di0xNS41bC03LjgsNy44Wk00Mi42LDQyLjZsLTguNiw4LjYtNyw3SDEwLjFjNi4xLDYuMSwxNC42LDkuOSwyMy45LDkuOXMxNy45LTMuOCwyNC0xMGwtMTUuNS0xNS41Wk0zNCwzNHYxNS42bDcuOC03LjgtNy44LTcuOFoiLz4KPC9zdmc%2B"
                 class="max-h-4 md:max-h-6">
            <img alt="Pest Badge"
                 src="https://img.shields.io/badge/Pest-f471b5?style=for-the-badge&logo=data%3Aimage%2Fsvg%2Bxml%3Bbase64%2CPD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyBpZD0icGVzdCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB2ZXJzaW9uPSIxLjEiIHZpZXdCb3g9IjAgMCA0NSAxMC4yIj4KICA8ZGVmcz4KICAgIDxzdHlsZT4KICAgICAgLmNscy0xIHsKICAgICAgICBmaWxsOiAjZmZmOwogICAgICAgIHN0cm9rZS13aWR0aDogMHB4OwogICAgICB9CiAgICA8L3N0eWxlPgogIDwvZGVmcz4KICA8cGF0aCBjbGFzcz0iY2xzLTEiIGQ9Ik0xMS40LDIuOUMxMS42LDEuMywxMC42LDAsOSwwSDEuOGwtLjUsMi45aDcuMmwtLjIsMUgxLjFsLTEuMSw2LjNoMi45bC42LTMuNWg0LjNjMS42LDAsMy4xLTEuMywzLjQtMi45bC4yLTFaTTE5LjgsMy45aC03LjdsLS40LDIuNGg3LjZsLjUtMi40Wk0yMi45LDBoLTEwLjFsLS41LDIuOWgxMC4xTDIyLjksMFpNMTEsMTAuMmgxMC4xbC41LTIuOWgtMTAuMWwtLjUsMi45Wk0yNi44LDBDMjUuMiwwLDIzLjcsMS4zLDIzLjQsMi45di41YzAsMCwwLDAsMCwwLS4yLDEuNS44LDIuOSwyLjQsMi45aDQuM2wtLjIsMS4xaC03LjJsLS41LDIuOWg3LjJjMS42LDAsMy4xLTEuMywzLjQtMi45bC4yLTEuMWMuMy0xLjYtLjgtMi45LTIuNC0yLjloLTQuM3YtLjRoOS43bC0xLjMsNy4zaDIuOWwxLjMtNy4zaDIuOUM0My4yLDIuOSw0NC43LDEuNiw0NSwwaC0xOC4yWiIvPgo8L3N2Zz4%3D"
                 class="max-h-4 md:max-h-6">
            <img alt="NPM Badge"
                 src="https://img.shields.io/badge/Npm-CB3837?style=for-the-badge&logo=npm&logoColor=white"
                 class="max-h-4 md:max-h-6">
            <img alt="Composer Badge"
                 src="https://img.shields.io/badge/Composer-885630?style=for-the-badge&logo=composer&logoColor=white"
                 class="max-h-4 md:max-h-6">
            <img alt="Spatie Badge"
                 src="https://img.shields.io/badge/Spatie-197593?style=for-the-badge"
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
