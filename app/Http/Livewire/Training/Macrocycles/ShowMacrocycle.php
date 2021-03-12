<?php

namespace App\Http\Livewire\Training\Macrocycles;

use App\Models\Training\Macrocycle;
use App\Models\Training\Mesocycle;
use Livewire\Component;

class ShowMacrocycle extends Component
{
    public Macrocycle $macrocycle;
    public $mesocycle;
    public $showFormModal = false;
    public $showConfirmModal = false;
    public $editing = false;
    public $orderBy = 'begin_date';

    protected $listeners = [
        'hideModal' => 'hideModal',
        'editMesocycle' => 'editMesocycle',
        'confirmDelete' => 'confirmDelete'
    ];

    public function showCreateModal() { $this->showFormModal = true; }

    public function hideModal() { $this->showFormModal = false; }

//    public function edit(Mesocycle $mesocycle)
//    {
//        $this->showFormModal = true;
//        $this->editing = true;
//        $this->emit('editMesocycle', $mesocycle->id);
//    }

    public function editMesocycle(Mesocycle $mesocycle)
    {
        $this->showFormModal =true;
        $this->editing = true;
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
        $this->showFormModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }


    public function render()
    {
        return view('livewire.training.macrocycles.show-macrocycle', [
            'mesocycles' => Mesocycle::where('macrocycle_id', $this->macrocycle->id)
                ->orderBy('begin_date')
                ->get()
        ]);
    }
}
