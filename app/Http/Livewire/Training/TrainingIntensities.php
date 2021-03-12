<?php

namespace App\Http\Livewire\Training;

use App\Models\Training\Intensity;
use Livewire\Component;

class TrainingIntensities extends Component
{
    public $intensity;
    public $name;
//    public $percentVO2Max;
//    public $percentMaxHR;
    public $expandedRow = false;
    public $sortField = 'jd_points';
    public $sortDirection = 'asc';
    public $showFormModal = false;
    public $showConfirmModal = false;
    public $editing = false;
    public $message = null;

    protected $queryString = ['sortField', 'sortDirection'];

    protected $listeners = [
        'hideModal' => 'hideFormModal',
        'postAdded' => 'showFormModal',
        'updated' => 'recordUpdated',
        'created' => 'recordCreated'
    ];

    public function expandRow()
    {
        $this->expandedRow = true;
    }

    public function contractRow()
    {
        $this->expandedRow = false;
    }


    public function showFormModal() { $this->showFormModal = true; }
    public function hideFormModal() { $this->showFormModal = false; }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    public function edit(Intensity $intensity)
    {
        $this->showFormModal = true;
        $this->editing = true;
        $this->emit('editIntensity', $intensity->id);
    }

    public function confirmDelete(Intensity $intensity)
    {
        $this->showConfirmModal = true;
        $this->intensity = $intensity;
    }

    public function destroy(Intensity $intensity)
    {
        $this->showConfirmModal = false;
        $this->$intensity = $intensity;
        $this->intensity->delete();

        $this->message = 'deleted';
        session()->flash('message', 'Post successfully deleted.');
    }

    public function cancel()
    {
        $this->showFormModal = false;
        $this->editing = false;
        $this->message = null;

        $this->emit('cancelCreate');
    }

    public function recordCreated()
    {
        $this->hideFormModal();
        $this->message = 'created';
    }

    public function recordUpdated()
    {
        $this->message = 'saved';
        $this->hideFormModal();
    }

    public function render()
    {
        return view('livewire.training.training-intensities', [
            'intensities' => Intensity::query()->orderBy($this->sortField, $this->sortDirection)->get(),
        ]);
    }
}
