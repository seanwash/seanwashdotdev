@props([
    'name',
])

<label for="{{ $name }}">Type</label>

<div class="relative inline-block w-full text-gray-700" {{ $attributes }}>
    <select class="pr-10 w-full" name="{{ $name }}" id="{{ $name }}">
        {{ $slot }}
    </select>

    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-gray-400">
        <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20">
            <path
                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                clip-rule="evenodd" fill-rule="evenodd"></path>
        </svg>
    </div>
</div>
