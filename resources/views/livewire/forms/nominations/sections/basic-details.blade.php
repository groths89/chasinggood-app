<div class="p-4 border rounded">
    <h2 class="text-lg font-bold">Basic Details</h2>
    <div class="flex flex-row">
        <x-input label="First Name" type="text" id="firstName" wire:model="basicDetails.firstName" class="px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-500" />
        <x-input label="Last Name" type="text" id="lastName" wire:model="basicDetails.lastName" class="px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-500" />
    </div>
    <div>
        <x-input label="Email Address" type="email" id="emailAddress" wire:model="basicDetails.emailAddress" class="px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-500" />
    </div>
    <div>
        <x-input label="Phone Number" type="phone" id="phoneNumber" wire:model="basicDetails.phoneNumber" class="px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-500" />
    </div>
</div>
