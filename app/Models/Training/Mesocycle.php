<?php

namespace App\Models\Training;

use App\Traits\BelongsToTeam;
use App\Traits\DateFormatsForTrainingPhases;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesocycle extends Model
{
    use HasFactory, BelongsToTeam, DateFormatsForTrainingPhases;

    protected $fillable = ['name', 'begin_date', 'end_date', 'team_id', 'macrocycle_id', 'color'];

    protected $casts = [
        'begin_date' => 'date',
        'end_date' => 'date',
        'number_of_days' => 'integer'
    ];

    protected $appends = [
        'number_of_weeks',
        'begin_date_for_editing',
        'end_date_for_editing',
        'period_of_all_days_in_months',
        'period_of_days',
        'months',
        'weeks',
        'number_of_days'
    ];

    public function macrocycle(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Macrocycle::class, 'macrocycle_id');
    }
}
