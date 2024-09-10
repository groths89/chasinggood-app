<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Nominations') }}
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
                        <h2 class="mb-6 text-2xl font-bold text-center">Nominations</h2>

                        <table class="w-full border-collapse">
                            <thead>
                                <tr>
                                    <th class="p-2 font-bold text-left text-gray-700 border">ID</th>
                                    <th class="p-2 font-bold text-left text-gray-700 border">Name</th>
                                    <th class="p-2 font-bold text-left text-gray-700 border">Nominator Email</th>
                                    <th class="p-2 font-bold text-left text-gray-700 border">Nominator Phone</th>
                                    <th class="p-2 font-bold text-left text-gray-700 border">Category</th>
                                    <th class="p-2 font-bold text-left text-gray-700 border">Nominee</th>
                                    <th class="p-2 font-bold text-left text-gray-700 border">Disclaimer</th>
                                    <th class="w-1/3 p-2 font-bold text-left text-gray-700 border">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nominations as $nomination)
                                <tr>
                                    <td class="p-2 text-gray-800 border">{{ $nomination->id}}</td>
                                    <td class="p-2 text-gray-800 border">{{ $nomination->first_name . " " . $nomination->last_name  }}</td>
                                    <td class="p-2 text-gray-800 border">{{ $nomination->email_address }}</td>
                                    <td class="p-2 text-gray-800 border">{{ $nomination->phone_number }}</td>
                                    <td class="p-2 text-gray-800 border">{{ $nomination->nominating_category }}</td>
                                    <td class="p-2 text-gray-800 border">{{ $nomination->nominee_name }}</td>
                                    <td class="p-2 text-gray-800 border">
                                        @if ($nomination->disclaimer_agreed)
                                            <svg class="w-5 h-5 m-auto text-center text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        @else
                                            <svg class="w-5 h-5 m-auto text-center text-red-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        @endif
                                    </td>
                                    <td class="w-1/3 p-2 space-x-2 text-gray-800 border">
                                        @can('view nomination')
                                            <form action="{{ url('nominations/'.$nomination->id.'/view') }}" class="inline-block" method="GET">
                                                <button class="px-4 py-2 text-white bg-blue-500 rounded-md hover:bg-blue-600">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                    </svg>                                                  
                                                </button>
                                            </form>                                             
                                        @endcan
                                        @can('delete nomination')
                                            <form action="{{ url('/nominations/' . $nomination->id . '/delete')}}" method="GET" class="inline-block">
                                                <button type="submit" onclick="return confirm('Are you sure you want to delete this nomination entry?')" class="px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-600"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
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