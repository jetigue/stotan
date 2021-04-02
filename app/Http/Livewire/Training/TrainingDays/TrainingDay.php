<?php

namespace App\Http\Livewire\Training\TrainingDays;

use App\Http\Livewire\Training\Mesocycles\TrainingDaysTable;
use App\Models\Training\Runs\SteadyRun;
use Livewire\Component;

class TrainingDay extends Component
{
    public $trainingDay;
    public bool $showEditAndDelete = false;

    public function getTotalTimeRunningProperty()
    {
        $steadyRuns = collect($this->trainingDay->steadyRuns)->sum('minutes_running');
        $intermittentRuns = collect($this->trainingDay->intermittentRuns)->sum('minutes_running');

        $total =  $steadyRuns + $intermittentRuns;

        $hours = floor($total / 60);
        $minutes = $total % 60;

        $hrs = $hours < 1 ? '' : ($hours == 1 ? '1 hr' . ' ' : $hours . ' ' . 'hrs' . ' ');
        $min = $minutes < 1 ? '' : $minutes . ' ' . 'min';

        return $hrs . $min;
    }

    public function render()
    {
        return view('livewire.training.training-days.training-day');
    }
}
