<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Roles') }}
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
                        <a href="{{ url('roles') }}" class="px-4 py-2 font-bold text-gray-700 bg-gray-300 rounded-lg hover:bg-gray-400">Back</a>
                    </div>                    
                    <form class="flex flex-col justify-center p-6 mx-auto bg-white rounded-lg shadow-md" action="{{ url('roles/'. $role->id . '/give-permissions') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <h2 class="mb-6 text-2xl font-bold text-center">Role: {{ $role->name }}</h2>
                        <div class="mb-4">
                            @error('permission')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <label for="" class="sm:w-1/3 sm:text-right sm:pr-4">Permissions</label>
                            <div class="flex flex-col sm:flex-col">
                                @foreach ($permissions as $permission)
                                <label for="permission" class="p-3">
                                    <input type="checkbox" id="permission" name="permission[]" value="{{ $permission->name }}" {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }} class="p-3 border rounded-md">   
                                    {{ $permission->name }}
                                </label>  
                                @endforeach
                            </div>
                        <button type="submit" href="{{ url('roles') }}" class="flex justify-center w-1/2 py-2 font-bold text-white bg-blue-500 rounded-lg hover:bg-blue-700">Add</button>
                    </form>                   
                </div>
            </div>
        </div>
    </div>
</x-app-layout>