<?php

namespace App\Http\Livewire\Training\TrainingDays;

use App\Models\Training\Runs\SteadyRun;
use Livewire\Component;

class PrimaryWarmUp extends Component
{
    public $trainingDay;

    public function render()
    {
        return view('livewire.training.training-days.primary-warm-up', [
            'warmUps' => SteadyRun::with('intensity', 'runType')
            ->where('training_day_id', $this->trainingDay->id)
            ->where('steady_run_type_id', 1)
            ->where('training_session', 'primary')
            ->get()
        ]);
    }
}
