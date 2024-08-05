<div>
        <x-modal>
            <x-slot name="title">Terms and Conditions</x-slot>
            <x-slot name="content">
                <div class="space-y-4">
                    <p>Terms and conditions text here.</p>
                    <p>More terms and conditions.</p>
                    <div class="flex items-center">
                        <x-checkbox wire:model="agreed" class="mr-2">
                        <label for="agreed">I agree to the terms and conditions</label>
                    </div>
                </div>
            </x-slot>
            <x-slot name="footer">
                <x-button>Close</button>
                <x-button primary wire:click="acceptTerms" disabled="{{ !$agreed }}">Accept</x-button>
            </x-slot>
        </x-modal>
</div>
