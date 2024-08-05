<div class="p-4 border rounded">
    <h2 class="text-lg font-bold">Nominations Details</h2>
    <div>
        <p>Who are you nominating?</p>
        <div class="space-y-2">
            <div>
                <x-radio id="option1" label="Label in Right" value="option1" wire:model="selectedOption" />
            </div>
            <div>
                <x-radio id="option2" label="Label in Right" value="option2" wire:model="selectedOption" />
            </div>
            <div>
                <x-radio id="option3" label="Label in Right" value="option3" wire:model="selectedOption" />
            </div>
        </div>
        <x-input label="Nominee Name" type="text" id="nomineeName" wire:model="nominationDetails.name" class="px-4 py-2 border rounded-md focus:outline-none focus:ring focus:ring-blue-500" />
    </div>
</div>
