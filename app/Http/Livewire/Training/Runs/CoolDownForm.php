<?php

namespace App\Http\Livewire\Training\Runs;

use App\Models\Training\Mesocycle;
use App\Models\Training\Runs\SteadyRun;
use App\Models\Training\TrainingDay;
use Livewire\Component;

class CoolDownForm extends Component
{
    public $steadyRun = null;
    public Mesocycle $mesocycle;
    public $duration;
    public string $duration_unit = 'minutes';
    public $training_day_id;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editCoolDown' => 'edit',
        'trainingDay' => 'trainingDayIDProvided'
    ];

    public function mount()
    {
        $this->resetErrorBag();
    }

    public function trainingDayIDProvided(TrainingDay $trainingDay)
    {
        $this->training_day_id = $trainingDay->id;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function rules()
    {
        return [
            'duration' => 'required|integer',
            'duration_unit' => 'required|in:minutes,seconds,miles,meters',
        ];
    }

    public function edit(SteadyRun $steadyRun)
        {
            $this->steadyRun = $steadyRun;

            $this->duration = $this->steadyRun->duration;
            $this->duration_unit = $this->steadyRun->duration_unit;
            $this->training_day_id = $this->steadyRun->training_day_id;
        }

    public function submitForm()
    {
        $this->validate();

        $steadyRun= [
            'steady_run_type_id' => 2,
            'training_intensity_id' => 1,
            'duration' => $this->duration,
            'duration_unit' => $this->duration_unit,
            'team_id' => session('team_id'),
            'mesocycle_id' => $this->mesocycle->id,
            'training_day_id' =>  $this->training_day_id
        ];

        if ($this->steadyRun) {
            SteadyRun::find($this->steadyRun->id)->update($steadyRun);

            $this->resetForm();
            $this->emit('hideModal');
        } else {
            $this->steadyRun = SteadyRun::create($steadyRun);

            $this->resetForm();
            $this->emit('hideModal');
        }
    }

    public function resetForm()
    {
        $this->steadyRun = null;

        $this->reset([
            'duration',
            'duration_unit'
        ]);
    }

    public function render()
    {
        return view('livewire.training.runs.cool-down-form');
    }
}
