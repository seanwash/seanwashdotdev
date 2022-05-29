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
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="dark:bg-black dark:text-white">
        <div class="p-8 prose dark:prose-invert">
            {{ $slot }}
        </div>
    </body>
</html>
