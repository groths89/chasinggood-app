<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Permissions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    @if (session('status'))
                        <x-wui-alert title="{{ session('status') }}" positive flat />
                    @endif                
                <div class="p-6 text-gray-900">
                    <div class="p-6 mx-auto bg-white rounded-lg shadow-md max-w">
                        <h2 class="mb-6 text-2xl font-bold text-center">All Permissions</h2>
                        
                        <div class="flex justify-end mb-4">
                            <a href="{{ url('permissions/create') }}" class="px-4 py-2 font-bold text-white bg-blue-500 rounded-lg hover:bg-blue-700">Create New Permission</a>
                        </div>

                        <table class="w-full border-collapse">
                            <thead>
                                <tr>
                                    <th class="p-2 font-bold text-left text-gray-700 border">ID</th>
                                    <th class="p-2 font-bold text-left text-gray-700 border">Name</th>
                                    <th class="p-2 font-bold text-left text-gray-700 border">Guard Name</th>
                                    <th class="w-1/3 p-2 font-bold text-left text-gray-700 border">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                <tr>
                                    <td class="p-2 text-gray-800 border">{{ $permission->id}}</td>
                                    <td class="p-2 text-gray-800 border">{{ $permission->name }}</td>
                                    <td class="p-2 text-gray-800 border">{{ $permission->guard_name }}</td>
                                    <td class="flex p-2 space-x-2 text-gray-800 border">
                                        @can('update permission')
                                            <form action="{{ url('permissions/'.$permission->id.'/edit') }}" class="inline-block" method="GET">
                                                <button class="px-4 py-2 text-white bg-yellow-500 rounded-md hover:bg-yellow-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                    </svg>
                                                </button>
                                            </form>                                                
                                        @endcan
                                        @can('delete permission')
                                            <form action="{{ url('/permissions/' . $permission->id . '/delete')}}" method="GET" class="inline-block">
                                                <button type="submit" onclick="return confirm('Are you sure you want to delete this permission?')" class="px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>
                                                </button>
                                            </form>                                            
                                        @endcan
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
