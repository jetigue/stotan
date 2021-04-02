<?php

namespace App\Models\Training\Runs;

use App\Models\Training\Intensity;
use App\Models\Training\Mesocycle;
use App\Models\Training\RunTypes\Intermittent;
use App\Models\Training\TrainingDay;
use App\Traits\BelongsToTeam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntermittentRun extends Model
{
    use HasFactory, BelongsToTeam;

    /**
     * @var string
     */
    protected $table = 'intermittent_runs';

    /**
     * @var string[]
     */
    protected $fillable = [
        'duration',
        'duration_unit',
        'intermittent_run_type_id',
        'mesocycle_id',
        'notes',
        'number_repetitions',
        'number_sets',
        'recovery',
        'recovery_type',
        'recovery_unit',
        'set_recovery',
        'set_recovery_type',
        'set_recovery_unit',
        'team_id',
        'training_day_id',
        'training_intensity_id',
        'training_session',
    ];

    public function intensity(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Intensity::class, 'training_intensity_id');
    }

    public function runType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Intermittent::class, 'intermittent_run_type_id');
    }

    public function mesocycle(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Mesocycle::class, 'mesocycle_id');
    }

    public function trainingDay(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(TrainingDay::class, 'training_day_id');
    }


    public function getMinutesRunningAtTargetIntensityAttribute(): float
    {
        if ($this->duration_unit === 'miles')
        {
            return round($this->minutesFromMiles() * $this->setsAndReps(), 2);
        }
        elseif ($this->duration_unit === 'meters')
        {
            return round($this->minutesFromMeters() * $this->setsAndReps(), 2);
        }
        elseif ($this->duration_unit === 'seconds')
        {
            return round($this->duration / 60 * $this->setsAndReps(), 2);
        }
        return round($this->duration * $this->setsAndReps(), 2);
    }

    public function getMinutesRunningAtRecoveryAttribute(): float
    {
        if ($this->recovery_unit === 'miles')
        {
            return $this->recovery_type === 'jog' ? $this->recovery * 7.133 * $this->setsAndReps() : 0;
        }
        elseif ($this->recovery_unit === 'meters')
        {
            return $this->recovery_type === 'jog' ? $this->recovery / 1000 * 7.133 * $this->setsAndReps() : 0;
        }
        elseif ($this->recovery_unit === 'seconds')
        {
            return $this->recovery_type === 'jog' ? $this->recovery / 60 * $this->setsAndReps() : 0;
        }
        return $this->recovery;
    }

    public function getMinutesRunningBetweenSetsAttribute()
    {
        if ($this->number_sets > 1 and $this->set_recovery_type === 'jog')
        {
            $multiplier = $this->number_sets - 1;
            $min = '';

            switch ($this->set_recovery_unit)
            {
                case 'miles':
                    $min = $this->set_recovery * 7.133;
                    break;
                case 'meters':
                    $min = $this->set_recovery / 1000 * 4.433;
                    break;
                case 'seconds':
                    $min = $this->set_recovery / 60;
                    break;
                case 'minutes':
                    $min = $this->set_recovery;
                    break;
            }
            return round($min * $multiplier, 2);
        }
        return 0;
    }

    public function getMilesAtTargetIntensityAttribute(): float
    {
        if ($this->duration_unit === 'minutes')
        {
            return $this->milesFromMinutes();
        }
        elseif ($this->duration_unit === 'seconds')
        {
            return round($this->milesFromMinutes() / 60, 1);
        }
        elseif ($this->duration_unit === 'meters')
        {
            return round($this->duration/1609.344 * $this->setsAndReps(), 1);
        }
        return round($this->duration * $this->setsAndReps(), 1);
    }

    public function getMilesAtRecoveryAttribute(): float
    {
        return round($this->minutes_running_at_recovery / 7.05, 2);
    }

    public function getMilesBetweenSetsAttribute(): float
    {
        return round($this->minutes_running_between_sets / 7.05, 2);
    }

    public function getMinutesRunningAttribute(): string
    {
        return $this->minutes_running_at_target_intensity + $this->minutes_running_at_recovery + $this->minutes_running_between_sets;
    }

    public function getDurationInHMAttribute(): string
    {
        return $this->timeToString($this->minutes_running);
    }

    public function getDurationAtTargetIntensityAttribute(): string
    {
        return $this->timeToString($this->minutes_running_at_target_intensity);
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

    public function getPointsAttribute(): string
    {
        $durationPoints = $this->minutes_running_at_target_intensity *  $this->intensity->jd_points;
        $recoveryPoints = ($this->minutes_running_at_recovery + $this->minutes_running_between_sets)* .200;

        return round($durationPoints + $recoveryPoints);
    }

    public function getTotalMilesAttribute(): int
    {
        return round($this->miles_at_target_intensity + $this->miles_at_recovery + $this->miles_between_sets, 1);
    }

    /**
     * @return float
     */
    public function minutesFromMiles(): float
    {
        switch ($this->intensity->name) {
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

    /**
     * @return float
     */
    public function minutesFromMeters(): float
    {
        switch ($this->intensity->name) {
            case 'Easy':
                $min = $this->duration / 1000 * 4.433;
                break;
            case 'Steady State':
                $min = $this->duration / 1000 * 3.83;
                break;
            case 'Threshold':
                $min = $this->duration / 1000 * 3.617;
                break;
            case 'Critical Velocity':
                $min = $this->duration / 1000 * 3.483;
                break;
            case 'Interval':
                $min = $this->duration / 1000 * 3.267;
                break;
            case 'Repetition':
                $min = $this->duration / 400 * 1.217;
                break;
        }
        return $min;
    }

    /**
     * @return int
     */
    public function setsAndReps(): int
    {
        return $this->number_sets * $this->number_repetitions;
    }

    /**
     * @return float
     */
    public function milesFromMinutes(): float
    {
        switch ($this->intensity->name) {
            case 'Easy':
                $mi = $this->duration / 7.05;
                break;
            case 'Steady State':
                $mi = $this->duration / 6.117;
                break;
            case 'Threshold':
                $mi = $this->duration / 5.767;
                break;
            case 'Critical Velocity':
                $mi = $this->duration / 5.55;
                break;
            case 'Interval':
                $mi = $this->duration / 5.183;
                break;
            case 'Repetition':
                $mi = $this->duration / 4.7;
                break;
        }
        return round($mi * $this->setsAndReps(), 1);
    }
}
