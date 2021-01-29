<?php

namespace App\Http\Livewire\Training;

use App\Models\Training\Mesocycle;
use Livewire\Component;
use Livewire\WithPagination;

class MesocycleDatesTable extends Component
{
    public Mesocycle $mesocycle;
    public $search = '';
    public $sortField = 'date';
    public $sortDirection = 'asc';

    protected $queryString = ['sortField', 'sortDirection'];

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
        return view('livewire.training.mesocycle-dates-table');
    }
}
