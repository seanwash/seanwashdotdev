@php
    $bookmarks = [
        [
            'label' => 'Thinking in mental models - Julian Shapiro',
            'url' => 'https://www.julian.com/blog/mental-model-examples',
            'tags' => ['Reading'],
        ],
        [
            'label' => 'How to become an expert - Julian Shapiro',
            'url' => 'https://www.julian.com/blog/craftspeople',
            'tags' => ['Reading'],
        ],
        [
            'label' => 'Greg Schier',
            'url' => 'https://schier.co',
            'tags' => ['Website'],
        ],
        [
            'label' => 'Paul Straw',
            'url' => 'https://paulstraw.com',
            'tags' => ['Website'],
        ],
        [
            'label' => 'How To Ask Questions The Smart Way',
            'url' => 'http://www.catb.org/esr/faqs/smart-questions.html',
            'tags' => ['Reading'],
        ],
        [
            'label' => 'Improve how you architect webapps',
            'url' => 'https://patterns.dev',
            'tags' => ['Reading'],
        ],
        [
            'label' => 'How my website works - Brian Lovin',
            'url' => 'https://brianlovin.com/writing/how-my-website-works',
            'tags' => ['Reading'],
        ],
        [
            'label' => 'Adam Wathan',
            'url' => 'https://adamwathan.me',
            'tags' => ['Website'],
        ],
        [
            'label' => 'Brian Lovin',
            'url' => 'https://brianlovin.com',
            'tags' => ['Website'],
        ],
        [
            'label' => 'Staff Eng Archetypes',
            'url' => 'https://leebyron.com/til/staff-eng-archetypes/',
            'tags' => ['Reading'],
        ],
        [
            'label' => 'Why You Should Start a Blog Right Now',
            'url' => 'https://guzey.com/personal/why-have-a-blog/',
            'tags' => ['Reading'],
        ],
        [
            'label' => 'The unreasonable effectiveness of one-on-ones',
            'url' => 'https://www.benkuhn.net/11',
            'tags' => ['Reading'],
        ],
        [
            'label' => 'Flow.rest',
            'url' => 'https://flow.rest',
            'tags' => ['Website'],
        ],
    ];
@endphp

<x-layout
    title="Bookmarks"
    description="A collection of websites, articles, and other resources that I find useful."
>
    <h1>Bookmarks</h1>

    <ul>
        @foreach($bookmarks as $bookmark)
            <li>
                <a
                    href="{{ $bookmark['url'] }}"
                    target="_blank"
                    rel="noopener noreferrer"
                >
                    {{ $bookmark['label'] }}
                </a>

                @foreach($bookmark['tags'] as $tag)
                    <span
                        class="inline-block ml-1 text-xs py-1 px-2 rounded-full bg-gray-100 dark:bg-gray-800"
                    >
                    {{ $tag }}
                </span>
                @endforeach
            </li>
        @endforeach
    </ul>
</x-layout>
