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

//    public function getNumberOfPrimaryRunsAttribute(): int
//    {
//        $sRuns = $this->primarySteadyRuns()->count();
//        $iRuns = $this->primaryIntermittentRuns()->count();
//        $pRuns = $this->primaryProgressiveRuns()->count();
//
//        return $sRuns + $iRuns + $pRuns;
//    }
//
//    public function getNumberOfSecondaryRunsAttribute(): int
//    {
//        $sRuns = $this->secondarySteadyRuns()->count();
//        $iRuns = $this->secondaryIntermittentRuns()->count();
//        $pRuns = $this->secondaryProgressiveRuns()->count();
//
//        return $sRuns + $iRuns + $pRuns;
//    }

//    public function getPrimarySessionMinutesAttribute()
//    {
//        $warmUpMinutes = $this->primaryWarmUps()->sum('duration');
//        $steadyRunMinutes = $this->primarySteadyRuns()->sum('duration');
//        $coolDownMinutes = $this->primaryCoolDowns()->sum('duration');
//        return $warmUpMinutes + $steadyRunMinutes + $coolDownMinutes;
//    }


}
