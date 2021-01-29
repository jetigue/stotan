<?php

namespace App\Http\Livewire\Training;

use App\Models\Training\Intensity;
use Livewire\Component;

class TrainingIntensityForm extends Component
{
    public $intensity = null;
    public $name;
    public $percentVO2Max;
    public $percentMaxHR;
    public $description;
    public $purpose;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editIntensity' => 'edit'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    protected $rules = [
        'name' => 'required',
        'percentVO2Max' => 'required|max:20',
        'percentMaxHR' => 'required|max:20',
        'description' => 'required',
        'purpose' => 'required'
    ];

    public function edit(Intensity $intensity)
    {
        $this->intensity = $intensity;

        $this->name = $this->intensity->name;
        $this->percentVO2Max = $this->intensity->percentVO2Max;
        $this->percentMaxHR = $this->intensity->percentMaxHR;
        $this->description = $this->intensity->description;
        $this->purpose = $this->intensity->purpose;
    }

    public function submitForm()
    {
        $this->validate();

        $intensity = [
            'name' => $this->name,
            'percentVO2Max' => $this->percentVO2Max,
            'percentMaxHR' => $this->percentMaxHR,
            'description' => $this->description,
            'purpose' => $this->purpose
        ];

        if ($this->intensity) {
            Intensity::find($this->intensity->id)->update($intensity);

            $this->emit('updated');
        } else {
            Intensity::create($intensity);

            $this->resetForm();
            $this->emit('created');
        }
    }

    public function resetForm()
    {
        $this->intensity= null;

        $this->reset([
            'name',
            'percentVO2Max',
            'percentMaxHR',
            'description',
            'purpose'
        ]);
    }

    public function render()
    {
        return view('livewire.training.training-intensity-form');
    }
}
