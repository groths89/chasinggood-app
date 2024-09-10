<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Roles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end mb-4">
                        <a href="{{ url('roles') }}" class="px-4 py-2 font-bold text-gray-700 bg-gray-300 rounded-lg hover:bg-gray-400">Back</a>
                    </div>                    
                    <form class="max-w-md p-6 mx-auto bg-white rounded-lg shadow-md" action="{{ url('roles') }}" method="POST">
                        @csrf
                        <h2 class="mb-6 text-2xl font-bold text-center">Create New Role</h2>

                        <div class="mb-4">
                            <label for="name" class="block mb-2 font-bold text-gray-700">Role Name:</label>
                            <input type="text" id="name" name="name" class="w-full px-3 py-2 border rounded-lg" required>
                        </div>
                                        
{{--                         <div class="mb-4">
                            <label for="description" class="block mb-2 font-bold text-gray-700">Description:</label>
                            <textarea id="description" name="description" class="w-full px-3 py-2 border rounded-lg" rows="4"></textarea>
                        </div>
                                        
                        <div class="mb-4">
                            <label for="guard_name" class="block mb-2 font-bold text-gray-700">Guard Name:</label>
                            <select id="guard_name" name="guard_name" class="w-full px-3 py-2 border rounded-lg">
                                <option value="web">web</option>
                                <option value="api">api</option>
                            </select>
                        </div> --}}
                                        
                        <button type="submit" href="{{ url('roles') }}" class="w-full py-2 font-bold text-white bg-blue-500 rounded-lg hover:bg-blue-700">Create Role</button>
                    </form>                   
                </div>
            </div>
        </div>
    </div>
</x-app-layout>