<?php

namespace App\Http\Livewire\Training;

use App\Models\Training\Mesocycle;
use App\Models\Training\TrainingDay;
use Livewire\Component;
use Livewire\WithPagination;

class ShowMesocycle extends Component
{
    use WithPagination;

    public Mesocycle $mesocycle;
    public $name;
    public $search = '';
    public $sortField = 'training_day';
    public $sortDirection = 'asc';
    public $showCalendar = false;

//    protected $queryString = ['sortField', 'sortDirection'];

    public function mount()
    {
        $this->trainingDays = $this->mesocycle->trainingDays;
    }

    public function toggleCalendar()
    {
        $this->showCalendar = true;
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function render()
    {
        return view('livewire.training.show-mesocycle', [
            'trainingDays' => TrainingDay::query()
                ->where('mesocycle_id', $this->mesocycle->id)
                ->orderBy($this->sortField, $this->sortDirection)
                ->paginate(14)
        ]);
    }
}
