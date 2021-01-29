<?php

namespace App\Http\Livewire\Training;

use App\Models\Training\Macrocycle;
use App\Models\Training\Mesocycle;
use App\Models\Training\TrainingDay;
use Livewire\Component;
use Illuminate\Validation\Rule;

class MesocycleForm extends Component
{
    public $mesocycle = null;
    public Macrocycle $macrocycle;
    public $name;
    public $begin_date_for_editing;
    public $end_date_for_editing;
    public $color;
    public $team_id;
    public $macrocycle_id;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editMesocycle' => 'edit'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'begin_date_for_editing' => 'required|date|after__or_equal:macrocycle.begin_date',
            'end_date_for_editing' => 'required|date|after:begin_date|before__or_equal:macrocycle.end_date',
            'color' => 'required'
        ];
    }

    public function edit(Mesocycle $mesocycle)
    {
        $this->mesocycle = $mesocycle;

        $this->name = $this->mesocycle->name;
        $this->begin_date_for_editing = $this->mesocycle->begin_date_for_editing;
        $this->end_date_for_editing = $this->mesocycle->end_date_for_editing;
        $this->color = $this->mesocycle->color;
    }

    public function submitForm()
    {
        $this->validate();

        $mesocycle = [
            'name' => $this->name,
            'begin_date' => $this->begin_date_for_editing,
            'end_date' => $this->end_date_for_editing,
            'color' => $this->color,
            'team_id' => session('team_id'),
            'macrocycle_id' => $this->macrocycle->id
        ];

        if ($this->mesocycle) {
            Mesocycle::find($this->mesocycle->id)->update($mesocycle);

            $this->emit('hideModal');
        } else {
            $mesocycle = Mesocycle::create($mesocycle);

            $this->createTrainingDays($mesocycle);
            $this->resetForm();
            $this->emit('hideModal');
        }
    }

    public function createTrainingDays($mesocycle): void
    {
        foreach($mesocycle->period_of_days as $day) {
            $trainingDay = [
                'team_id' => session('team_id'),
                'mesocycle_id' => $mesocycle->id,
                'training_day' => $day
            ];

            TrainingDay::create($trainingDay);
        }
    }

    public function resetForm()
    {
        $this->reset([
            'mesocycle', 'name', 'begin_date_for_editing', 'end_date_for_editing', 'color'
        ]);
    }

    public function render()
    {
        return view('livewire.training.mesocycle-form');
    }
}
