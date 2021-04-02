<?php

namespace App\Models\Training;

use App\Models\Color;
use App\Models\Training\Runs\SteadyRun;
use App\Traits\BelongsToTeam;
use App\Traits\DateFormatsForTrainingPhases;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class Mesocycle extends Model
{
    use HasFactory, BelongsToTeam, DateFormatsForTrainingPhases;

    protected $fillable = [
        'name',
        'begin_date',
        'end_date',
        'team_id',
        'macrocycle_id',
        'color_id',
        'microcycle_length',
        'view'
    ];

    protected $dates = [
        'begin_date',
        'end_date'
    ];

    protected $appends = [
        'number_of_weeks',
        'begin_date_for_editing',
        'end_date_for_editing',
        'period_of_all_days_in_months',
        'period_of_days',
        'months',
        'weeks',
        'number_of_days',
    ];

    /**
     * Save a slug on store and update.
     */
    public static function boot()
    {
        parent::boot();

        static::saving(function ($mesocycle) {
            $mesocycle->slug = Str::slug($mesocycle->name.'-'.$mesocycle->begin_date->format('m-d-Y').'-to-'.$mesocycle->end_date->format('m-d-Y'));
        });
    }

    /**
     * Get the route key for the model.
     */
//    public function getRouteKeyName(): string
//    {
//        return 'slug';
//    }

    public function macrocycle(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Macrocycle::class, 'macrocycle_id');
    }

    public function color(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function trainingDays(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(TrainingDay::class);
    }

    public function steadyRuns(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SteadyRun::class);
    }

    public function getNumberOfMicrocyclesAttribute():int
    {
        $numTrainingDays = $this->trainingDays()->count();
        $numberMicrocycles = $numTrainingDays / $this->microcycle_length;

        return floor($numberMicrocycles) == $numberMicrocycles ? $numberMicrocycles : $numberMicrocycles + 1;
    }

    public function getNumberOfRunsAttribute():int
    {
        return $this->steadyRuns->where('steady_run_type_id', '>', 3)->count();
    }

    public function getNumberOfTrainingDaysAttribute(): int
    {
        return $this->trainingDays()->count();
    }
}
