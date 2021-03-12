<?php

namespace App\Http\Livewire\Training;

use App\Models\Training\RunTypes\Intermittent;
use Livewire\Component;

class RunTypes extends Component
{


    public function render()
    {
        return view('livewire.training.run-types');
    }
}
