<?php

namespace App\Http\Livewire\Training\Macrocycles;

use App\Models\Training\Macrocycle;
use App\Models\Training\TrainingDay;
use Carbon\CarbonPeriod;
use Livewire\Component;

class MacrocycleCard extends Component
{
    public $macrocycle;

    protected $listeners = [
        'refreshCards' => 'updateTrainingDays'
    ];

    public function goToMacrocycle()
    {
        return redirect('/training/macrocycles/' . $this->macrocycle->id);
    }

    public function getWeeksLabelProperty(): string
    {
        $weeks = $this->macrocycle->number_of_weeks;

        return $weeks != 1 ? 'Weeks' : 'Week';
    }

    public function getDaysProperty()
    {
        $days = $this->macrocycle->number_of_remainder_days;

        if ($days > 0)
        {
            return $days > 1 ? $days . ' ' . 'Days' : $days . ' ' . 'Day';
        }
        return 0;
    }

    public function editMacrocycle(Macrocycle $macrocycle)
    {
        $this->emit('editMacrocycle', $macrocycle->id);
    }

    public function confirmDelete(Macrocycle $macrocycle)
    {
        $this->emit('confirmDelete', $macrocycle->id);
    }

    public function updateTrainingDays()
    {
        $this->deleteUnusedTrainingDays();
        $this->prependTrainingDays();
        $this->appendTrainingDays();
    }

    protected function deleteUnusedTrainingDays()
    {
        $oldTrainingDays = TrainingDay::query()
            ->where('macrocycle_id', $this->macrocycle->id)
            ->whereDate('training_day', '>', $this->macrocycle->end_date)
            ->orWhereDate('training_day', '<', $this->macrocycle->begin_date)
            ->get();

        foreach ($oldTrainingDays as $trainingDay)
        {
            $trainingDay->delete();
        }
    }

    public function prependTrainingDays()
    {
        $firstTrainingDay = TrainingDay::query()
            ->where('macrocycle_id', $this->macrocycle->id)
            ->orderBy('training_day')
            ->first();

        if ($this->macrocycle->begin_date != $firstTrainingDay->training_day)
        {
            $prependTrainingDays = CarbonPeriod::create(
                $this->macrocycle->begin_date,
                $firstTrainingDay->training_day,
                CarbonPeriod::EXCLUDE_END_DATE
            );

            foreach ($prependTrainingDays as $prependDay)
            {
                $trainingDay = [
                    'team_id'       => session('team_id'),
                    'macrocycle_id' => $this->macrocycle->id,
                    'training_day'  => $prependDay
                ];

                TrainingDay::create($trainingDay);
            }
        }
    }

    public function appendTrainingDays()
    {
        $lastTrainingDay = TrainingDay::query()
            ->where('macrocycle_id', $this->macrocycle->id)
            ->orderByDesc('training_day')
            ->first();


        if ($lastTrainingDay->training_day != $this->macrocycle->end_date)
        {
            $appendTrainingDays = CarbonPeriod::create(
                $lastTrainingDay->training_day,
                $this->macrocycle->end_date,
                CarbonPeriod::EXCLUDE_START_DATE
            );

            foreach ($appendTrainingDays as $appendDay)
            {
                $trainingDay = [
                    'team_id'       => session('team_id'),
                    'macrocycle_id' => $this->macrocycle->id,
                    'training_day'  => $appendDay
                ];

                TrainingDay::create($trainingDay);
            }
        }
    }

    public function render()
    {
        return view('livewire.training.macrocycles.macrocycle-card');
    }


}
