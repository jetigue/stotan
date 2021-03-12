<?php

namespace App\Http\Livewire\Training\Runs;

use App\Models\Training\Mesocycle;
use App\Models\Training\Runs\SteadyRun;
use Livewire\Component;

class WarmUpForm extends Component
{
    public $steadyRun = null;
    public Mesocycle $mesocycle;
    public $duration;
    public string $duration_unit = 'minutes';
    public $training_session = 'primary';
    public $trainingDay;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editWarmUp' => 'edit',
        'trainingDate' => 'trainingDateProvided'
    ];

    public function trainingDateProvided($trainingDate)
    {
        $this->trainingDay = $trainingDate;
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
            'training_session' => 'required|in:primary,secondary'
        ];
    }

    public function edit(SteadyRun $steadyRun)
        {
            $this->steadyRun = $steadyRun;

            $this->duration = $this->steadyRun->duration;
            $this->duration_unit = $this->steadyRun->duration_unit;
            $this->trainingDay = $this->steadyRun->training_date;
            $this->training_session = $this->steadyRun->training_session;
        }

    public function submitForm()
    {
        $this->validate();

        $steadyRun= [
            'steady_run_type_id' => 1,
            'training_intensity_id' => 3,
            'duration' => $this->duration,
            'duration_unit' => $this->duration_unit,
            'team_id' => session('team_id'),
            'mesocycle_id' => $this->mesocycle->id,
            'training_date' =>  $this->trainingDay,
            'training_session' => $this->training_session
        ];

        if ($this->steadyRun) {
            SteadyRun::find($this->steadyRun->id)->update($steadyRun);

            $this->emit('hideModal');
            $this->resetForm();
        } else {
            $this->steadyRun = SteadyRun::create($steadyRun);
            $this->emit('hideModal');
            $this->resetForm();
        }
    }

    public function resetForm()
    {
        $this->steadyRun = null;

        $this->reset([
            'duration',
            'duration_unit',
            'training_session'
        ]);
    }

    public function render()
    {
        return view('livewire.training.runs.warm-up-form');
    }
}
