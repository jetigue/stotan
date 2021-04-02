<?php

namespace App\Models\Training;

use App\Models\Training\Runs\IntermittentRun;
use App\Models\Training\Runs\ProgressiveRun;
use App\Models\Training\Runs\SteadyRun;
use App\Traits\BelongsToTeam;
use App\Traits\DateFormatsForTrainingPhases;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrainingDay extends Model
{
    use HasFactory, BelongsToTeam, DateFormatsForTrainingPhases;

    protected $table = 'training_days';

    protected $fillable = ['training_day', 'macrocycle_id', 'mesocycle_id', 'microcycle'];

    protected $casts = ['training_day' => 'date'];

    public function macrocycle(): BelongsTo
    {
        return $this->belongsTo(Macrocycle::class, 'macrocycle_id');
    }

    public function mesocycle(): BelongsTo
    {
        return $this->belongsTo(Mesocycle::class, 'mesocycle_id');
    }

    public function steadyRuns(): HasMany
    {
        return $this->hasMany(SteadyRun::class);
    }

    public function intermittentRuns(): HasMany
    {
        return $this->hasMany(IntermittentRun::class);
    }

    public function progressiveRuns(): HasMany
    {
        return $this->hasMany(ProgressiveRun::class);
    }

    public function getTotalMinutesAttribute()
    {
        $steadyRuns = collect($this->steadyRuns)->sum('minutes_running');
        $intermittentRuns = collect($this->intermittentRuns)->sum('minutes_running');

        return $steadyRuns + $intermittentRuns;
    }


    public function getTotalTimeRunningAttribute(): string
    {
        $steadyRuns = collect($this->steadyRuns)->sum('minutes_running');
        $intermittentRuns = collect($this->intermittentRuns)->sum('minutes_running');

        $total =  $steadyRuns + $intermittentRuns;

        $hours = floor($total / 60);
        $minutes = $total % 60;

        $hrs = $hours < 1 ? '' : ($hours == 1 ? '1 hr' . ' ' : $hours . ' ' . 'hrs' . ' ');
        $min = $minutes < 1 ? '' : $minutes . ' ' . 'min';

        return $hrs . $min;
    }

    public function getTotalMilesAttribute(): string
    {
        $steadyRuns = collect($this->steadyRuns)->sum('miles');
        $intermittentRuns = collect($this->intermittentRuns)->sum('total_miles');

        return round($steadyRuns + $intermittentRuns, 1);
    }

    public function getTotalMilesForHumansAttribute(): string
    {
        $steadyRuns = collect($this->steadyRuns)->sum('miles');
        $intermittentRuns = collect($this->intermittentRuns)->sum('total_miles');

        return round($steadyRuns + $intermittentRuns, 1) . ' ' . 'mi';
    }

    public function getTotalPointsAttribute(): string
    {
        $steadyRuns = collect($this->steadyRuns)->sum('points');
        $intermittentRuns = collect($this->intermittentRuns)->sum('points');

        return round($steadyRuns + $intermittentRuns, 1);
    }

    public function getTotalPointsForHumansAttribute(): string
    {
        $steadyRuns = collect($this->steadyRuns)->sum('points');
        $intermittentRuns = collect($this->intermittentRuns)->sum('points');

        return round($steadyRuns + $intermittentRuns, 1) . ' ' . 'pts';
    }

    public function getNumberOfPrimaryRunsAttribute(): int
    {
        $sRuns = $this->steadyRuns()->where('training_session', 'primary')->count();
        $iRuns = $this->intermittentRuns()->where('training_session', 'primary')->count();
        $pRuns = $this->progressiveRuns()->where('training_session', 'primary')->count();

        return $sRuns + $iRuns + $pRuns;
    }

    public function getNumberOfSecondaryRunsAttribute(): int
    {
        $sRuns = $this->steadyRuns()->where('training_session', 'secondary')->count();
        $iRuns = $this->intermittentRuns()->where('training_session', 'secondary')->count();
        $pRuns = $this->progressiveRuns()->where('training_session', 'secondary')->count();

        return $sRuns + $iRuns + $pRuns;
    }



}
