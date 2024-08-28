<?php

namespace App\Livewire\Forms;

use Livewire\Component;

class NominationsForm extends Component
{

    public $step = 1;
    public $nomination_category = "";


    public function nextStep()
    {
        $this->step++;
    }

    public function previousStep()
    {
        $this->step--;
    }

    public function mount() {}

    public function render()
    {
        return view('livewire.forms.nominations-form');
    }
}
