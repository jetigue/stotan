<?php /** @noinspection ALL */

namespace App\Http\Livewire\Training\Runs;

use App\Models\Training\Intensity;
use App\Models\Training\Mesocycle;
use App\Models\Training\Runs\SteadyRun;
use App\Models\Training\RunTypes\Steady;
use Livewire\Component;

class SteadyRunForm extends Component
{

    public $duration;
    public $notes = null;
    public $steadyRun = null;
    public $steady_run_type_id = null;
    public $trainingDay;
    public $training_intensity_id = null;
    public $training_session = 'primary';
    public Mesocycle $mesocycle;
    public string $duration_unit = 'minutes';

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editSteadyRun' => 'edit',
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
            'notes' => 'nullable|string',
            'steady_run_type_id' => 'required|integer',
            'training_intensity_id' => 'required|integer',
            'training_session' => 'required|in:primary,secondary'
        ];
    }

    public function edit(SteadyRun $steadyRun)
        {
            $this->steadyRun = $steadyRun;

            $this->duration = $this->steadyRun->duration;
            $this->duration_unit = $this->steadyRun->duration_unit;
            $this->steady_run_type_id = $this->steadyRun->steady_run_type_id;
            $this->training_intensity_id = $this->steadyRun->training_intensity_id;
            $this->trainingDay = $this->steadyRun->training_date;
            $this->training_session = $this->steadyRun->training_sesison;
            $this->notes = $this->steadyRun->notes;
        }

    public function submitForm()
    {
        $this->validate();

        $steadyRun= [
            'duration' => $this->duration,
            'duration_unit' => $this->duration_unit,
            'mesocycle_id' => $this->mesocycle->id,
            'notes' => $this->notes,
            'steady_run_type_id' => $this->steady_run_type_id,
            'team_id' => session('team_id'),
            'training_date' =>  $this->trainingDay,
            'training_intensity_id' => $this->training_intensity_id,
            'training_session' => $this->training_session,
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
            'duration_unit',
            'notes',
            'steady_run_type_id',
            'training_intensity_id',
            'training_session'
        ]);
    }

    public function render()
    {
        return view('livewire.training.runs.steady-run-form', [
            'steadyRunTypes' => Steady::query()
            ->where('id', '!=', 1)
            ->where('id', '!=', 5)
            ->get(),

        'trainingIntensities' => Intensity::all()

        ]);


    }
}
