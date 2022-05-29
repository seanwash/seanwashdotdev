@props([
    'title' => 'Sean Washington',
    'description' => 'Software Developer based in Santa Cruz, CA'
])

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title }}</title>

        <meta name="description" content="{{ $description }}">
        <meta property="og:description" content="{{ $description }}">

        <x-favicon/>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="dark:bg-black dark:text-white">
        <nav class="p-8 pb-0 space-x-2">
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
        </nav>

        <div class="p-8 prose dark:prose-invert">
            {{ $slot }}
        </div>
    </body>
</html>
