<?php

namespace App\Livewire\Dialogs;

use Livewire\Component;

class LicenseAndConsentAgreement extends Component
{
    public $show = false;
    public $agreed = false;

    public function acceptDisclosure()
    {
        // Handle acceptance of terms, e.g., store user agreement in database
        // Close the dialog after acceptance
    }

    public function render()
    {
        return view('livewire.dialogs.license-and-consent-agreement');
    }
}
