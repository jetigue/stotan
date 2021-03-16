<?php

namespace App\Http\Livewire\Training\Runs;

use App\Models\Training\Intensity;
use App\Models\Training\Mesocycle;
use App\Models\Training\Runs\ProgressiveRun;
use App\Models\Training\RunTypes\Progressive;
use App\Models\Training\TrainingDay;
use Livewire\Component;

class ProgressiveRunForm extends Component
{

    public $duration;
    public $duration_unit = 'minutes';
    public $progressiveRun = null;
    public $progressive_run_type_id = null;
    public $notes = null;
    public $progression_interval;
    public $progression_interval_unit = 'minutes';
    public $training_day_id;
    public $starting_training_intensity_id = null;
    public $final_training_intensity_id = null;
    public $training_session = 'primary';
    public Mesocycle $mesocycle;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'editProgressiveRun' => 'edit',
        'submitCreate' => 'submitForm',
        'trainingDay' => 'trainingDayIDProvided'
    ];

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
            'duration' => 'required|integer|min:1',
            'duration_unit' => 'required|in:minutes,seconds,miles,meters',
            'final_training_intensity_id' => 'required|integer',
            'notes' => 'nullable|string',
            'progression_interval' => 'required|integer|min:1',
            'progression_interval_unit' => 'required|in:minutes,seconds,miles,meters',
            'progressive_run_type_id' => 'required|integer',
            'starting_training_intensity_id' => 'required|integer',
            'training_session' => 'required|in:primary,secondary',
        ];
    }

    public function edit(ProgressiveRun $progressiveRun)
    {
        $this->progressiveRun = $progressiveRun;

        $this->duration = $this->progressiveRun->duration;
        $this->duration_unit = $this->progressiveRun->duration_unit;
        $this->final_training_intensity_id = $this->progressiveRun->final_training_intensity_id;
        $this->notes = $this->progressiveRun->notes;
        $this->progression_interval = $this->progressiveRun->progression_interval;
        $this->progression_interval_unit = $this->progressiveRun->progression_interval_unit;
        $this->progressive_run_type_id = $this->progressiveRun->progressive_run_type_id;
        $this->starting_training_intensity_id = $this->progressiveRun->starting_training_intensity_id;
        $this->training_day_id =  $this->progressiveRun->training_day_id;
        $this->training_session = $this->progressiveRun->training_session;
    }

    public function submitForm()
    {
        $this->validate();

        $progressiveRun = [
            'duration' => $this->duration,
            'duration_unit' => $this->duration_unit,
            'progressive_run_type_id' => $this->progressive_run_type_id,
            'mesocycle_id' => $this->mesocycle->id,
            'notes' => $this->notes,
            'progression_interval' => $this->progression_interval,
            'progression_interval_unit' => $this->progression_interval_unit,
            'team_id' => session('team_id'),
            'training_day_id' => $this->training_day_id,
            'starting_training_intensity_id' => $this->starting_training_intensity_id,
            'final_training_intensity_id' => $this->final_training_intensity_id,
            'training_session' => $this->training_session,
        ];

        if ($this->progressiveRun) {
            ProgressiveRun::find($this->progressiveRun->id)->update($progressiveRun);

            $this->resetForm();
            $this->emit('hideModal');
        } else {
            $this->progressiveRun = ProgressiveRun::create($progressiveRun);

            $this->resetForm();
            $this->emit('hideModal');
        }
    }

    public function resetForm()
    {
        $this->progressiveRun = null;

        $this->reset([
            'duration',
            'duration_unit',
            'progressive_run_type_id',
            'notes',
            'progression_interval',
            'progression_interval_unit',
            'starting_training_intensity_id',
            'final_training_intensity_id',
            'training_session',
        ]);
    }

    public function render()
    {
        return view('livewire.training.runs.progressive-run-form', [
            'progressiveRunTypes' => Progressive::all(),
            'trainingIntensities' => Intensity::all(),
        ]);
    }
}
