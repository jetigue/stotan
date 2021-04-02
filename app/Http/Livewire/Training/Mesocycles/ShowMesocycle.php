<?php

namespace App\Http\Livewire\Training\Mesocycles;

use App\Models\Training\Mesocycle;
use App\Models\Training\Runs\SteadyRun;
use App\Models\Training\TrainingDay;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ShowMesocycle extends Component
{

    public Mesocycle $mesocycle;
    public $name;
    public $isOn = false;
    public bool $showCalendar;
    public $view;

    protected $listeners = [
        'changeView' => 'mount',
    ];

    public function mount()
    {
        $this->mesocycle->view === 'calendar' ? $this->showCalendar = true : $this->showCalendar = false;
    }

    public function rules()
    {
        return [
            'view' => 'required|in:calendar,table'
        ];
    }

    public function render()
    {
        return view('livewire.training.mesocycles.show-mesocycle');
    }
}
