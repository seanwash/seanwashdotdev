<x-admin.layout title="Admin">

    <form action="{{ route('admin.home') }}" method="GET" class="flex items-end space-x-2">
        <div>
            <label for="type">Type</label>
            <select name="type" id="type">
                <option selected value="">
                    All Types
                </option>
                @foreach(\App\Models\MatterType::values() as $value)
                    <option
                        value="{{ $value }}"
                        @selected(request()->query('type') === $value)
                    >{{ Str::ucFirst($value) }}</option>
                @endforeach
            </select>
        </div>

        <div class="space-x-2">
            <button type="submit">Filter</button>
        </div>
    </form>

    <table>
        <thead>
            <tr>
                <th>Type</th>
                <th>Name</th>
                <th>Tags</th>
                <th>Public At</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($matter as $matter_item)
                <tr>
                    <td>
                        <x-tag>{{ $matter_item->type }}</x-tag>
                    </td>
                    <td>
                        @if($matter_item->external_url)
                            <a href="{{ $matter_item->external_url }}">{{ $matter_item->name }}</a>
                        @else
                            {{ $matter_item->name }}
                        @endif
                    </td>
                    <td>
                        <x-tag-list>
                            @foreach($matter_item->tags as $tag)
                                <x-tag>{{ $tag->name }}</x-tag>
                            @endforeach
                        </x-tag-list>
                    </td>
                    <td>
                        {{ $matter_item->public_at->toDateString() }}
                    </td>
                    <td class="text-right">
                        <a href="{{ route('admin.matter.edit', $matter_item) }}"
                           class="text-sm inline-block ml-2">Edit</a>

                        <form action="{{ route('admin.matter.destroy', $matter_item) }}" method="POST"
                              class="inline-block ml-2">
                            @method('delete')
                            @csrf
                            <button type="submit" class="p-0 underline text-sm !text-black !bg-transparent">Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-admin.layout>
