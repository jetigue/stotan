<?php

namespace App\Http\Livewire\Training;

use App\Models\Training\Macrocycle;
use Livewire\Component;

class Planner extends Component
{
    public $showCreateModal = false;
    public $showConfirmModal = false;
    public $macrocycle;

    protected $listeners = [
        'hideModal' => 'hideCreateModal'
    ];

    public function showCreateModal() { $this->showCreateModal = true; }
    public function hideCreateModal() { $this->showCreateModal = false; }

    public function edit(Macrocycle $macrocycle)
    {
        $this->showCreateModal = true;
        $this->emit('editMacrocycle', $macrocycle->id);
    }

    public function confirmDelete(Macrocycle $macrocycle)
    {
        $this->showConfirmModal = true;
        $this->macrocycle = $macrocycle;
    }

    public function destroy()
    {
        $this->macrocycle->delete();
        $this->showConfirmModal = false;
    }

    public function cancel()
    {
        $this->showCreateModal = false;

        $this->emit('cancelCreate');
    }

    public function render()
    {
        return view('livewire.training.planner', [
            'macrocycles' => Macrocycle::all()
        ]);
    }
}
