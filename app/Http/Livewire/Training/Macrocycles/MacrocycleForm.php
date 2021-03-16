<?php

namespace App\Http\Livewire\Training\Macrocycles;

use App\Models\Training\Macrocycle;
use App\Models\Training\TrainingDay;
use Livewire\Component;

class MacrocycleForm extends Component
{
    public $macrocycle = null;
    public $name;
    public $begin_date_for_editing;
    public $end_date_for_editing;
    public $team_id;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editMacrocycle' => 'edit'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    protected $rules = [
        'name' => 'required',
        'begin_date_for_editing' => 'required|date',
        'end_date_for_editing' => 'required|date'
    ];

    public function mount()
    {
        $this->team_id = session('team_id');
    }

    public function edit(Macrocycle $macrocycle)
    {
        $this->macrocycle = $macrocycle;

        $this->name = $this->macrocycle->name;
        $this->begin_date_for_editing = $this->macrocycle->begin_date_for_editing;
        $this->end_date_for_editing = $this->macrocycle->end_date_for_editing;
    }

    public function submitForm()
    {
        $this->validate();

        $macrocycle = [
            'name' => $this->name,
            'begin_date' => $this->begin_date_for_editing,
            'end_date' => $this->end_date_for_editing,
            'team_id' => $this->team_id
        ];

        if ($this->macrocycle) {
            Macrocycle::find($this->macrocycle->id)->update($macrocycle);

            $this->resetForm();
            $this->emit('hideModal');
            $this->emit('refreshCards');

        } else {
            $macrocycle = Macrocycle::create($macrocycle);

            $this->createTrainingDays($macrocycle);
            $this->resetForm();
            $this->emit('hideModal');
            $this->emit('refresh');
        }
    }

    public function createTrainingDays($macrocycle)
    {
        foreach($macrocycle->period_of_days as $day) {
            $trainingDay = [
                'team_id' => session('team_id'),
                'macrocycle_id' => $macrocycle->id,
                'training_day' => $day
            ];

            TrainingDay::create($trainingDay);
        }
    }

    public function resetForm()
    {
        $this->macrocycle = null;

        $this->reset([
            'name',
            'begin_date_for_editing',
            'end_date_for_editing',
        ]);
    }

    public function render()
    {
        return view('livewire.training.macrocycles.macrocycle-form');
    }
}
