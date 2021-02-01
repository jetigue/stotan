<?php

namespace App\Http\Livewire\Training;

use App\Models\Training\Macrocycle;
use Carbon\Carbon;
use Livewire\Component;

class Macrocycles extends Component
{
    public $showCreateModal = false;
    public $showConfirmModal = false;
    public $macrocycle;
    public $editing = false;

    protected $listeners = [
        'hideModal' => 'hideCreateModal',
        'showCreateModal' => 'showCreateModal'
    ];

    public function showCreateModal() { $this->showCreateModal = true; }
    public function hideCreateModal() { $this->showCreateModal = false; }

    public function edit(Macrocycle $macrocycle)
    {
        $this->showCreateModal = true;
        $this->editing = true;
        $this->emit('editMacrocycle', $macrocycle->id);
    }

    public function confirmDelete(Macrocycle $macrocycle)
    {
        $this->showConfirmModal = true;
        $this->macrocycle = $macrocycle;
    }

    public function destroy()
    {
        $this->macrocycle->delete();
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
        return view('livewire.training.macrocycles', [
            'macrocycles' => Macrocycle::query()
                ->whereDate('end_date', '>=', Carbon::today())
                ->with('mesocycles')->get(),

            'archivedMacrocycles' => Macrocycle::query()
                ->whereDate('end_date', '<=', Carbon::today())
                ->with('mesocycles')
                ->orderByDesc('end_date')
                ->get()
        ]);
    }
}
