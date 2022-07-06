@props([
    'value'
])

<div class="space-y-2" x-data="setupEditor('{!! $value !!}')" x-init="() => init($refs.element)">
    <div class="menu">
        <button
            type="button"
            @click="Alpine.raw(editor).chain().toggleHeading({ level: 1 }).focus().run()"
            class="button-xs"
            :class="{ 'is-active': editor.isActive('heading', { level: 1 }) }"
        >
            H1
        </button>
        <button
            type="button"
            @click="Alpine.raw(editor).chain().toggleBold().focus().run()"
            class="button-xs"
            :class="{ 'is-active': editor.isActive('bold') }"
        >
            Bold
        </button>
        <button
            type="button"
            @click="Alpine.raw(editor).chain().toggleItalic().focus().run()"
            class="button-xs"
            :class="{ 'is-active': editor.isActive('italic') }"
        >
            Italic
        </button>
    </div>

    <div class="border border-1 rounded" x-ref="element"></div>
    <input type="hidden" name="content" x-bind:value="content">

    @error('content')
    <div class="text-red-500">{{ $message }}</div>
    @enderror
</div>
