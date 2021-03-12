<?php

namespace App\Http\Livewire\Training\Mesocycles;

use App\Models\Training\Mesocycle;
use Livewire\Component;

class ViewToggle extends Component
{
    public Mesocycle $mesocycle;
    public bool $showCalendar;
    public string $view;

    public function mount()
    {
        $this->mesocycle->view === 'table' ? $this->showCalendar = true : $this->showCalendar = false;
    }

    public function toggleView()
    {
        $this->mesocycle->view === 'calendar' ? $this->view = 'table' : $this->view = 'calendar';

        $mesocycle = [ 'view' => $this->view ];

        Mesocycle::find($this->mesocycle->id)->update($mesocycle);

        $this->emit('changeView');

    }

    public function render()
    {
        return view('livewire.training.mesocycles.view-toggle');
    }
}
