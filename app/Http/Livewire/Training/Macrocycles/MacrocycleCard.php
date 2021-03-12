<?php

namespace App\Http\Livewire\Training\Macrocycles;

use App\Models\Training\Macrocycle;
use Livewire\Component;

class MacrocycleCard extends Component
{
    public $macrocycle;

    protected $listeners = [
        'refreshCards' => 'render'
    ];

    public function getWeeksLabelProperty()
    {
        $weeks = $this->macrocycle->number_of_weeks;

        return $weeks != 1 ? 'Weeks' : 'Week';
    }

    public function getDaysProperty()
    {
        $days = $this->macrocycle->number_of_remainder_days;

        if ($days > 0)
        {
            return $days > 1 ? $days . ' ' . 'Days' : $days . ' ' . 'Day';
        }
        return 0;
    }

    public function editMacrocycle(Macrocycle $macrocycle)
    {
        $this->emit('editMacrocycle', $macrocycle->id);
    }

    public function confirmDelete(Macrocycle $macrocycle)
    {
        $this->emit('confirmDelete', $macrocycle->id);
    }

    public function render()
    {
        return view('livewire.training.macrocycles.macrocycle-card');
    }
}
