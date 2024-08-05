<?php

namespace App\Livewire\Forms;

use Livewire\Component;

class NominationsForm extends Component
{
    public $basicDetails = [];
    public $nominationDetails = [];
    public $storyDetails = [];
    public $referencesDetails = [];
    public $agreeToTerms = false;
    public $shouldShowDisclosure = false;
    public $reviewData;

    public function showDisclosure()
    {
        $this->shouldShowDisclosure = true;
    }

    public function submit()
    {
        $this->validate([]);

        $this->reviewData = [
            'basicDetails' => $this->basicDetails,
        ];
    }

    public function render()
    {
        return view('livewire.forms.nominations-form');
    }
}
