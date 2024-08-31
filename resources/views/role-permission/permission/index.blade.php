<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permissions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    @if (session('status'))
                        <x-wui-alert title="{{ session('status') }}" positive flat />
                    @endif                
                <div class="p-6 text-gray-900">
                    <div class="max-w mx-auto p-6 bg-white rounded-lg shadow-md">
                        <h2 class="text-2xl font-bold text-center mb-6">All Permissions</h2>
                        
                        <div class="flex justify-end mb-4">
                            <a href="{{ url('permissions/create') }}" class="bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700">Create New Permission</a>
                        </div>

                        <table class="w-full border-collapse">
                            <thead>
                                <tr>
                                    <th class="border p-2 text-left text-gray-700 font-bold">ID</th>
                                    <th class="border p-2 text-left text-gray-700 font-bold">Name</th>
                                    <th class="border p-2 text-left text-gray-700 font-bold">Guard Name</th>
                                    <th class="border p-2 text-left text-gray-700 font-bold">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                <tr>
                                    <td class="border p-2 text-gray-800">{{ $permission->id}}</td>
                                    <td class="border p-2 text-gray-800">{{ $permission->name }}</td>
                                    <td class="border p-2 text-gray-800">{{ $permission->guard_name }}</td>
                                    <td class="border p-2 text-gray-800">
                                        <a href="{{url('permissions/'.$permission->id.'/edit')}}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                        <form action="/permissions/delete/1" method="POST" class="inline-block">
                                            <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                        </form>
                                    </td>
                                </tr>                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>                
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
