@props([
    'title' => 'Sean Washington',
    'description' => 'Software Developer based in Santa Cruz, CA'
])

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @if(Route::is('home'))
            <title>{{ $title }}</title>
        @else
            <title>{{ $title }} – Sean Washington</title>
        @endif

        <meta name="description" content="{{ $description }}">
        <meta property="og:description" content="{{ $description }}">

        <x-favicon/>
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;600;700&display=swap"
              rel="stylesheet">

        @vite('resources/css/app.css')
    </head>
    <body class="dark:bg-black dark:text-white">
        <nav class="p-8 pb-0 flex items-center justify-between">
            <div class="space-x-2">
                <a
                    @class([
                        "text-gray-500",
                        "font-bold text-black dark:text-white" => Route::is('home')
                    ])
                    href="{{ route('home') }}"
                >
                    Home
                </a>

                <a
                    @class([
                        "text-gray-500",
                        "font-bold text-black dark:text-white" => Route::is('uses')
                    ])
                    href="{{ route('uses') }}"
                >
                    Uses
                </a>

                <a
                    @class([
                        "text-gray-500",
                        "font-bold text-black dark:text-white" => Route::is('bookmarks')
                    ])
                    href="{{ route('bookmarks') }}"
                >
                    Bookmarks
                </a>
            </div>

            @auth()
                <div>

                    <a
                        class="text-gray-500"
                        href="{{ route('admin.home') }}"
                    >
                        Admin
                    </a>
                </div>
            @endauth
        </nav>

        <div class="p-8 prose dark:prose-invert">
            {{ $slot }}
        </div>

        @vite('resources/js/app.js')

        @if(app()->environment('production') && ! Auth::check())
            <script
                src="https://cdn.usefathom.com/script.js"
                data-site="{{ config('services.fathom.site_id') }}"
                defer
            ></script>
        @endif
    </body>
</html>
