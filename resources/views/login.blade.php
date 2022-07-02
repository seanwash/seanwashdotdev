<x-layout>
    <form class="space-y-4" action="{{ route('login.store') }}" method="POST">
        @csrf

        @error('email')
        <div class="text-red-500">{{ $message }}</div>
        @enderror

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" value="{{ old('password') }}">
        </div>

        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</x-layout>
