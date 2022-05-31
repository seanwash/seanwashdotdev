<x-layout
    title="Uses"
    description="Stuff that I use."
>
    <h1>Uses</h1>

    <ul>
        @foreach($tools as $tool)
            <li>
                <div>
                    <a href="{{ $tool->external_url }}" target="_blank" rel="noopener noreferrer">{{ $tool->name }}</a>

                    @foreach($tool->tags as $tag)
                        <x-tag>
                            {{ $tag->name }}
                        </x-tag>
                    @endforeach
                </div>

                <p>{!! $tool->content !!}</p>
            </li>
        @endforeach
    </ul>
</x-layout>
