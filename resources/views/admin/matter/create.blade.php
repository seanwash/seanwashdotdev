<x-admin.layout title="Add Matter">

    <form action="{{ route('admin.matter.store') }}" method="POST" class="space-y-4">
        @csrf

        <div>
            <label for="type">Type</label>
            <select name="type" id="type">
                @foreach(\App\Models\MatterType::values() as $value)
                    <option value="{{ $value }}">{{ Str::ucFirst($value) }}</option>
                @endforeach
            </select>

            @error('type')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name">

            @error('name')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="external_url">URL</label>
            <input type="url" name="external_url" id="external_url">

            @error('external_url')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="content">Content</label>
            <textarea name="content" id="content"></textarea>

            @error('content')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="public_at">Public At</label>
            <input type="datetime-local" name="public_at" id="public_at">

            @error('public_at')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Create</button>
    </form>

</x-admin.layout>
