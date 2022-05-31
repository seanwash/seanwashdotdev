<x-admin.layout title="Admin">
    <ul>
        @foreach($matter as $matter_item)
            <li>
                @if($matter_item->external_url)
                    <a href="{{ $matter_item->external_url }}">{{ $matter_item->name }}</a>
                @else
                    {{ $matter_item->name }}
                @endif

                <x-tag>{{ $matter_item->type->value }}</x-tag>
            </li>
        @endforeach
    </ul>
</x-admin.layout>
