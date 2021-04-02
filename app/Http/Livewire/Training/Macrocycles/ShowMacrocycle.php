<?php

namespace App\Http\Livewire\Training\Macrocycles;

use App\Http\Livewire\Training\TrainingDays\TrainingDay;
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
        $this->mesocycle = $mesocycle;
        $this->mesocycle->delete();
        $this->showConfirmModal = false;
        $this->nullifyMicrocycles();
    }

    public function nullifyMicrocycles()
    {
        $macrocycleTrainingDays = \App\Models\Training\TrainingDay::where('macrocycle_id', $this->macrocycle->id)
            ->where('mesocycle_id', null)
            ->get();

        foreach ($macrocycleTrainingDays as $trainingDay)
        {
            $trainingDay->update(['microcycle' => null]);
        }
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
            'mesocycles' => Mesocycle::with('macrocycle', 'trainingDays')
                ->where('macrocycle_id', $this->macrocycle->id)
                ->orderBy('begin_date')
                ->get()
        ]);
    }
}
