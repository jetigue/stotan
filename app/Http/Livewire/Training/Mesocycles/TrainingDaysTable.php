<?php

namespace App\Http\Livewire\Training\Mesocycles;

use App\Models\Training\Mesocycle;
use App\Models\Training\Runs\IntermittentRun;
use App\Models\Training\Runs\ProgressiveRun;
use App\Models\Training\Runs\SteadyRun;
use App\Models\Training\TrainingDay;
use Livewire\Component;

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
    public int $microcycle = 1;

    protected $listeners = [
        'hideModal' => 'hideFormModal',
        'showWarmUpFormModal' => 'showWarmUpForm'
    ];

    public function hideFormModal()
    {
        $this->showWarmUpFormModal = false;
        $this->showSteadyRunFormModal = false;
        $this->showIntermittentRunFormModal = false;
        $this->showCoolDownFormModal = false;
        $this->showProgressiveRunFormModal = false;
        $this->emitTo('trainingDay', 'refresh');
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

    public function showWarmUpForm($trainingDay)
    {
        $this->showWarmUpFormModal = true;
        $this->emit('trainingDay', $trainingDay);
    }

    public function showSteadyRunForm($trainingDay)
    {
        $this->showSteadyRunFormModal = true;
        $this->emit('trainingDay', $trainingDay);
    }

    public function showIntermittentRunForm($trainingDay)
    {
        $this->showIntermittentRunFormModal = true;
        $this->emit('trainingDay', $trainingDay);
    }

    public function showProgressiveRunForm($trainingDay)
    {
        $this->showProgressiveRunFormModal = true;
        $this->emit('trainingDay', $trainingDay);
    }

    public function showCoolDownForm($trainingDay)
    {
        $this->showCoolDownFormModal = true;
        $this->emit('trainingDay', $trainingDay);
    }

    public function nextMicrocycle()
    {
        return $this->microcycle++;
    }

    public function previousMicrocycle():int
    {
        return $this->microcycle--;
    }

    public function render()
    {
        return view('livewire.training.mesocycles.training-days-table', [
            'trainingDays' => TrainingDay::with(
                'steadyRuns',
                'steadyRuns.runType',
                'steadyRuns.intensity',
                'intermittentRuns',
                'intermittentRuns.runType',
                'intermittentRuns.intensity',
                'progressiveRuns',
                'progressiveRuns.runType',
                'progressiveRuns.startingIntensity',
                'progressiveRuns.finalIntensity')
            ->where('mesocycle_id', $this->mesocycle->id)
            ->where('microcycle', '=', $this->microcycle)
            ->orderBy('training_day')
            ->get()
        ]);
    }
}
