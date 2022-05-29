@php
    // https://css-tricks.com/emoji-as-a-favicon/
@endphp

@env('production')
    <link rel="icon"
          href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22🦾</text></svg>">
@endenv

@env(['local', 'staging'])
    <link rel="icon"
          href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%2🛠</text></svg>">
@endenv
