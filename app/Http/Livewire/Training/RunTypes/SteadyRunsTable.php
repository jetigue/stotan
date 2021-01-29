<?php

namespace App\Http\Livewire\Training\RunTypes;

use App\Models\Training\RunTypes\Steady;
use Livewire\Component;

class SteadyRunsTable extends Component
{
    public Steady $steady;
    public bool $showCreateModal = false;
    public $showConfirmModal = false;
    public $editing = false;
    public $isExpanded = false;
    public $message = null;

    protected $listeners = [
        'updated' => 'recordUpdated',
        'created' => 'recordCreated'
    ];

    public function showCreateModal() { $this->showCreateModal = true; }
    public function hideCreateModal() { $this->showCreateModal = false; }

    public function edit(Steady $steady)
    {
        $this->showCreateModal = true;
        $this->editing = true;
        $this->emit('editSteadyRun', $steady->id);
    }

    public function recordCreated()
    {
        $this->message = 'created';
        $this->hideCreateModal();
    }

    public function recordUpdated()
    {
        $this->message = 'saved';
        $this->hideCreateModal();
    }

    public function confirmDelete(Steady $steady)
    {
        $this->showConfirmModal = true;
        $this->steady = $steady;
    }

    public function destroy(Steady $steady)
    {
        $this->$steady = $steady;
        $this->steady->delete();
        $this->message = 'deleted';
        $this->isExpanded = false;
        $this->showConfirmModal = false;
    }

    public function cancel()
    {
        $this->showCreateModal = false;
        $this->editing = false;

        $this->emit('cancelCreate');
    }

    public function render()
    {
        return view('livewire.training.run-types.steady-runs-table', [
            'steadyRuns' => Steady::all()
        ]);
    }
}
