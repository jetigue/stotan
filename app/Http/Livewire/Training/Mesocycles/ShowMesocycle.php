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
//    public $editing = false;
    public bool $showCalendar;
//    public bool $showWarmUpFormModal = false;
//    public bool $showSteadyRunFormModal = false;
//    public bool $showCoolDownFormModal = false;
//    public $training_date;
    public $steadyRun;
    public $view;

    protected $listeners = [
//        'editWarmUp',
//        'showWarmUpForm' => 'showWarmUpForm',
//        'showSteadyRunForm' => 'showSteadyRunForm',
//        'showCoolDownForm' => 'showCoolDownForm',
//        'hideModal' => 'hideFormModal',
        'changeView' => 'mount'
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

//    public function editWarmUp()
//    {
//        $this->showWarmUpFormModal = true;
//        $this->editing = true;
//    }

//    public function changeView()
//    {
//        $this->mesocycle->view === 'calendar' ? $this->showCalendar = true : $this->showCalendar = false;
//    }

//    public function showWarmUpForm($index)
//    {
//        $beginning = $this->mesocycle->begin_date;
//        $this->training_date = $beginning->addDays($index)->format('Y-m-d');
//
//        $this->showWarmUpFormModal = true;
//        $this->emit('trainingDate', $this->training_date);
//    }

//    public function showSteadyRunForm($index)
//    {
//        $beginning = $this->mesocycle->begin_date;
//        $this->training_date = $beginning->addDays($index)->format('Y-m-d');
//
//        $this->showSteadyRunFormModal = true;
//        $this->emit('trainingDate', $this->training_date);
//    }

//    public function showCoolDownForm($index)
//    {
//
//        $beginning = $this->mesocycle->begin_date;
//        $this->training_date = $beginning->addDays($index)->format('Y-m-d');
//
//        $this->showCoolDownFormModal = true;
//        $this->emit('trainingDate', $this->training_date);
//    }


//    public function editSteadyRun(SteadyRun $steadyRun)
//    {
//        $this->showSteadyRunFormModal = true;
//        $this->editing = true;
//        $this->emit('editSteadyRun', $steadyRun->id);
//    }
//
//    public function editCoolDown(SteadyRun $steadyRun)
//    {
//        $this->showCoolDownFormModal = true;
//        $this->editing = true;
//        $this->emit('editCoolDown', $steadyRun->id);
//    }

//    public function hideFormModal()
//    {
//        $this->showWarmUpFormModal = false;
//        $this->showSteadyRunFormModal = false;
//        $this->showCoolDownFormModal = false;
//    }

//    public function cancel()
//    {
//        $this->hideFormModal();
//        $this->editing = false;
//
//        $this->emit('cancelCreate');
//    }

    public function render()
    {
        return view('livewire.training.mesocycles.show-mesocycle'
//            , [
//            'warmUps' => SteadyRun::query()
//                ->where('steady_run_type_id', 1)
//                ->where('mesocycle_id', $this->mesocycle->id)
//                ->get(),
//
//            'steadyRuns' => SteadyRun::query()
//                ->where('mesocycle_id', $this->mesocycle->id)
//                ->where('steady_run_type_id', '!=', 1)
//                ->where('steady_run_type_id', '!=', 5)
//                ->get(),
//
//            'coolDowns' => SteadyRun::query()
//                ->where('steady_run_type_id', 5)
//                ->where('mesocycle_id', $this->mesocycle->id)
//                ->get()
//        ]
        );
    }
}
