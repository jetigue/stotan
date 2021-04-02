<?php

namespace App\Http\Livewire\Training\RunTypes;

use App\Models\Training\RunTypes\Progressive;
use Livewire\Component;

class ProgressiveRunForm extends Component
{
    public $progressive = null;
    public $name;
    public $description;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editProgressiveRun' => 'edit'
    ];

    public function mount()
    {
        $this->resetErrorBag();
    }

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

    public function edit(Progressive $progressive)
    {
        $this->progressive = $progressive;

        $this->name = $this->progressive->name;
        $this->description = $this->progressive->description;
    }

    public function submitForm()
    {
        $this->validate();

        $progressive = [
            'name' => $this->name,
            'description' => $this->description,
        ];

        if ($this->progressive) {
            Progressive::find($this->progressive->id)->update($progressive);

            $this->emit('updated');

        } else {
            $progressive= Progressive::create($progressive);

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
        return view('livewire.training.run-types.progressive-run-form');
    }
}
