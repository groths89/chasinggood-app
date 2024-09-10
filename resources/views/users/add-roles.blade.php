<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                @if (session('status'))
                <x-wui-alert title="{{ session('status') }}" positive flat />
                @endif  
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end mb-4">
                        <a href="{{ url('users') }}" class="px-4 py-2 font-bold text-gray-700 bg-gray-300 rounded-lg hover:bg-gray-400">Back</a>
                    </div>                    
                    <form class="flex flex-col justify-center p-6 mx-auto bg-white rounded-lg shadow-md" action="{{ url('users/'. $user->id . '/assign-roles') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <h2 class="mb-6 text-2xl font-bold text-center">User: {{ $user->email }}</h2>
                        <div class="mb-4">
                            @error('role')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <div class="flex flex-col sm:flex-row">
                                <div class="mb-4">
                                    <h3 class="text-2xl sm:w-1/3 sm:text-right sm:pr-4">Roles</h3>
                                        <div class="flex flex-col mx-4 my-4 align-left">
                                            @foreach ($roles as $role)
                                                <div class="px-4 py-4">
                                                    <label for="role" class="p-3">
                                                        <input type="checkbox" id="role" name="roles[]" value="{{ $role->name }}" {{ in_array($role->id, $userRoles) ? 'checked' : '' }} class="p-3 border rounded-md">   
                                                        {{ $role->name }}
                                                    </label> 
                                                </div>
                                            @endforeach
                                        </div>
                                </div>
                            </div>
                        </div>                 
                        <button type="submit" href="{{ url('users') }}" class="flex justify-center w-1/2 py-2 font-bold text-white bg-blue-500 rounded-lg hover:bg-blue-700">Add</button>
                    </form>                   
                </div>
            </div>
        </div>
    </div>
</x-app-layout>