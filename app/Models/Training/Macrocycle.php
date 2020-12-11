<?php

namespace App\Models\Training;

use App\Models\Calendar;
use App\Traits\BelongsToTeam;
use App\Traits\DateFormatsForTrainingPhases;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Macrocycle extends Model
{
    use HasFactory, BelongsToTeam, DateFormatsForTrainingPhases;

    protected $fillable = ['name', 'begin_date', 'end_date', 'team_id'];

    protected $casts = [
        'begin_date' => 'date',
        'end_date' => 'date'
    ];

    protected $appends = [
        'number_of_weeks',
        'number_of_mesocycles',
        'begin_date_for_editing',
        'end_date_for_editing',
        'period_of_all_days_in_months',
        'period_of_days',
        'months',
        'beginning_day',
    ];

    public function mesocycles(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Mesocycle::class);
    }

    public function getNumberOfMesocyclesAttribute(): int
    {
        return count($this->mesocycles);
    }

    public function addMesocycle($mesocycles): Model
    {
        return $this->mesocycles()->create($mesocycles);
    }

}
