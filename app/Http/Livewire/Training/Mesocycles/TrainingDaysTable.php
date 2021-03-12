<?php

namespace App\Http\Livewire\Training\Mesocycles;

use App\Models\Calendar;
use App\Models\Training\Mesocycle;
use App\Models\Training\Runs\IntermittentRun;
use App\Models\Training\Runs\ProgressiveRun;
use App\Models\Training\Runs\SteadyRun;
use App\Repositories\TrainingRuns;
use Livewire\Component;
use Livewire\WithPagination;

class TrainingDaysTable extends Component
{
    public Mesocycle $mesocycle;
    public bool $showWarmUpFormModal = false;
    public bool $showSteadyRunFormModal = false;
    public bool $showIntermittentRunFormModal = false;
    public bool $showProgressiveRunFormModal = false;
    public bool $showCoolDownFormModal = false;
    public bool $showEditAndDelete = false;
    public bool $editing = false;
    public $training_date;

    use WithPagination;

    protected $paginationTheme = 'microcycle-pagination';

    protected $listeners = [
        'hideModal' => 'hideFormModal'
    ];

    public function hideFormModal()
    {
        $this->showWarmUpFormModal = false;
        $this->showSteadyRunFormModal = false;
        $this->showIntermittentRunFormModal = false;
        $this->showCoolDownFormModal = false;
        $this->showProgressiveRunFormModal = false;
    }

    public function cancel()
    {
        $this->hideFormModal();
        $this->editing = false;

        $this->emit('cancelCreate');
    }


    public function destroySteadyRun(SteadyRun $steadyRun)
    {
        $this->showEditAndDelete = false;

        try {
            $steadyRun->delete();
        } catch (\Exception $e) {
        }
    }

    public function destroyIntermittentRun(IntermittentRun $intermittentRun)
    {
        $this->showEditAndDelete = false;

        try {
            $intermittentRun->delete();
        } catch (\Exception $e) {
        }
    }

    public function destroyProgressiveRun(ProgressiveRun $progressiveRun)
    {
        $this->showEditAndDelete = false;

        try {
            $progressiveRun->delete();
        } catch (\Exception $e) {
        }
    }

    public function editWarmUp(SteadyRun $steadyRun)
    {
        $this->showWarmUpFormModal = true;
        $this->editing = true;
        $this->emit('editWarmUp', $steadyRun);
    }

    public function editSteadyRun(SteadyRun $steadyRun)
    {
        $this->showSteadyRunFormModal = true;
        $this->editing = true;
        $this->emit('editSteadyRun', $steadyRun->id);
    }

    public function editIntermittentRun(IntermittentRun $intermittentRun)
    {
        $this->showIntermittentRunFormModal = true;
        $this->editing = true;
        $this->emit('editIntermittentRun', $intermittentRun->id);
    }

    public function editProgressiveRun(ProgressiveRun $progressiveRun)
    {
        $this->showProgressiveRunFormModal = true;
        $this->editing = true;
        $this->emit('editProgressiveRun', $progressiveRun->id);
    }

    public function editCoolDown(SteadyRun $steadyRun)
    {
        $this->showCoolDownFormModal = true;
        $this->editing = true;
        $this->emit('editCoolDown', $steadyRun);
    }

    public function showWarmUpForm($index)
    {
        $beginning = $this->mesocycle->begin_date;
        $this->training_date = $beginning->addDays($index)->format('Y-m-d');

        $this->showWarmUpFormModal = true;
        $this->emit('trainingDate', $this->training_date);
    }

    public function showSteadyRunForm($index)
    {
        $beginning = $this->mesocycle->begin_date;
        $this->training_date = $beginning->addDays($index)->format('Y-m-d');

        $this->showSteadyRunFormModal = true;
        $this->emit('trainingDate', $this->training_date);
    }

    public function showIntermittentRunForm($index)
    {
        $beginning = $this->mesocycle->begin_date;
        $this->training_date = $beginning->addDays($index)->format('Y-m-d');

        $this->showIntermittentRunFormModal = true;
        $this->emit('trainingDate', $this->training_date);
    }

    public function showProgressiveRunForm($index)
    {
        $beginning = $this->mesocycle->begin_date;
        $this->training_date = $beginning->addDays($index)->format('Y-m-d');

        $this->showProgressiveRunFormModal = true;
        $this->emit('trainingDate', $this->training_date);
    }

    public function showCoolDownForm($index)
    {
        $beginning = $this->mesocycle->begin_date;
        $this->training_date = $beginning->addDays($index)->format('Y-m-d');

        $this->showCoolDownFormModal = true;
        $this->emit('trainingDate', $this->training_date);
    }

    public function render()
    {
        return view('livewire.training.mesocycles.training-days-table', [
            'trainingDays' => Calendar::query()
                ->whereBetween('calendar_date', [
                    $this->mesocycle->begin_date,
                    $this->mesocycle->end_date
                ])
                ->paginate($this->mesocycle->microcycle_length),

            'primaryWarmUps' => SteadyRun::query()
                ->where('steady_run_type_id', 1)
                ->where('mesocycle_id', $this->mesocycle->id)
                ->where('training_session', 'primary')
                ->get(),

            'secondaryWarmUps' => SteadyRun::query()
                ->where('steady_run_type_id', 1)
                ->where('mesocycle_id', $this->mesocycle->id)
                ->where('training_session', 'secondary')
                ->get(),

            'primarySteadyRuns' => SteadyRun::query()
                ->where('mesocycle_id', $this->mesocycle->id)
                ->where('steady_run_type_id', '!=', 1)
                ->where('steady_run_type_id', '!=', 5)
                ->where('training_session', 'primary')
                ->get(),

            'secondarySteadyRuns' => SteadyRun::query()
                ->where('mesocycle_id', $this->mesocycle->id)
                ->where('steady_run_type_id', '!=', 1)
                ->where('steady_run_type_id', '!=', 5)
                ->where('training_session', 'secondary')
                ->get(),

            'primaryIntermittentRuns' => IntermittentRun::query()
                ->where('mesocycle_id', $this->mesocycle->id)
                ->where('training_session', 'primary')
                ->get(),

            'secondaryIntermittentRuns' => IntermittentRun::query()
                ->where('mesocycle_id', $this->mesocycle->id)
                ->where('training_session', 'secondary')
                ->get(),

            'primaryProgressiveRuns' => ProgressiveRun::query()
                ->where('mesocycle_id', $this->mesocycle->id)
                ->where('training_session', 'primary')
                ->get(),

            'secondaryProgressiveRuns' => ProgressiveRun::query()
                ->where('mesocycle_id', $this->mesocycle->id)
                ->where('training_session', 'secondary')
                ->get(),

            'primaryCoolDowns' => SteadyRun::query()
                ->where('steady_run_type_id', 5)
                ->where('mesocycle_id', $this->mesocycle->id)
                ->where('training_session', 'primary')
                ->get(),

            'secondaryCoolDowns' => SteadyRun::query()
                ->where('steady_run_type_id', 5)
                ->where('mesocycle_id', $this->mesocycle->id)
                ->where('training_session', 'secondary')
                ->get(),
        ]);
    }
}
