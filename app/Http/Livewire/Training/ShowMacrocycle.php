<?php

namespace App\Http\Livewire\Training;

use App\Models\Training\Macrocycle;
use App\Models\Training\Mesocycle;
use Livewire\Component;

class ShowMacrocycle extends Component
{
    public Macrocycle $macrocycle;
    public $mesocycle;
    public $showCreateModal = false;
    public $showConfirmModal = false;
    public $editing = false;
    public $orderBy = 'begin_date';

    protected $listeners = [
        'hideModal' => 'hideCreateModal',
    ];

    public function showCreateModal() { $this->showCreateModal = true; }
    public function hideCreateModal() { $this->showCreateModal = false; }

    public function edit(Mesocycle $mesocycle)
    {
        $this->showCreateModal = true;
        $this->editing = true;
        $this->emit('editMesocycle', $mesocycle->id);
    }

    public function confirmDelete(Mesocycle $mesocycle)
    {
        $this->showConfirmModal = true;
        $this->mesocycle = $mesocycle;
    }

    public function destroy(Mesocycle $mesocycle)
    {
        $this->$mesocycle = $mesocycle;
        $this->mesocycle->delete();
        $this->showConfirmModal = false;
    }

    public function cancel()
    {
        $this->showCreateModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }


    public function render()
    {
        return view('livewire.training.show-macrocycle', [
            'mesocycles' => Mesocycle::where('macrocycle_id', $this->macrocycle->id)->orderBy($this->orderBy)->get()
        ]);
    }
}
