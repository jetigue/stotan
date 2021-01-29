<?php

namespace App\Http\Livewire\Training\RunTypes;

use App\Models\Training\RunTypes\Intermittent;
use Livewire\Component;

class IntermittentRunForm extends Component
{
    public $intermittent = null;
    public $name;
    public $description;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editIntermittentRun' => 'edit'
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

    public function edit(Intermittent $intermittent)
    {
        $this->intermittent = $intermittent;

        $this->name = $this->intermittent->name;
        $this->description = $this->intermittent->description;
    }

    public function submitForm()
    {
        $this->validate();

        $intermittent = [
            'name' => $this->name,
            'description' => $this->description,
        ];

        if ($this->intermittent) {
            Intermittent::find($this->intermittent->id)->update($intermittent);

            $this->emit('updated');

        } else {
            $intermittent= Intermittent::create($intermittent);

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
        return view('livewire.training.run-types.intermittent-run-form');
    }
}
