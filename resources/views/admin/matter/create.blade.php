<x-admin.layout title="Add Matter">
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("metadata", () => ({
                name: "{{ old('name', '') }}",
                processing: false,
                externalUrl: "{{ old('external_url', '') }}",

                getExternalUrlMetadata: async function () {
                    if (!this.externalUrl) return

                    try {
                        this.processing = true
                        const metadata = await (await (fetch(`{{ route('admin.matter.metadata') }}?url=${this.externalUrl}`))).json()
                        this.name = metadata["title"]
                    } catch (err) {
                        alert("Could not fetch metadata")
                        console.error(err)
                    } finally {
                        this.processing = false
                    }
                },
            }))
        })
    </script>

    <form
        action="{{ route('admin.matter.store') }}"
        method="POST"
        class="space-y-4"
        x-data="metadata"
    >
        @csrf

        <div>
            <label for="type">Type</label>
            <select name="type" id="type">
                @foreach(\App\Models\MatterType::values() as $value)
                    <option value="{{ $value }}" @selected(old('type') === $value)>{{ Str::ucFirst($value) }}</option>
                @endforeach
            </select>

            @error('type')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="name">Name</label>
            <input
                type="text"
                name="name"
                id="name"
                x-model="name"
                value="{{ old('name') }}"
                :disabled="processing"
            >

            @error('name')
            <div class="text-red-500">{{ $message }}</div>
            @enderror

            @error('slug')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="external_url">URL</label>
            <input
                type="url"
                name="external_url"
                id="external_url"
                @change="getExternalUrlMetadata"
                x-model="externalUrl"
                value="{{ old('external_url') }}"
                :disabled="processing"
            >

            @error('external_url')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="tags">Tags</label>
            <select name="tags[]" id="tags" multiple>
                @foreach($tags as $tag)
                    <option
                        value="{{ $tag->id }}"
                    >{{ $tag->name }}</option>
                @endforeach
            </select>

            @error('tags')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="public_at">Public At</label>
            <input type="datetime-local" name="public_at" id="public_at"
                   value="{{ old('public_at', now()->toDateTimeLocalString()) }}">

            @error('public_at')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <x-form.editor :value="''"/>

        <button type="submit" :disabled="processing">Create</button>
    </form>
</x-admin.layout>
