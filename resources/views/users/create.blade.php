<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end mb-4">
                        <a href="{{ url('users') }}" class="px-4 py-2 font-bold text-gray-700 bg-gray-300 rounded-lg hover:bg-gray-400">Back</a>
                    </div>                    
                    HTML
<div class="container px-4 py-8 mx-auto">
    <h1 class="mb-8 text-3xl font-bold text-center">Create User</h1>

    <form action="{{ route('users') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name" class="block mb-2 font-bold text-gray-700">Name</label>
            <input type="text" id="name" name="name"   
 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"   
 required>
            @error('name')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block mb-2 font-bold text-gray-700">Email</label>
            <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"   
 required>
            @error('email')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="block mb-2 font-bold text-gray-700">Password</label>
            <input type="password" id="password" name="password"   
 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" required>
            @error('password')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="role" class="block mb-2 font-bold text-gray-700">Role</label>
            <select name="roles[]" id="role"   
 class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" multiple>
                <option value="">Select Role</option>
                @foreach ($roles as $role)
                    <option value="">{{ $role }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded-lg hover:bg-blue-700">Create User</button>
    </form>
</div>                  
                </div>
            </div>
        </div>
    </div>
</x-app-layout>