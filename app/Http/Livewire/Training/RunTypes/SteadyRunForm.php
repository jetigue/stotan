<?php

namespace App\Http\Livewire\Training\RunTypes;

use App\Models\Training\RunTypes\Steady;
use Livewire\Component;

class SteadyRunForm extends Component
{
    public $steady = null;
    public $name;
    public $description;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editSteadyRun' => 'edit'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'description' => 'required',
        ];
    }

    public function edit(Steady $steady)
    {
        $this->steady = $steady;

        $this->name = $this->steady->name;
        $this->description = $this->steady->description;
    }

    public function submitForm()
    {
        $this->validate();

        $steady = [
            'name' => $this->name,
            'description' => $this->description,
        ];

        if ($this->steady) {
            Steady::find($this->steady->id)->update($steady);

            $this->emit('updated');

        } else {
            $steady= Steady::create($steady);

            $this->resetForm();
            $this->emit('created');
        }
    }

    public function resetForm()
    {
        $this->reset([
            'name', 'description'
        ]);
    }


    public function render()
    {
        return view('livewire.training.run-types.steady-run-form');
    }
}
