@props([
    'title' => 'Sean Washington',
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

        <x-favicon/>
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;600;700&display=swap"
              rel="stylesheet">

        @vite('resources/css/app.css')
    </head>
    <body class="dark:bg-black dark:text-white" {{ $attributes }}>
        <nav class="p-8 pb-0 space-x-2 flex items-center justify-between">
            <div class="space-x-2">
                <a
                    @class([
                        "text-gray-500",
                        "font-bold text-black dark:text-white" => Route::is('admin.home')
                    ])
                    href="{{ route('admin.home') }}"
                >
                    Admin
                </a>

                <a
                    @class([
                        "text-gray-500",
                        "font-bold text-black dark:text-white" => Route::is('admin.matter.create')
                    ])
                    href="{{ route('admin.matter.create') }}"
                >
                    Add Matter
                </a>
            </div>

            <a
                @class([
                    "text-gray-500",
                    "font-bold text-black dark:text-white" => Route::is('home')
                ])
                href="{{ route('home') }}"
            >
                Back to site
            </a>
        </nav>

        <div class="p-8 max-w-full prose dark:prose-invert">
            {{ $slot }}
        </div>

        @vite('resources/js/app.js')
    </body>
</html>
