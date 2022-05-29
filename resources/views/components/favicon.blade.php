@php
    // https://css-tricks.com/emoji-as-a-favicon/
@endphp

@if(app()->environment('production'))
    <link rel="icon"
          href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='0.9em' font-size='90'>🦾</text></svg>">
@endif

@if(app()->environment(['local', 'staging']))
    <link rel="icon"
          href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='0.9em' font-size='90'>⚒️</text></svg>">
@endif
