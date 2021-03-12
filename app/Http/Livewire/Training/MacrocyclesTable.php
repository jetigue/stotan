<?php

namespace App\Http\Livewire\Training;

use App\Models\Training\Macrocycle;
use Carbon\Carbon;
use Livewire\Component;

class MacrocyclesTable extends Component
{
    public $macrocycle;
    public $editing = false;
    public $isExpanded = false;
    public $showFormModal = false;
    public $showConfirmModal = false;
    public $message = '';

    protected $listeners = [
        'hideModal' => 'hideFormModal',
        'showFormModal' => 'showFormModal'
    ];

    public function showFormModal() { $this->showFormModal = true; }
    public function hideFormModal() { $this->showFormModal = false; }

    public function edit(Macrocycle $macrocycle)
        {
            $this->showFormModal = true;
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
            return redirect('/training/macrocycles');
        }

        public function cancel()
        {
            $this->showFormModal = false;
            $this->editing = false;

            $this->emit('cancelCreate');
        }

    public function render()
    {
        return view('livewire.training.macrocycles-table', [
            'macrocycles' => Macrocycle::query()
                ->whereDate('end_date', '>=', Carbon::today())
                ->with('mesocycles')->get(),
        ]);
    }
}
