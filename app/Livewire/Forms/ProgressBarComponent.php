<?php

namespace App\Livewire;

use Livewire\Component;

class ProgressBarComponent extends Component
{
    public $progress = 0;

    public function render()
    {
        return view('livewire.progress-bar-component');
    }
}
