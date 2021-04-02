<?php

namespace App\Models\Training\Runs;

use App\Models\Training\Intensity;
use App\Models\Training\Mesocycle;
use App\Models\Training\RunTypes\Progressive;
use App\Models\Training\TrainingDay;
use App\Traits\BelongsToTeam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressiveRun extends Model
{
    use HasFactory, BelongsToTeam;

    /**
     * @var string
     */
    protected $table = 'progressive_runs';

    /**
     * @var string[]
     */
    protected $fillable = [
        'duration',
        'duration_unit',
        'final_training_intensity_id',
        'mesocycle_id',
        'notes',
        'progression_interval',
        'progression_interval_unit',
        'progressive_run_type_id',
        'starting_training_intensity_id',
        'team_id',
        'training_day_id',
        'training_session',
    ];

    public function startingIntensity(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Intensity::class, 'starting_training_intensity_id');
    }

    public function finalIntensity(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Intensity::class, 'final_training_intensity_id');
    }

    public function runType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Progressive::class, 'progressive_run_type_id');
    }

    public function mesocycle(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Mesocycle::class, 'mesocycle_id');
    }

    public function trainingDay(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TrainingDay::class, 'training_day_id');
    }

    public function startingIntensityMinutesRunning(): float
    {
        if ($this->duration_unit === 'miles')
        {
            switch($this->startingIntensity->name) {
                case 'Easy':
                    $min = $this->duration * 7.133;
                    break;
                case 'Steady State':
                    $min = $this->duration * 6.167;
                    break;
                case 'Threshold':
                    $min = $this->duration * 5.817;
                    break;
                case 'Critical Velocity':
                    $min = $this->duration * 5.6;
                    break;
                case 'Interval':
                    $min = $this->duration * 5.217;
                    break;
            }
            return $min;
        }

        elseif ($this->duration_unit === 'meters')
        {
            switch($this->starting_intensity->name) {
                case 'Easy':
                    $min = $this->duration/1000 * 4.433;
                    break;
                case 'Steady State':
                    $min = $this->duration/1000 * 3.83;
                    break;
                case 'Threshold':
                    $min = $this->duration/1000 * 3.617;
                    break;
                case 'Critical Velocity':
                    $min = $this->duration/1000 * 3.483;
                    break;
                case 'Interval':
                    $min = $this->duration/1000 * 3.267;
                    break;
                case 'Repetition':
                    $min = $this->duration/400 * 1.217;
                    break;
            }
            return $min ;
        }
        return $this->duration;
    }

    public function getFinalIntensityMinutesRunningAttribute(): float
    {
        if ($this->duration_unit === 'miles')
        {
            switch($this->finalIntensity->name) {
                case 'Easy':
                    $min = $this->duration * 7.133;
                    break;
                case 'Steady State':
                    $min = $this->duration * 6.167;
                    break;
                case 'Threshold':
                    $min = $this->duration * 5.817;
                    break;
                case 'Critical Velocity':
                    $min = $this->duration * 5.6;
                    break;
                case 'Interval':
                    $min = $this->duration * 5.217;
                    break;
            }
            return $min;
        }

        elseif ($this->duration_unit === 'meters')
        {
            switch($this->final_intensity->name) {
                case 'Easy':
                    $min = $this->duration/1000 * 4.433;
                    break;
                case 'Steady State':
                    $min = $this->duration/1000 * 3.83;
                    break;
                case 'Threshold':
                    $min = $this->duration/1000 * 3.617;
                    break;
                case 'Critical Velocity':
                    $min = $this->duration/1000 * 3.483;
                    break;
                case 'Interval':
                    $min = $this->duration/1000 * 3.267;
                    break;
                case 'Repetition':
                    $min = $this->duration/400 * 1.217;
                    break;
            }
            return $min;
        }
        return $this->duration;
    }

    public function getProgressionMinutesAttribute(): float
    {
        if ($this->progression_interval_unit === 'miles')
        {
            switch($this->startingIntensity->name) {
                case 'Easy':
                    $min = $this->progression_interval * 7.133;
                    break;
                case 'Steady State':
                    $min = $this->progression_interval * 6.167;
                    break;
                case 'Threshold':
                    $min = $this->progression_interval * 5.817;
                    break;
                case 'Critical Velocity':
                    $min = $this->progression_interval * 5.6;
                    break;
                case 'Interval':
                    $min = $this->progression_interval * 5.217;
                    break;
            }
            return $min;
        }

        elseif ($this->progression_interval_unit === 'meters')
        {
            switch($this->finalIntensity->name) {
                case 'Easy':
                    $min = $this->progression_interval/1000 * 4.433;
                    break;
                case 'Steady State':
                    $min = $this->progression_interval/1000 * 3.83;
                    break;
                case 'Threshold':
                    $min = $this->progression_interval/1000 * 3.617;
                    break;
                case 'Critical Velocity':
                    $min = $this->progression_interval/1000 * 3.483;
                    break;
                case 'Interval':
                    $min = $this->progression_interval/1000 * 3.267;
                    break;
                case 'Repetition':
                    $min = $this->progression_interval/400 * 1.217;
                    break;
            }
            return $min;
        }
        return $this->progression_interval;
    }

    public function getProgressionInHMAttribute(): string
    {
        $min = $this->progression_minutes;

        return $this->timeToString($min);
    }

    public function getTotalPointsAttribute()
    {
        if ($this->progression_interval_unit === 'miles')
        {
            $averagePoints = ($this->startingIntensity->jd_points + $this->finalIntensity->jd_points) / 2;
            return round($averagePoints * $this->duration);
        }

        return 0;
    }

    public function getSteadyStateMinutesAttribute()
    {
        if ($this->startingIntensity->name === 'Easy' and $this->finalIntensity->name === 'Steady State')
        {
            return $this->progressionMinutes - $this->startingIntensityMinutesRunning();
        }
        return 0;
    }


    /**
     * @param float $min
     * @return string
     */
    public function timeToString(float $min): string
    {
        $hours = floor($min / 60);
        $minutes = $min % 60;

        $hrs = $hours < 1 ? '' : ($hours == 1 ? '1 hr' . ' ' : $hours . ' ' . 'hrs' . ' ');
        $min = $minutes < 1 ? '' : $minutes . ' ' . 'min';

        return $hrs . $min;
    }
}
