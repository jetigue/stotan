<?php /** @noinspection ALL */

namespace App\Http\Livewire\Training\Runs;

use App\Models\Training\Intensity;
use App\Models\Training\Mesocycle;
use App\Models\Training\Runs\IntermittentRun;
use App\Models\Training\RunTypes\Intermittent;
use App\Models\Training\TrainingDay;
use Livewire\Component;

class IntermittentRunForm extends Component
{
    public $duration;
    public $duration_unit = 'minutes';
    public $intermittentRun = null;
    public $intermittent_run_type_id = null;
    public $notes = null;
    public $number_repetitions;
    public $number_sets = 1;
    public $recovery;
    public $recovery_type;
    public $recovery_unit = 'minutes';
    public $set_recovery;
    public $set_recovery_type;
    public $set_recovery_unit = 'minutes';
    public $training_day_id;
    public $training_intensity_id = null;
    public $training_session = 'primary';
    public Mesocycle $mesocycle;
    public $showSetRecoveryInputs = false;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'editIntermittentRun' => 'edit',
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

    public function updatedNumberSets($value)
    {
       return $value > 1 ? $this->showSetRecoveryInputs = true : $this->showSetRecoveryInputs = false;
    }

    public function rules()
    {
        return [
            'duration' => 'required|integer|min:1',
            'duration_unit' => 'required|in:minutes,seconds,miles,meters',
            'intermittent_run_type_id' => 'required|integer',
            'notes' => 'nullable|string',
            'number_repetitions' => 'required|integer|min:1',
            'number_sets' => 'required|integer|min:1',
            'recovery' => 'required|integer|min:1',
            'recovery_unit' => 'required|in:minutes,seconds,miles,meters',
            'set_recovery' => 'nullable|integer|min:1',
            'set_recovery' => 'nullable|integer|min:1',
            'set_recovery_unit' => 'nullable|in:minutes,seconds,miles,meters',
            'training_intensity_id' => 'required|integer',
            'training_session' => 'required|in:primary,secondary',
        ];
    }

    public function edit(IntermittentRun $intermittentRun)
    {
        $this->intermittentRun = $intermittentRun;

        $this->intermittentRun->number_sets > 1 ? $this->showSetRecoveryInputs = true : $this->showSetRecoveryInputs = false;

        $this->duration = $this->intermittentRun->duration;
        $this->duration_unit = $this->intermittentRun->duration_unit;
        $this->intermittent_run_type_id = $this->intermittentRun->intermittent_run_type_id;
        $this->notes = $this->intermittentRun->notes;
        $this->number_repetitions = $this->intermittentRun->number_repetitions;
        $this->number_sets = $this->intermittentRun->number_sets;
        $this->recovery = $this->intermittentRun->recovery;
        $this->recovery_type = $this->intermittentRun->recovery_type;
        $this->recovery_unit = $this->intermittentRun->recovery_unit;
        $this->training_day_id =  $this->intermittentRun->training_day_id;
        $this->training_intensity_id = $this->intermittentRun->training_intensity_id;
        $this->training_session = $this->intermittentRun->training_session;
        $this->set_recovery = $this->intermittentRun->set_recovery;
        $this->set_recovery_type = $this->intermittentRun->set_recovery_type;
        $this->set_recovery_unit = $this->intermittentRun->set_recovery_unit;
    }

    public function submitForm()
    {
        $this->validate();

        $intermittentRun= [
            'duration' => $this->duration,
            'duration_unit' => $this->duration_unit,
            'intermittent_run_type_id' => $this->intermittent_run_type_id,
            'mesocycle_id' => $this->mesocycle->id,
            'notes' => $this->notes,
            'number_repetitions' => $this->number_repetitions,
            'number_sets' => $this->number_sets,
            'recovery' => $this->recovery,
            'recovery_type' => $this->recovery_type,
            'recovery_unit' => $this->recovery_unit,
            'set_recovery' => $this->set_recovery,
            'set_recovery_type' => $this->set_recovery_type,
            'set_recovery_unit' => $this->set_recovery_unit,
            'team_id' => session('team_id'),
            'training_day_id' =>  $this->training_day_id,
            'training_intensity_id' => $this->training_intensity_id,
            'training_session' => $this->training_session,
        ];

        if ($this->intermittentRun) {
            IntermittentRun::find($this->intermittentRun->id)->update($intermittentRun);

            $this->resetForm();
            $this->emit('hideModal');
        } else {
            $this->intermittentRun = IntermittentRun::create($intermittentRun);

            $this->resetForm();
            $this->emit('hideModal');
        }
    }

    public function resetForm()
    {
        $this->intermittentRun = null;

        $this->reset([
            'duration',
            'duration_unit',
            'intermittent_run_type_id',
            'notes',
            'number_repetitions',
            'number_sets',
            'recovery',
            'recovery_type',
            'recovery_unit',
            'set_recovery',
            'set_recovery_type',
            'set_recovery_unit',
            'training_intensity_id',
            'training_session',
        ]);
    }

    public function render()
    {
        return view('livewire.training.runs.intermittent-run-form', [
            'intermittentRunTypes' => Intermittent::all(),
            'trainingIntensities' => Intensity::all()
        ]);
    }
}
