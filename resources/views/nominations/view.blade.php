<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Nominations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end mb-4">
                        <a href="{{ url('nominations') }}" class="px-4 py-2 font-bold text-gray-700 bg-gray-300 rounded-lg hover:bg-gray-400">Back</a>
                    </div>                    
                    <h1 class="mb-6 text-3xl font-bold text-center border-b border-gray-300 rounded-b-xl">{{$nominationEntry->nominating_category}} Nomination</h1>
                                        
                    <div class="container px-4 py-8 mx-auto">      
                        <div class="flex flex-col gap-4 md:flex-row">
                            <div class="md:w-full">
                                <h2 class="text-2xl font-bold">Story</h2>
                                <p class="mt-4 text-lg text-gray-700">{{$nominationEntry->story_essay}}</p>
                            </div>
                              <div class="md:w-1/3">
                                <div class="mb-8">
                                    <h3 class="text-xl font-semibold">Nominator Information</h3>
                                    <div class="flex flex-col mt-4 space-y-2">
                                      <div class="flex justify">
                                        <p class="font-bold">Name:</p>
                                        <p class="px-4 font-bold">{{$nominationEntry->first_name . " " . $nominationEntry->last_name}}</p>
                                      </div>
                                      <div class="flex justify">
                                        <p class="font-bold">Phone:</p>
                                        <p class="px-4 font-bold">{{$nominationEntry->phone_number}}</p>
                                      </div>
                                      <div class="flex justify">
                                        <p class="font-bold">Email:</p>
                                        <p class="px-4 font-bold">{{$nominationEntry->email_address}}</p>
                                      </div>
                                    </div>
                                  </div>
                              
                                <div class="mb-8">
                                    <h3 class="text-xl font-semibold">Nominee Information</h3>
                                    <div class="flex flex-col mt-4 space-y-2">
                                      <div class="flex justify">
                                        <p class="font-bold">Name:</p>
                                        <p class="px-4 font-bold">{{$nominationEntry->nominee_name}}</p>
                                      </div>
                                      <div class="flex justify">
                                        <p class="font-bold">Email:</p>
                                        <p class="px-4 font-bold">{{$nominationEntry->nominee_email}}</p>
                                      </div>
                                    </div>
                                </div>
                              </div>
                            </div>            
                </div>
            </div>
        </div>
    </div>
</x-app-layout>