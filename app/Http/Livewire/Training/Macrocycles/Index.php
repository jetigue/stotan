<?php

namespace App\Http\Livewire\Training\Macrocycles;

use App\Models\Training\Macrocycle;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    public $showFormModal = false;
    public $showConfirmModal = false;
    public $macrocycle;
    public $editing = false;

    protected $listeners = [
        'hideModal' => 'hideModal',
        'createMacrocycle' => 'showCreateModal',
        'editMacrocycle' => 'editMacrocycle',
        'confirmDelete' => 'confirmDelete',
    ];

    public function showCreateModal() { $this->showFormModal = true; }
    public function hideModal() { $this->showFormModal = false; }

    public function editMacrocycle()
    {
        $this->showFormModal =true;
        $this->editing = true;
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
        $this->showFormModal = false;
    }

    public function render()
    {
        return view('livewire.training.macrocycles.index', [
            'macrocycles' => Macrocycle::with('mesocycles')
                ->whereDate('end_date', '>=', Carbon::today())
                ->get(),

            'archivedMacrocycles' => Macrocycle::with('mesocycles')
                ->whereDate('end_date', '<=', Carbon::today())
                ->orderByDesc('end_date')
                ->get()
        ]);
    }
}
