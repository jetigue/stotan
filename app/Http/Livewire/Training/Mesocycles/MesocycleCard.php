<?php

namespace App\Http\Livewire\Training\Mesocycles;

use App\Models\Training\Macrocycle;
use App\Models\Training\Mesocycle;
use Livewire\Component;

class MesocycleCard extends Component
{
    public $mesocycle;
    public $macrocycle;

    protected $listeners = [
        'updateCard' => 'render'
    ];

    public function mount()
    {
        $this->macrocycle = Macrocycle::firstWhere('id', $this->mesocycle->macrocycle_id);
    }

    public function editMesocycle (Mesocycle $mesocycle)
    {
        $this->emit('editMesocycle', $mesocycle->id);
    }

    public function confirmDelete(Mesocycle $mesocycle)
    {
        $this->emit('confirmDelete', $mesocycle->id);
    }

    public function render()
    {
        return view('livewire.training.mesocycles.mesocycle-card');
    }
}
