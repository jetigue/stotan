<?php

namespace App\Http\Livewire\Training\RunTypes;

use App\Models\Training\RunTypes\Intermittent;
use Livewire\Component;

class IntermittentRunsTable extends Component
{
    public Intermittent $intermittent;
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

    public function edit(Intermittent $intermittent)
    {
        $this->showCreateModal = true;
        $this->editing = true;
        $this->emit('editIntermittentRun', $intermittent->id);
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

    public function confirmDelete(Intermittent $intermittent)
    {
        $this->showConfirmModal = true;
        $this->intermittent = $intermittent;
    }

    public function destroy(Intermittent $intermittent)
    {
        $this->$intermittent = $intermittent;
        $this->intermittent->delete();
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
        return view('livewire.training.run-types.intermittent-runs-table', [
            'intermittentRunTypes' => Intermittent::all()
        ]);
    }
}
