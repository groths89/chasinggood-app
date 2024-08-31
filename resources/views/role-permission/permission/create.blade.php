<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permissions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end mb-4">
                        <a href="{{ url('permissions') }}" class="bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-lg hover:bg-gray-400">Back</a>
                    </div>                    
                    <form class="max-w-md mx-auto p-6 bg-white rounded-lg shadow-md" action="{{ url('permissions') }}" method="POST">
                        @csrf
                        <h2 class="text-2xl font-bold text-center mb-6">Create New Permission</h2>

                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-bold mb-2">Permission Name:</label>
                            <input type="text" id="name" name="name" class="w-full px-3 py-2 border rounded-lg" required>
                        </div>
                                        
{{--                         <div class="mb-4">
                            <label for="description" class="block text-gray-700 font-bold mb-2">Description:</label>
                            <textarea id="description" name="description" class="w-full   
                                         px-3 py-2 border rounded-lg" rows="4"></textarea>
                        </div>
                                        
                        <div class="mb-4">
                            <label for="guard_name" class="block text-gray-700 font-bold mb-2">Guard Name:</label>
                            <select id="guard_name" name="guard_name" class="w-full px-3 py-2 border rounded-lg">
                                <option value="web">web</option>
                                <option value="api">api</option>
                            </select>
                        </div> --}}
                                        
                        <button type="submit" href="{{ url('permissions') }}" class="w-full bg-blue-500 text-white font-bold py-2 rounded-lg hover:bg-blue-700">Create Permission</button>
                    </form>                   
                </div>
            </div>
        </div>
    </div>
</x-app-layout>