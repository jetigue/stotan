<?php

namespace App\Http\Livewire\Training;

use App\Models\Training\Macrocycle;
use Carbon\Carbon;
use Livewire\Component;

class MacrocyclesTable extends Component
{
    public $macrocycles;
    public $editing = false;
    public $isExpanded = false;

    public function render()
    {
        return view('livewire.training.macrocycles-table', [
//            'macrocycles' => Macrocycle::query()
//                ->whereDate('end_date', '>=', Carbon::today())
//                ->with('mesocycles')->get(),
        ]);
    }
}
