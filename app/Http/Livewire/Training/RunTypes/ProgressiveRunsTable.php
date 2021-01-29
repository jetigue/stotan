<?php

namespace App\Http\Livewire\Training\RunTypes;

use App\Models\Training\RunTypes\Progressive;
use Livewire\Component;

class ProgressiveRunsTable extends Component
{
    public Progressive $progressive;
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

    public function edit(Progressive $progressive)
    {
        $this->showCreateModal = true;
        $this->editing = true;
        $this->emit('editProgressiveRun', $progressive->id);
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

    public function confirmDelete(Progressive $progressive)
    {
        $this->showConfirmModal = true;
        $this->progressive = $progressive;
    }

    public function destroy(Progressive $progressive)
    {
        $this->$progressive = $progressive;
        $this->progressive->delete();
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
        return view('livewire.training.run-types.progressive-runs-table', [
            'progressiveRuns' => Progressive::all()
        ]);
    }
}
