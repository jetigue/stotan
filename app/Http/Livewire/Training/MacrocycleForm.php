<?php

namespace App\Http\Livewire\Training;

use App\Models\Training\Macrocycle;
use Livewire\Component;

class MacrocycleForm extends Component
{
    public $macrocycle = null;
    public $name;
    public $begin_date;
    public $end_date;
    public $team_id;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editMacrocycle' => 'edit'
    ];

    protected $rules = [
        'name' => 'required',
        'begin_date' => 'required|date',
        'end_date' => 'required|date'
    ];

    public function edit(Macrocycle $macrocycle)
    {
        $this->macrocycle = $macrocycle;

        $this->name = $this->macrocycle->name;
        $this->begin_date = $this->macrocycle->begin_date;
        $this->end_date = $this->macrocycle->end_date;
    }

    public function submitForm()
    {
        $this->validate();

        $macrocycle = [
            'name' => $this->name,
            'begin_date' => $this->begin_date,
            'end_date' => $this->end_date,
            'team_id' => session('team_id'),
        ];

        if ($this->macrocycle) {
            Macrocycle::find($this->macrocycle->id)->update($macrocycle);

            $this->emit('hideModal');
        } else {
            Macrocycle::create($macrocycle);

            $this->resetForm();
            $this->emit('hideModal');
        }
    }

    public function resetForm()
    {
        $this->macrocycle = null;

        $this->name = '';
        $this->begin_date = '';
        $this->end_date = '';
    }

    public function render()
    {
        return view('livewire.training.macrocycle-form');
    }
}
