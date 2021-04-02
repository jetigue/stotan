<?php

namespace App\Http\Livewire\Training\Mesocycles;

use App\Models\Color;
use App\Models\Training\Macrocycle;
use App\Models\Training\Mesocycle;
use App\Models\Training\TrainingDay;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Livewire\Component;
use Illuminate\Validation\Rule;

class MesocycleForm extends Component
{
    public $begin_date_for_editing;
    public $color_id;
    public $colors;
    public $end_date_for_editing;
    public $expand = false;
    public $highlight = false;
    public $macrocycle_id;
    public $mesocycle = null;
    public $microcycle_length = '7';
    public $name;
    public $selectedColor;
    public $team_id;
    public Macrocycle $macrocycle;
//    public $extraDays = 0;

    protected $listeners = [
        'cancelCreate' => 'resetForm',
        'submitCreate' => 'submitForm',
        'editMesocycle' => 'edit',
    ];

    public function mount()
    {
        $this->colors = Color::all();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

//    public function updatedBeginDateForEditing(): int
//    {
//        if ($this->end_date_for_editing and $this->microcycle_length)
//        {
//            $beginDate = Carbon::create($this->begin_date_for_editing);
//            $endDate = Carbon::create($this->end_date_for_editing);
//            $extraDays = ($beginDate->diffIndays($endDate) + 1) % $this->microcycle_length;
//
//            return $this->extraDays = $extraDays;
//        }
//
//        return $this->extraDays;
//    }

//    public function updatedEndDateForEditing(): int
//    {
//        if ($this->begin_date_for_editing and $this->microcycle_length)
//        {
//            $beginDate = Carbon::create($this->begin_date_for_editing);
//            $endDate = Carbon::create($this->end_date_for_editing);
//            $extraDays = ($beginDate->diffIndays($endDate) + 1) % $this->microcycle_length;
//
//            return $this->extraDays = $extraDays;
//        }
//
//        return $this->extraDays;
//    }
//
//    public function updatedMicrocycleLength():int
//    {
//        if ($this->begin_date_for_editing and $this->end_date_for_editing)
//        {
//            $beginDate = Carbon::create($this->begin_date_for_editing);
//            $endDate = Carbon::create($this->end_date_for_editing);
//            $extraDays = ($beginDate->diffIndays($endDate) + 1) % $this->microcycle_length;
//
//            return $this->extraDays = $extraDays;
//        }
//
//        return $this->extraDays;
//    }

    public function rules()
    {
        return [
            'name' => 'required',
            'begin_date_for_editing' => 'required|date|after__or_equal:macrocycle.begin_date',
            'end_date_for_editing' => 'required|date|after:begin_date|before__or_equal:macrocycle.end_date',
            'microcycle_length' => 'required|in:7,10,14',
            'color_id' => 'required|integer'
        ];
    }

    public function edit(Mesocycle $mesocycle)
    {
        $this->mesocycle = $mesocycle;
        $this->selectedColor = Color::where('id', $mesocycle->color->id)->get();
        $this->name = $this->mesocycle->name;
        $this->begin_date_for_editing = $this->mesocycle->begin_date_for_editing;
        $this->end_date_for_editing = $this->mesocycle->end_date_for_editing;
        $this->microcycle_length = $this->mesocycle->microcycle_length;
        $this->color_id = $this->mesocycle->color_id;
//        $this->extraDays = ($this->mesocycle->begin_date->diffInDays($this->mesocycle->end_date) + 1) % $this->microcycle_length;
    }

    public function submitForm()
    {
        $this->validate();

        $mesocycle = [
            'begin_date' => $this->begin_date_for_editing,
            'color_id' => $this->color_id,
            'end_date' => $this->end_date_for_editing,
            'macrocycle_id' => $this->macrocycle->id,
            'microcycle_length' => $this->microcycle_length,
            'name' => $this->name,
            'team_id' => session('team_id'),
        ];

        if ($this->mesocycle) {
            Mesocycle::find($this->mesocycle->id)->update($mesocycle);

            $this->resetForm();
            $this->emit('hideModal');
            $this->emit('updateCard');

        } else {
            $mesocycle = Mesocycle::create($mesocycle);

            $this->resetForm();
            $this->emit('hideModal');
            $this->updateTrainingDays($mesocycle);
        }
    }

    public function updateTrainingDays(Mesocycle $mesocycle)
    {
        $mesocycleTrainingDays = TrainingDay::query()
            ->where('macrocycle_id', $mesocycle->macrocycle->id)
            ->whereBetween('training_day', [$mesocycle->begin_date, $mesocycle->end_date])
            ->get();

        foreach ($mesocycleTrainingDays as $trainingDay)
        {
            $trainingDay->update(['mesocycle_id' => $mesocycle->id]);
        }

        $chunks = $mesocycleTrainingDays->chunk($mesocycle->microcycle_length);
        $microcycle = 0;

        foreach($chunks as $chunk)
        {
            $microcycle++;

            foreach($chunk as $item)
            {
                $item->update(['microcycle' => $microcycle]);
            }
        }

    }

    public function resetForm()
    {
        $this->reset([
            'begin_date_for_editing',
            'color_id',
            'end_date_for_editing',
            'mesocycle',
            'microcycle_length',
            'name',
        ]);

        $this->selectedColor = null;
    }

    public function render()
    {
        return view('livewire.training.mesocycles.mesocycle-form');
    }

    public function updateColor($color_id)
    {
        if (!is_null($color_id)) {
            $this->selectedColor = Color::where('id', $color_id)->get();

            $this->color_id = $color_id;

            $this->highlight = false;

            $this->expand = false;

        }
    }
}
