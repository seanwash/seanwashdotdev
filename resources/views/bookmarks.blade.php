<x-layout
    title="Bookmarks"
    description="A collection of websites, articles, and other resources that I find useful."
>
    <h1>Bookmarks</h1>

    <ul>
        @foreach($bookmarks as $bookmark)
            <li>
                <a
                    href="{{ $bookmark->url }}"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    {{ $bookmark->name }}
                </a>

                @foreach($bookmark->tags as $tag)
                    <x-tag>
                        {{ $tag->name }}
                    </x-tag>
                @endforeach
            </li>
        @endforeach
    </ul>
</x-layout>
