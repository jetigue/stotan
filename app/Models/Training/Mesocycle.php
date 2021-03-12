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

    public function steadyRuns(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SteadyRun::class);
    }
}
