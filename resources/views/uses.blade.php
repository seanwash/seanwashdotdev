@php
    $tools = [
        [
            'title' => '1Password',
            'url' => 'https://1password.com/',
            'tags' => ['Paid'],
            'description' => <<<EOD
             1Password is literally the first thing I install on every new device.
             EOD,
        ],
        [
            'title' => 'Raycast',
            'url' => 'https://1password.com/',
            'tags' => ['Free'],
            'description' => <<<EOD
             Raycast is a blazing fast, totally extendable launcher. It lets you complete tasks, calculate, share
                common links, and much more. I use it for everything from window management and controlling Apple Music
                to updating my Slack status.
             EOD,
        ],
        [
            'title' => 'Better Touch Tool',
            'url' => 'https://folivora.ai',
            'tags' => ['Paid', 'Indie'],
            'description' => <<<EOD
             While Better Touch Tool is an extremely powerful utility for MacOS, I primarily use the <a
                    href="https://docs.folivora.ai/docs/1004_hyper_key.html">hyper key feature</a>. I use the hyper key
                in conjunction with Raycast so that I can launch my most often used apps via shortcuts. For example,
                <code>hyper + t</code> will launch or focus my Terminal window, <code>hyper + i</code> will open or
                focus Intellij, etc.
             EOD,
        ],
        [
            'title' => 'CleanShot',
            'url' => 'https://cleanshot.com/',
            'tags' => ['Paid'],
            'description' => <<<EOD
             CleanShot quickly replaced MacOS's built in screenshot tooling for me. It's a one-stop shop and has
                everything I need for sharing what I'm working on with my team.
             EOD,
        ],
        [
            'title' => 'SoundSource',
            'url' => 'https://rogueamoeba.com/soundsource/',
            'tags' => ['Paid'],
            'description' => <<<EOD
             SoundSource is a MacOS app that gives you greater control over all things audio. You get a per-app audio
                mixer, and you can even add a different EQ to any audio source
             EOD,
        ],
    ];
@endphp

<x-layout
    title="Uses"
    description="Stuff that I use."
>
    <h1>Uses</h1>

    <ul>
        @foreach($tools as $tool)
            <li>
                <div>
                    <a href="{{ $tool['url'] }}" target="_blank" rel="noopener noreferrer">{{ $tool['title'] }}</a>

                    @foreach($tool['tags'] as $tag)
                        <span
                            class="inline-block ml-1 text-xs py-1 px-2 rounded-full bg-gray-100 dark:bg-gray-800"
                        >
                        {{ $tag }}
                    </span>
                    @endforeach
                </div>

                <p>{!! $tool['description'] !!}</p>
            </li>
        @endforeach
    </ul>
</x-layout>
