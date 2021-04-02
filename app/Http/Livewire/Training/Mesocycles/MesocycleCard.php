<?php

namespace App\Http\Livewire\Training\Mesocycles;

use App\Models\Training\Macrocycle;
use App\Models\Training\Mesocycle;
use App\Models\Training\TrainingDay;
use Livewire\Component;

class MesocycleCard extends Component
{
    public $mesocycle;
    public $macrocycle;

    protected $listeners = [
        'updateCard' => 'updateTrainingDays'
    ];

    public function mount()
    {
        $this->macrocycle = Macrocycle::firstWhere('id', $this->mesocycle->macrocycle_id);
    }

    public function goToMesocycle()
    {
        return redirect('/training/macrocycles/' . $this->macrocycle->id . '/mesocycles/' . $this->mesocycle->slug);
    }

    public function editMesocycle (Mesocycle $mesocycle)
    {
        $this->emit('editMesocycle', $mesocycle->id);
    }

    public function confirmDelete(Mesocycle $mesocycle)
    {
        $this->emit('confirmDelete', $mesocycle->id);
    }

    public function updateTrainingDays()
    {
        $this->nullifyUnusedTrainingDays();
        $this->prependTrainingDays();
        $this->appendTrainingDays();
        $this->updateMicrocycles();
    }

    public function nullifyUnusedTrainingDays()
    {
        $oldTrainingDays = TrainingDay::query()
            ->where('mesocycle_id', $this->mesocycle->id)
            ->whereDate('training_day', '>', $this->mesocycle->end_date)
            ->orWhereDate('training_day', '<', $this->mesocycle->begin_date)
            ->get();

        foreach ($oldTrainingDays as $trainingDay)
        {
            $trainingDay->update(['mesocycle_id' => null]);
        }
    }

    public function prependTrainingDays()
    {
        $firstTrainingDay = TrainingDay::query()
            ->where('mesocycle_id', $this->mesocycle->id)
            ->orderByDesc('training_day')
            ->first();

        if ($this->mesocycle->begin_date < $firstTrainingDay->training_day)
        {
            $prependedDays = TrainingDay::query()
                ->whereBetween('training_day', [$this->mesocycle->begin_date, $firstTrainingDay->training_day])
                ->get();

            foreach ($prependedDays as $prependDay)
            {
                $prependDay->update(['mesocycle_id' => $this->mesocycle->id ]);
            }
        }
    }

    public function appendTrainingDays()
    {
        $lastTrainingDay = TrainingDay::query()
            ->where('mesocycle_id', $this->mesocycle->id)
            ->orderBy('training_day')
            ->first();

        if ($this->mesocycle->end_date > $lastTrainingDay->training_day)
        {
            $appendedDays = TrainingDay::query()
                ->whereBetween('training_day', [$lastTrainingDay->training_day, $this->mesocycle->end_date])
                ->get();

            foreach ($appendedDays as $appendedDay)
            {
                $appendedDay->update(['mesocycle_id' => $this->mesocycle->id ]);
            }
        }
    }

    public function updateMicrocycles()
    {
        $mesocycleTrainingDays = TrainingDay::where('mesocycle_id', $this->mesocycle->mesocycle->id)
            ->orderBy('training_day')
            ->get();

        foreach ($mesocycleTrainingDays as $trainingDay)
        {
            $trainingDay->update(['microcycle' => null]);
        }

        $trainingDays = TrainingDay::where('mesocycle_id', $this->mesocycle->id)
            ->orderBy('training_day')
            ->get();

        $chunks = $trainingDays->chunk($this->mesocycle->microcycle_length);
        $microcycle = 0;

        foreach($chunks as $chunk)
        {
            $microcycle++;

            foreach($chunk as $item)
            {
                $item->update(['microcycle' => $microcycle]);
            }
        }





    }


    public function render()
    {
        return view('livewire.training.mesocycles.mesocycle-card');
    }
}
